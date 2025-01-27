<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $filteredCount = 0;

    protected $allowedFields = [
        'name',
        'code',
        'stock',
        'capital_price',
        'sell_price',
        'category_id',
        'unit_id',
        'image'
    ];

    public function filterProducts($search = null, $start = 0, $length = 0, $category = null, $unit = null)
    {
        $builder = $this->join('categories', 'categories.id = products.category_id', 'left')
            ->join('units', 'units.id = products.unit_id', 'left')
            ->select(
                'products.id, 
             products.name, 
             products.code, 
             products.stock, 
             products.capital_price, 
             products.sell_price, 
             categories.name as category_name, 
             units.name as unit_name'
            );

        // Filter pencarian
        if ($search) {
            $arr = explode(" ", $search);
            foreach ($arr as $term) {
                $builder->groupStart()
                    ->orLike('products.name', $term)
                    ->orLike('products.code', $term)
                    ->orLike('categories.name', $term)
                    ->orLike('units.name', $term)
                    ->groupEnd();
            }
        }

        // Filter kategori dan unit
        if ($category) {
            $builder->where('products.category_id', $category);
        }

        if ($unit) {
            $builder->where('products.unit_id', $unit);
        }

        // Hitung jumlah data tanpa pagination
        $this->filteredCount = $builder->countAllResults(false);

        // Pagination
        if ($start !== 0 || $length !== 0) {
            $builder->limit($length, $start);
        }

        return $builder->orderBy('products.name', 'asc')->get()->getResult();
    }
}
