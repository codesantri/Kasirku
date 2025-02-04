<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetail extends Model
{
    protected $table            = 'sale_details';
    protected $allowedFields    = ['sale_id', 'product_id', 'quantity', 'subtotal'];
}
