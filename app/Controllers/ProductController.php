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
                image: $image,
                data: [
                    "Kode Produk: " . esc($row->code),
                    "Nama Produk: " . esc($row->name),
                    "Kategori: " . esc($row->category_name),
                    "Unit: " . esc($row->unit_name),
                    "Harga Modal: " . rp(esc($row->capital_price)),
                    "Harga Jual: " . rp(esc($row->sell_price)),
                    "Stok: " . esc($row->stock),
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
    public function store()
    {
        $this->validation->setRules([
            'name'          => 'required|max_length[255]|is_unique[products.name]',
            'category_id'    => 'required',
            'unit_id'        => 'required',
            'capital_price'  => 'required|numeric',
            'sell_price'     => 'required|numeric',
            'stock'          => 'required|numeric',
            'image'          => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        // Run validation
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(route_to('produk_create'))
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }
        $file = $this->request->getFile('image');
        $imageName = null;
        if ($file && $file->isValid()) {
            $imageName = $file->getRandomName();
            $file->move('uploads/products', $imageName);
        }
        $productData = [
            'name'          => $this->request->getPost('name'),
            'code'          => $this->request->getPost('code'),
            'category_id'   => $this->request->getPost('category_id'),
            'unit_id'       => $this->request->getPost('unit_id'),
            'capital_price' => intval(str_replace('.', '', $this->request->getPost('capital_price'))),  // Format price
            'sell_price'    => intval(str_replace('.', '', $this->request->getPost('sell_price'))),  // Format price
            'stock'         => $this->request->getPost('stock'),
            'image'         => $imageName,  // Include image name
        ];
        if ($this->product->save($productData)) {
            session()->setFlashdata('success', 'Produk berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Produk gagal disimpan.');
        }
        return redirect()->to(base_url('/produk'));
    }



    public function edit(int $id)
    {
        $data = [
            'title' => 'Ubah Produk',
            'action' => route_to('produk_store'),
            'categories' => array_column($this->category->findAll(), 'name', 'id'),
            'units' => array_column($this->unit->findAll(), 'name', 'id'),
            'product' => $this->product->where('id', $id)->first(),
        ];

        return view('pages/master-data/produk/edit', $data);
    }


    public function update(int $id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            return redirect()->to(base_url('/produk'))
                ->with('error', 'Produk tidak ditemukan.');
        }
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[products.name,id,' . $id . ']',
            'code' => 'required|alpha_numeric|min_length[3]|max_length[50]|is_unique[products.code,id,' . $id . ']',
            'unit_id' => 'required',
            'category_id' => 'required',
            'capital_price' => 'required',
            'sell_price' => 'required',
            'stock' => 'required|integer',
            'image' => 'permit_empty|uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validation->getErrors());
        }
        $dataToUpdate = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code'),
            'unit_id' => $this->request->getPost('unit_id'),
            'category_id' => $this->request->getPost('category_id'),
            'capital_price' => (int) preg_replace('/[^\d]/', '', $this->request->getPost('capital_price')),
            'sell_price' => (int) preg_replace('/[^\d]/', '', $this->request->getPost('sell_price')),
            'stock' => $this->request->getPost('stock'),
        ];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/products', $fileName);
            $dataToUpdate['image'] = $fileName;
            if ($product['image'] && file_exists('uploads/products/' . $product['image'])) {
                unlink('uploads/products/' . $product['image']);
            }
        }
        if ($this->product->save($dataToUpdate)) {
            session()->setFlashdata('success', 'Produk berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Produk gagal diubah.');
        }
        return redirect()->to(base_url('/produk'));
    }

    public function delete(int $id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return redirect()->to(base_url('/produk'))
                ->with('error', 'Produk tidak ditemukan.');
        }
        $imagePath = WRITEPATH . 'uploads/products/' . $product['image'];
        try {
            if (!empty($product['image']) && is_file($imagePath)) {
                unlink($imagePath);
            }
            if ($this->product->delete($id)) {
                session()->setFlashdata('success', 'Produk berhasil dihapus!');
            } else {
                session()->setFlashdata('error', 'Produk gagal dihapus.');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus produk: ' . $e->getMessage());
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
                    $failedIds[] = $id;
                    continue;
                }
                if (!empty($product['image']) && file_exists('uploads/products/' . $product['image'])) {
                    unlink('uploads/products/' . $product['image']);  // Delete the image from the server
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
