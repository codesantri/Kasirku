<?php

namespace App\Models;

use CodeIgniter\Model;

class Cart extends Model
{
    protected $table            = 'carts';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['product_id', 'subtotal', 'quantity'];
}
