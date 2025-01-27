<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    /**
     * Mendapatkan produk yang terkait dengan kategori ini
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
