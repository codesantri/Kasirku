<?php

namespace App\Models;

use CodeIgniter\Model;

class Sale extends Model
{
    protected $table            = 'sales';
    protected $allowedFields = ['user_id', 'customer_id', 'invoice', 'total', 'cash', 'change', 'status'];
}
