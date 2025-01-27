<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Product;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Unit;

class ProductController extends BaseController
{
    protected $validation;
    protected $product;
    protected $category;
    protected $unit;


    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->unit = new Unit();
        $this->validation = Services::validation();
    }

    // Menampilkan daftar produk
    public function index()
    {
        $categories = $this->category->get()->getResult();
        $units = $this->unit->get()->getResult();
        return view('pages/master-data/produk/index', compact('categories', 'units'));
    }

    public function getProduk()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? (int) $_REQUEST['draw'] : 0;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 10;
        $category = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
        $unit = isset($_REQUEST['unit_id']) ? $_REQUEST['unit_id'] : null;

        $data = $this->product->filterProducts($search, $start, $length, $category, $unit);
        foreach ($data as &$row) {
            $row->checked = '<input type="checkbox" value="' . $row->id . '" class="form-check-input" id="' . $row->id . '">';
            $image = isset($row->image) ? esc($row->image) : '';
            $row->show = btnView(id: esc($row->id));
            $row->view = modalView(
                id: esc($row->id),
                href: route_to('produk_edit', $row->id),
                data: [
                    "Kode Produk: " . esc($row->code),
                    "Nama Produk: " . esc($row->name),
                    "Kategori: " . esc($row->category_name),
                    "Unit: " . esc($row->unit_name),
                    "Harga Modal: " . rp(esc($row->capital_price)),
                    "Harga Jual: " . rp(esc($row->sell_price)),
                    "Stok: " . esc($row->stock),
                    "Gambar: " . $image
                ]
            );
            $row->edit = btnEdit(route_to('produk_edit', esc($row->id)));
            $row->delete = btnDelete(route_to('produk_delete', esc($row->id)), 'Produk ' . esc($row->name));
        }
        $recordsTotal = $this->product->countAllResults();
        $recordsFiltered = $this->product->filteredCount;

        $output = array(
            "draw" => $param['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );

        return $this->response->setJSON($output);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'action' => route_to('produk_store'),
            'categories' => array_column($this->category->findAll(), 'name', 'id'),
            'units' => array_column($this->unit->findAll(), 'name', 'id'),
        ];

        return view('pages/master-data/produk/create', $data);
    }

    // Menyimpan produk baru
    public function store()
    {
        var_dump($this->request->getFile('image'));
        die();
        $this->validation->setRules([
            'name'         => 'required|max_length[255]|is_unique[products.name]',
            'category_id'   => 'required',
            'unit_id'   => 'required',
            'capital_price' => 'required|numeric',
            'sell_price'    => 'required|numeric',
            'stock'         => 'required|numeric',
            'image'         => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(route_to('produk_create'))
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }
        $imageName = '';
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            $imageName = substr(bin2hex(random_bytes(4)), 0, 10) . '.' . $image->getClientExtension();
            $image->move(WRITEPATH . 'uploads/products', $imageName);
        }
        $productData = [
            'name'          => $this->request->getPost('name'),
            'code'          => $this->request->getPost('code'),
            'category_id'   => $this->request->getPost('category_id'),
            'unit_id'       => $this->request->getPost('unit_id'),
            'capital_price' => intval(str_replace('.', '', $this->request->getPost('capital_price'))),
            'sell_price'    => intval(str_replace('.', '', $this->request->getPost('sell_price'))),
            'stock'         => $this->request->getPost('stock'),
            'image'         => $imageName,
        ];

        if ($this->product->save($productData)) {
            session()->setFlashdata('success', 'Produk berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Produk gagal disimpan.');
        }

        return redirect()->to(base_url('/produk'));
    }


    // Memperbarui produk
    public function update(int $id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return redirect()->to(base_url('/produk'))
                ->with('error', 'Produk tidak ditemukan.');
        }

        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[products.name,id,' . $id . ']',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url('/produk'))
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }

        $product['name'] = $this->request->getPost('name');

        if ($this->product->save($product)) {
            session()->setFlashdata('success', 'Produk berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Produk gagal diubah.');
        }

        return redirect()->to(base_url('/produk'));
    }

    // Menghapus produk
    public function delete(int $id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return redirect()->to(base_url('/produk'))
                ->with('error', 'Produk tidak ditemukan.');
        }

        if ($this->product->delete($id)) {
            session()->setFlashdata('success', 'Produk berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Produk gagal dihapus.');
        }

        return redirect()->to(base_url('/produk'));
    }

    public function deletes()
    {
        $ids = $this->request->getPost('ids');

        if (empty($ids)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada produk yang dipilih.']);
        }

        try {
            $deletedCount = 0;
            $failedIds = [];
            foreach ($ids as $id) {
                $product = $this->product->find($id);
                if (!$product) {
                    $failedIds[] = $id; // Menambahkan ID yang tidak ditemukan
                    continue;
                }

                if ($this->product->delete($id)) {
                    $deletedCount++;
                } else {
                    $failedIds[] = $id;
                }
            }

            if ($deletedCount > 0) {
                $message = $deletedCount . ' produk berhasil dihapus.';
                if (!empty($failedIds)) {
                    $message .= ' Beberapa produk gagal dihapus: ' . implode(', ', $failedIds);
                }
                return $this->response->setJSON(['success' => true, 'message' => $message]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada produk yang dapat dihapus.']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
