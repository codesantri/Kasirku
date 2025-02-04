<?php

namespace App\Controllers;

use App\Models\Cart;
use Config\Services;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Controllers\BaseController;
use App\Models\Sale;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class PaymenController extends BaseController
{
    protected $validation;
    protected $cart;
    protected $product;
    protected $user;
    protected $sale;
    protected $saleDetail;

    public function __construct()
    {
        // $this->sessionId    = Services::session();
        // $this->user         = new User();
        $this->validation   = Services::validation();
        $this->cart         = new Cart();
        $this->product      = new Product();
        $this->saleDetail  = new SaleDetail();
        $this->sale = new Sale();
        $this->user = 1;
    }

    public function index()
    {
        //
    }

    public function payment()
    {
        $paymentMethod = $this->request->getPost('payment_method');
        $customerId = $this->request->getPost('customer_id');
        $invoice = $this->request->getPost('invoice');
        $cash = intval(str_replace('.', '', $this->request->getPost('cash')));
        $change = intval(str_replace('.', '', $this->request->getPost('change')));
        $total = intval(str_replace('.', '', $this->request->getPost('total')));
        // var_dump($cash, $change, $total);
        // die;

        if ($paymentMethod === 'debt' && empty($customerId)) {
            return redirect()->back()->with('error', 'Data customer tidak boleh kosong jika memilih metode hutang.');
        }

        $this->validation->setRules([
            'invoice'        => 'required',
            'payment_method' => 'required',
            'cash'           => 'required|greater_than[0]',
            'change'         => 'permit_empty|greater_than_equal_to[0]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Ambil data produk di cart dan hitung total harga
        $cartItems = $this->cart
            ->select('carts.*, products.sell_price as product_price')
            ->join('products', 'products.id = carts.product_id', 'left')
            ->get()
            ->getResult();

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong!');
        }

        // Pastikan uang tunai cukup untuk pembayaran jika metode adalah cash
        if ($paymentMethod === 'cash' && $cash < $total) {
            return redirect()->back()->withInput()->with('error', 'Uang tunai tidak mencukupi.');
        }

        $saleData = [
            'user_id'     => $this->user,
            'customer_id' => $customerId ?? null,
            'invoice'     => $invoice,
            'total'       => $total,
            'cash'        => $cash,
            'change'      => $change ?? 0,
            'status'      => $paymentMethod,
        ];

        $db = Database::connect();
        $db->transStart();

        try {
            $this->sale->insert($saleData);
            $saleId = $this->sale->getInsertID();

            $saleDetails = [];
            foreach ($cartItems as $item) {
                $saleDetails[] = [
                    'sale_id'    => $saleId,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'subtotal'   => $item->subtotal,
                ];
            }

            $this->saleDetail->insertBatch($saleDetails);
            $this->cart->emptyTable();
            $db->transComplete();

            session()->setFlashdata('success', 'Transaksi pembayaran berhasil!');
            return redirect()->to(route_to('invoice', $invoice));
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());

            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data transaksi.');
            return redirect()->back()->withInput();
        }
    }


    public function invoice(string $invoice)
    {
        $sale = $this->sale
            ->select('sales.*, users.name as user_name')
            ->join('users', 'users.id = sales.user_id', 'left')
            ->where('invoice', $invoice)
            ->first();

        if (!$sale) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }
        $invoice = $this->saleDetail
            ->select('sale_details.*, products.name as product_name, products.sell_price as product_price, units.name as unit_name')
            ->join('products', 'products.id = sale_details.product_id', 'left')
            ->join('units', 'units.id = products.unit_id', 'left')
            ->where('sale_id', $sale['id'])
            ->findAll();
        return view('pages/home/invoice', compact('sale', 'invoice'));
    }
}
