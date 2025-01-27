<?php

namespace App\Models;

use CodeIgniter\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    /**
     * Mendapatkan produk yang terkait dengan unit ini
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'unit_id');
    }
}
