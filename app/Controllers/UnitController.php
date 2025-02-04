<?php

namespace App\Controllers;

use App\Models\Unit;
use Config\Services;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UnitController extends BaseController
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
        $title = 'Data Unit';
        return view('pages/unit/index', compact('title'));
    }

    public function getUnit()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? (int) $_REQUEST['draw'] : 0;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 10;

        $data = $this->unit->filterUnits($search, $start, $length);

        foreach ($data as &$row) {
            $row->checked = '<input type="checkbox" value="' . $row->id . '" class="form-check-input" id="' . $row->id . '">';
            $row->edit = btnEdit(route_to('unit_edit', esc($row->id)));
            $row->delete = btnDelete(route_to('unit_delete', esc($row->id)), 'Unit ' . esc($row->name));
        }

        $recordsTotal = $this->unit->countAll();
        $recordsFiltered = $this->unit->filterUnits($search, 0, 0);
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
        $title = 'Tambah Unit';
        return view('pages/unit/create', compact('title'));
    }

    public function store()
    {
        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[units.name]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url(route_to('unit_create')))->withInput()->with('errors', $this->validation->getErrors());
        }

        $unit = [
            'name' => $this->request->getPost('name'),
        ];

        if ($this->unit->save($unit)) {
            session()->setFlashdata('success', 'Unit berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Unit gagal disimpan.');
        }
        return redirect()->to(base_url(route_to('unit_create')));
    }

    public function edit(int $id)
    {
        $unit = $this->unit->find($id);
        $title = 'Edit Unit';
        return view('pages/unit/edit', compact('title', 'unit'));
    }

    public function update(int $id)
    {
        $unit = $this->unit->find($id);
        if (!$unit) {
            return redirect()->to(base_url('/unit'))->with('error', 'Unit tidak ditemukan.');
        }

        $this->validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]|is_unique[units.name,id,' . $id . ']',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to(base_url(route_to('unit_edit', $id)))->withInput()->with('errors', $this->validation->getErrors());
        }
        $unit['name'] = $this->request->getPost('name');

        if ($this->unit->save($unit)) {
            session()->setFlashdata('success', 'Unit berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Unit gagal diubah.');
        }
        return redirect()->to(base_url(route_to('unit_edit', $id)));
    }

    public function destroy(int $id)
    {
        $unit = $this->unit->find($id);
        if (!$unit) {
            return redirect()->to(base_url('/unit'))->with('error', 'Unit tidak ditemukan.');
        }

        if ($this->unit->delete($id)) {
            session()->setFlashdata('success', 'Unit berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Unit gagal dihapus.');
        }
        return redirect()->to(base_url('/unit'));
    }

    public function deletes()
    {
        $ids = $this->request->getPost('ids');

        if (empty($ids)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada unit yang dipilih.'
            ]);
        }

        try {
            $deletedCount = 0;
            $failedIds = [];
            foreach ($ids as $id) {
                $unit = $this->unit->find($id);
                if (!$unit) {
                    $failedIds[] = $id;
                    continue;
                }
                if ($this->unit->delete($id)) {
                    $deletedCount++;
                } else {
                    $failedIds[] = $id;
                }
            }

            if ($deletedCount > 0) {
                $message = $deletedCount . ' unit berhasil dihapus.';
                if (!empty($failedIds)) {
                    $message .= ' Beberapa unit gagal dihapus: ' . implode(', ', $failedIds);
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => $message
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Tidak ada unit yang dapat dihapus.'
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
