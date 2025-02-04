<?php

namespace App\Controllers;

use App\Models\Stock;
use App\Models\Product;
use CodeIgniter\Config\Services;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StockController extends BaseController
{
    protected $product;
    protected $stock;
    protected $validation;

    public function  __construct()
    {
        $this->product = new Product();
        $this->stock = new Stock();
        $this->validation = Services::validation();
    }
    public function index()
    {
        return view('pages/stock/index');
    }

    public function create()
    {
        $products = array_column($this->product->findAll(), 'name', 'id');
        return view('pages/stock/create', compact('products'));
    }

    public function store()
    {
        $this->validation->setRules([
            'product_id'  => 'required',
            'quantity'    => 'required|numeric',
            'status'      => 'required|in_list[in,out]',
            'description' => 'permit_empty|string'
        ]);

        // Run validation
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $productId = $this->request->getPost('product_id');
        $quantity  = (int) $this->request->getPost('quantity');
        $status    = $this->request->getPost('status');


        $product = $this->product->find($productId);

        if (!$product) {
            return redirect()->back()->withInput()
                ->with('errors', ['product_id' => 'Produk tidak ditemukan.']);
        }

        if ($status === 'in') {
            $newStock = $product['stock'] + $quantity;
        } else { // status 'out'
            if ($product['stock'] < $quantity) {
                return redirect()->back()->withInput()
                    ->with('errors', ['quantity' => 'Jumlah stok tidak mencukupi untuk dikeluarkan.']);
            }
            $newStock = $product['stock'] - $quantity;
        }
        $this->product->update($productId, ['stock' => $newStock]);
        $stock = [
            'product_id'  => $productId,
            'quantity'    => $quantity,
            'status'      => $status,
            'description' => $this->request->getPost('description'),
        ];
        if ($this->stock->save($stock)) {
            session()->setFlashdata('success', 'Stok ' . $product['name'] . ' berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Stok ' . $product['name'] . ' gagal disimpan.');
        }
        return redirect()->to(route_to('stock_index'));
    }

    public function getStock()
    {
        $stockModel = new Stock();

        $param['draw'] = isset($_REQUEST['draw']) ? (int) $_REQUEST['draw'] : 0;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 10;
        $product = isset($_REQUEST['product_id']) ? $_REQUEST['product_id'] : null;

        $data = $stockModel->filterStocks($search, $start, $length, $product);
        foreach ($data as &$row) {
            $row->checked = '<input type="checkbox" value="' . $row->id . '" class="form-check-input">';
            $row->status = $row->status === 'in'
                ? '<span class="badge bg-success text-white"><i class="fa-solid fa-chevron-up"></i> Masuk</span>'
                : '<span class="badge bg-danger text-white"><i class="fa-solid fa-chevron-down"></i> Keluar</span>';
            $row->edit = btnEdit(route_to('stock_edit', esc($row->id)));
            $row->delete = btnDelete(route_to('stock_delete', esc($row->id)), 'Stok ' . esc($row->product_name));
        }

        $recordsTotal = $stockModel->countAllResults();
        $recordsFiltered = $stockModel->filteredCount;

        return $this->response->setJSON([
            "draw" => $param['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        ]);
    }

    public function edit(int $id)
    {
        $products = array_column($this->product->findAll(), 'name', 'id');
        $stock = $this->stock->find($id); // Perbaikan pemanggilan find()

        if (!$stock) {
            return redirect()->route('stock_index')->with('error', 'Data stok tidak ditemukan');
        }

        return view('pages/stock/edit', compact('products', 'stock'));
    }

    public function update(int $id)
    {
        $stock = $this->stock->find($id);
        if (!$stock) {
            return redirect()->back()->with('error', 'Stok tidak ditemukan.');
        }

        // Validasi input
        $this->validation->setRules([
            'product_id'  => 'required|integer',
            'quantity'    => 'required|numeric|greater_than[0]',
            'status'      => 'required|in_list[in,out]',
            'description' => 'permit_empty|string'
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $newProductId = $this->request->getPost('product_id');
        $newQuantity  = (int) $this->request->getPost('quantity');
        $newStatus    = $this->request->getPost('status');

        // Ambil produk lama dan baru
        $oldProduct = $this->product->find($stock['product_id']);
        $newProduct = $this->product->find($newProductId);

        if (!$newProduct) {
            return redirect()->back()->withInput()
                ->with('errors', ['product_id' => 'Produk tidak ditemukan.']);
        }

        // 1. Kurangi stok dari produk lama jika product_id berubah
        if ($newProductId !== $stock['product_id']) {
            if ($oldProduct) {
                $oldStock = $oldProduct['stock'] - ($stock['status'] === 'in' ? $stock['quantity'] : -$stock['quantity']);
                $this->product->update($stock['product_id'], ['stock' => max(0, $oldStock)]);
            }
        }

        // 2. Hitung stok baru pada produk yang baru dipilih
        $currentStock = $newProduct['stock'];

        // Jika status lama "in", stok sebelumnya harus dikurangi dari stok produk
        // Jika status lama "out", stok sebelumnya harus dikembalikan ke stok produk
        if ($stock['status'] === 'in') {
            $currentStock -= $stock['quantity'];
        } else {
            $currentStock += $stock['quantity'];
        }

        // 3. Perhitungan stok baru setelah perubahan
        if ($newStatus === 'in') {
            $newStock = $currentStock + $newQuantity;
        } else {
            $newStock = $currentStock - $newQuantity;
            if ($newStock < 0) {
                return redirect()->back()->withInput()
                    ->with('errors', ['quantity' => 'Jumlah stok tidak mencukupi untuk dikurangi.']);
            }
        }
        $this->product->update($newProductId, ['stock' => $newStock]);
        $dataNewStock = [
            'product_id'  => $newProductId,
            'quantity'    => $newQuantity,
            'status'      => $newStatus,
            'description' => $this->request->getPost('description'),
        ];
        if ($this->stock->update($id, $dataNewStock)) {
            session()->setFlashdata('success', 'Stok ' . $newProduct['name'] . ' berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Stok ' . $newProduct['name'] . ' gagal diubah.');
        }

        return redirect()->to(route_to('stock_index'));
    }
}
