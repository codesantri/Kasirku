<?php

namespace App\Controllers;

use Config\Services;
use App\Controllers\BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    protected $validation;
    protected $category;

    public function __construct()
    {
        $this->category = new Category();
        $this->validation = Services::validation();
    }

    public function index()
    {
        $title = 'Data Kategori';
        return view('pages/category/index', compact('title'));
    }

    public function getCategory()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? (int) $_REQUEST['draw'] : 0;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 10;

        $data = $this->category->filterCategories($search, $start, $length);

        foreach ($data as &$row) {
            $row->checked = '<input type="checkbox" value="' . $row->id . '" class="form-check-input" id="' . $row->id . '">';
            $row->edit = btnEdit(route_to('category_edit', esc($row->id)));
            $row->delete = btnDelete(route_to('category_delete', esc($row->id)), 'Kategori ' . esc($row->name));
        }

        // Total records
        $recordsTotal = $this->category->countAll();

        $recordsFiltered = $this->category->filterCategories($search, 0, 0); // tanpa pagination
        $recordsFilteredCount = count($recordsFiltered);

        $output = array(
            "draw" => $param['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFilteredCount,
            "data" => $data
        );

        return $this->response->setJSON($output);
    }

    public function create()
    {
        $title = 'Tambah Kategori';
        return view('pages/category/create', compact('title'));
    }

    // Menyimpan kategori baru
    public function store()
    {
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[categories.name]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url(route_to('category_create')))->withInput()->with('errors', $this->validation->getErrors());
        }

        $category = [
            'name' => $this->request->getPost('name'),
        ];

        if ($this->category->save($category)) {
            session()->setFlashdata('success', 'Kategori berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Kategori gagal disimpan.');
        }
        return redirect()->to(base_url(route_to('category_create')));
    }

    public function edit(int $id)
    {
        $category = $this->category->find($id);
        $title = 'Tambah Kategori';
        return view('pages/category/edit', compact('title', 'category'));
    }

    // Memperbarui kategori
    public function update(int $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return redirect()->to(base_url('/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[categories.name,id,' . $id . ']',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url(route_to('category_edit', $id)))->withInput()->with('errors', $this->validation->getErrors());
        }
        $category['name'] = $this->request->getPost('name');

        if ($this->category->save($category)) {
            session()->setFlashdata('success', 'Kategori berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Kategori gagal diubah.');
        }
        return redirect()->to(base_url(route_to('category_edit', $id)));
    }

    // Menghapus kategori
    public function destroy(int $id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return redirect()->to(base_url('/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        if ($this->category->delete($id)) {
            session()->setFlashdata('success', 'Kategori berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Kategori gagal dihapus.');
        }
        return redirect()->to(base_url('/kategori'));
    }

    public function deletes()
    {
        // Ambil ID kategori yang dipilih dari request
        $ids = $this->request->getPost('ids');

        // Jika tidak ada ID yang dipilih, kembalikan pesan error
        if (empty($ids)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada kategori yang dipilih.'
            ]);
        }

        try {
            $deletedCount = 0;
            $failedIds = [];
            foreach ($ids as $id) {
                $category = $this->category->find($id);
                if (!$category) {
                    $failedIds[] = $id;
                    continue;
                }
                if ($this->category->delete($id)) {
                    $deletedCount++;
                } else {
                    $failedIds[] = $id;
                }
            }

            // Jika ada kategori yang berhasil dihapus
            if ($deletedCount > 0) {
                $message = $deletedCount . ' kategori berhasil dihapus.';
                if (!empty($failedIds)) {
                    $message .= ' Beberapa kategori gagal dihapus: ' . implode(', ', $failedIds);
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => $message
                ]);
            } else {
                // Jika tidak ada kategori yang berhasil dihapus
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada kategori yang dapat dihapus.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
