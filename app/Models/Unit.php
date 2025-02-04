<?php

namespace App\Models;

use CodeIgniter\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    protected $filteredCount = 0;

    /**
     * Mendapatkan produk yang terkait dengan unit ini
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'unit_id');
    }

    public function filterUnits($search = null, $start = 0, $length = 0)
    {
        $builder = $this->builder()->select('units.id, units.name');
        if ($search) {
            $arr = explode(" ", $search);
            foreach ($arr as $term) {
                $builder->groupStart()
                    ->like('name', $term)
                    ->groupEnd();
            }
        }
        if ($start !== 0 || $length !== 0) {
            $builder->limit($length, $start);
        }

        return $builder->orderBy('name', 'asc')->get()->getResult();
    }
}
