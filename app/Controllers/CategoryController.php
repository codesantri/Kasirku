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

    // Menampilkan daftar kategori
    public function index()
    {
        // Ambil semua kategori tanpa pagination atau pencarian
        $categories = $this->category->orderBy('id', 'desc')->findAll();

        $data = [
            'title' => 'Data Kategori',
            'categories' => $categories,
        ];
        return view('pages/master-data/category', $data);
    }

    // Menyimpan kategori baru
    public function store()
    {
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[categories.name]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url('/kategori'))->withInput()->with('errors', $this->validation->getErrors());
        }

        $category = [
            'name' => $this->request->getPost('name'),
        ];

        if ($this->category->save($category)) {
            session()->setFlashdata('success', 'Kategori berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Kategori gagal disimpan.');
        }
        return redirect()->to(base_url('/kategori'));
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
            return redirect()->to(base_url('/kategori'))->withInput()->with('errors', $this->validation->getErrors());
        }

        $category['name'] = $this->request->getPost('name');

        if ($this->category->save($category)) {
            session()->setFlashdata('success', 'Kategori berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Kategori gagal diubah.');
        }
        return redirect()->to(base_url('/kategori'));
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
}
