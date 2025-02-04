<?php

namespace App\Models;

use CodeIgniter\Model;

class Stock extends Model
{
    protected $table            = 'stocks';
    protected $allowedFields    = ['product_id', 'status', 'quantity', 'description'];
    protected $filteredCount = 0;

    public function filterStocks($search = null, $start = 0, $length = 0, $product = null)
    {
        $builder = $this->join('products', 'products.id = stocks.product_id', 'left')
            ->select(
                'stocks.id, 
                stocks.status, 
                stocks.description, 
                stocks.quantity,
                stocks.created_at,  
                products.name as product_name'
            );

        // Filter pencarian
        if ($search) {
            $arr = explode(" ", $search);
            foreach ($arr as $term) {
                $builder->groupStart()
                    ->orLike('stocks.status', $term)
                    ->orLike('products.name', $term)
                    ->groupEnd();
            }
        }

        // Filter berdasarkan produk
        if ($product) {
            $builder->where('stocks.product_id', $product);
        }

        // Hitung jumlah data tanpa pagination
        $this->filteredCount = $builder->countAllResults(false);

        // Pagination
        if ($start !== 0 || $length !== 0) {
            $builder->limit($length, $start);
        }

        return $builder->orderBy('stocks.id', 'desc')->get()->getResult();
    }
}
