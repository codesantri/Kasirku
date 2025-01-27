<?php

namespace App\Controllers;

use App\Models\Unit;
use Config\Services;
use App\Controllers\BaseController;

class SatuanController extends BaseController
{
    protected $validation;
    protected $unit;

    public function __construct()
    {
        $this->unit = new Unit();
        $this->validation = Services::validation();
    }

    public function index()
    {
        $units = $this->unit->orderBy('id', 'desc')->findAll();
        $data = [
            'title' => 'Data Satuan',
            'units' => $units,
        ];
        return view('pages/master-data/unit', $data);
    }

    public function store()
    {
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[units.name]',
        ]);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url('/satuan'))->withInput()->with('errors', $this->validation->getErrors());
        }
        $unit = [
            'name' => $this->request->getPost('name'),
        ];

        if ($this->unit->save($unit)) {
            session()->setFlashdata('success', 'Satuan berhasil disimpan!');
            return redirect()->to(base_url('/satuan'));
        } else {
            session()->setFlashdata('error', 'Satuan gagal disimpan');
            return redirect()->to(base_url('/satuan'));
        }
    }

    public function update(int $id)
    {
        $unit = $this->unit->where('id', $id)->first();
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[units.name,id,' . $unit['id'] . ']',
        ]);
        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url('/satuan'))->withInput()->with('errors', $this->validation->getErrors());
        }
        $updateUnit = [
            'id'    => $unit['id'],
            'name'  => $this->request->getPost('name'),
        ];
        if ($this->unit->save($updateUnit)) {
            session()->setFlashdata('success', 'Satuan berhasil diubah!');
            return redirect()->to(base_url('/satuan'));  // Menggunakan route_to
        } else {
            session()->setFlashdata('error', 'Satuan gagal diubah');
            return redirect()->to(base_url('/satuan'));
        }
    }

    public function destroy(int $id)
    {
        $unit = $this->unit->where('id', $id)->first();
        if (!$unit) {
            return redirect()->back()->with('error', 'Satuan tidak ditemukan');
        }
        if ($this->unit->delete($unit['id'])) {
            return redirect()->to(route_to('satuan_index'))->with('success', 'Satuan berhasil dihapus!');  // Menggunakan route_to
        } else {
            return redirect()->back()->with('error', 'Satuan gagal dihapus!');
        }
    }
}
