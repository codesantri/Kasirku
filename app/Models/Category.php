<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];
    protected $filteredCount = 0;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Filter kategori dengan pencarian dan pagination
     */
    public function filterCategories($search = null, $start = 0, $length = 0)
    {
        $builder = $this->builder()->select('categories.id, categories.name');
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
