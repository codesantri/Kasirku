<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    protected $product;
    protected $category;
    protected $unit;
    protected $cart;
    protected $sale;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->unit = new Unit();
        $this->sale = new Sale();
    }

    public function index()
    {
        // Menghitung jumlah produk dan total stok
        $countProduct = $this->product->builder()->countAllResults();
        $totalStock = $this->product->builder()->selectSum('stock')->get()->getRow()->stock ?? 0;
        $totalCapital = $this->product->builder()->selectSum('capital_price')->get()->getRow()->capital_price ?? 0;
        $totalRevenue = $this->sale->builder()->selectSum('total')->get()->getRow()->total ?? 0;
        $totalProfit = $this->sale->builder()->where('status', 'cash')->selectSum('total')->get()->getRow()->total ?? 0;

        // Menghitung selisih dan persentase
        $difference = $totalRevenue - $totalCapital;
        $percentageDifference = ($totalCapital > 0) ? ($difference / $totalCapital) * 100 : 0;

        // Tanggal hari ini, minggu ini, bulan ini, tahun ini
        $today = date('Y-m-d');
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $startOfMonth = date('Y-m-01');
        $startOfYear = date('Y-01-01');

        // Menghitung total pendapatan berdasarkan periode waktu
        $revenueToday = $this->sale->builder()->where('DATE(created_at)', $today)->selectSum('total')->get()->getRow()->total ?? 0;
        $revenueThisWeek = $this->sale->builder()->where('DATE(created_at) >=', $startOfWeek)->selectSum('total')->get()->getRow()->total ?? 0;
        $revenueThisMonth = $this->sale->builder()->where('DATE(created_at) >=', $startOfMonth)->selectSum('total')->get()->getRow()->total ?? 0;
        $revenueThisYear = $this->sale->builder()->where('DATE(created_at) >=', $startOfYear)->selectSum('total')->get()->getRow()->total ?? 0;

        $data = [
            'countProduct' => $countProduct,
            'totalStock' => $totalStock,
            'totalCapital' => $totalCapital,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'difference' => $difference,
            'percentageDifference' => round($percentageDifference, 2), // Dibulatkan ke 2 angka desimal
            'revenueToday' => $revenueToday,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear
        ];

        return view('pages/home/index', $data);
    }

    public function products()
    {
        $categories = $this->category->get()->getResult();
        $units = $this->unit->get()->getResult();
        return view('pages/home/products', compact('categories', 'units'));
    }

    public function getProducts()
    {
        $param['draw'] = isset($_REQUEST['draw']) ? (int) $_REQUEST['draw'] : 0;
        $search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 12;
        $category = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : null;
        $unit = isset($_REQUEST['unit_id']) ? $_REQUEST['unit_id'] : null;
        $data = $this->product->filterProducts($search, $start, $length, $category, $unit);
        foreach ($data as &$row) {
            $category_id = isset($row->category_id) ? esc($row->category_id) : 'N/A';
            $unit_id = isset($row->unit_id) ? esc($row->unit_id) : 'N/A';

            $row->view = '
                    <a class="col-xl-2 col-lg-3 col-md-3 col-sm-3 product-card my-2"
                        data-category="' . $category_id . '"
                        data-unit="' . $unit_id . '"
                        data-name="' . strtolower(esc($row->name)) . '">
                        <div class="card shadow">
                            <img class="img-fluid" width="100%" height="50%" src="' . (esc($row->image) ?? 'https://placehold.co/50x50') . '" alt="' . esc($row->name) . '">
                            <div class="card-body">
                                <h6 class="card-title mb-0">' . esc($row->name) . '</h6>
                                <strong class="m-0">' . esc(rp($row->sell_price)) . '</strong>
                                <small class="m-0 text-muted">/ Stok ' . esc($row->stock) . '</small>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-light btn-sm">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </button>
                                    <form action="' . route_to('cart_add', esc($row->id)) . '" method="POST">
                                        ' . csrf_field() . '
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="1" class="form-control text-center form-control-sm rounded-1">
                                            <button type="submit" class="btn btn-sm btn-success rounded-1">
                                                <i class="fa-solid fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                    ';
        }
        $recordsTotal = $this->product->countAllResults();
        $recordsFiltered = $this->product->filteredCount; // Pastikan Anda menghitung jumlah hasil yang difilter

        $output = array(
            "draw" => $param['draw'],
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );

        return $this->response->setJSON($output);
    }
}
