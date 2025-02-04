<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Controllers\BaseController;
use App\Models\Sale;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    protected $product;
    protected $cart;
    protected $sale;

    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->sale = new Sale();
    }
    public function index()
    {
        $products = $this->cart
            ->select('carts.*, products.name as product_name, products.code as product_code, products.sell_price as product_price')
            ->join('products', 'products.id = carts.product_id', 'left')
            ->get()
            ->getResult();
        $total = array_sum(array_map(function ($product) {
            return $product->product_price * $product->quantity;
        }, $products));
        $currentDate = date('Ymd');
        $lastInvoice = $this->sale
            ->select('invoice')
            ->like('invoice', $currentDate)
            ->orderBy('invoice', 'desc')
            ->limit(1)
            ->get()
            ->getRow();
        if ($lastInvoice) {
            $invoiceParts = explode('-', $lastInvoice->invoice);
            $lastInvoiceNumber = (int) $invoiceParts[2];
        } else {
            $lastInvoiceNumber = 0;
        }

        $invoiceNumber = str_pad($lastInvoiceNumber + 1, 3, '0', STR_PAD_LEFT);
        $invoice = 'INV-' . $currentDate . '-' . $invoiceNumber;
        $data = [
            'title' => 'Daftar Belanja',
            'carts' => $products,
            'total' => $total,
            'invoice' => $invoice,
        ];

        return view('pages/home/cart', $data);
    }

    public function add(int $id)
    {
        $quantity = (int) $this->request->getPost('quantity');
        if (empty($id) || $quantity <= 0) {
            session()->setFlashdata('error', '');
            return redirect()->back()->with('error', 'Tentukan kuantitas produk yang ingin dibeli');
        }
        $product = $this->product->find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
        if ($product['stock'] < $quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }
        $subTotal = $product['sell_price'] * $quantity;
        $cart = $this->cart->where('product_id', $id)->first();
        if ($cart) {
            $newQuantity = $cart['quantity'] + $quantity;
            $newSubTotal = $product['sell_price'] * $newQuantity;
            $cartData = [
                'quantity'  => $newQuantity,
                'subtotal'  => $newSubTotal
            ];
            if ($this->cart->update($cart['id'], $cartData)) {
                session()->setFlashdata('success', 'Keranjang berhasil diperbarui!');
            } else {
                session()->setFlashdata('error', 'Gagal memperbarui keranjang.');
            }
        } else {
            $cartData = [
                'product_id' => $id,
                'quantity'  => $quantity,
                'subtotal'  => $subTotal
            ];
            if ($this->cart->save($cartData)) {
                session()->setFlashdata('success', 'Produk berhasil ditambah ke keranjang!');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan produk ke keranjang.');
            }
        }
        return redirect()->to(route_to('home_product'));
    }

    public function update(int $id)
    {
        $quantity = $this->request->getPost('quantity');
        if (!is_numeric($quantity) || $quantity <= 0) {
            return redirect()->back()->with('error', 'Jumlah harus lebih dari 0.');
        }
        $cart = $this->cart->find($id);
        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }
        $product = $this->product->find($cart['product_id']);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
        $productPrice = $product['sell_price'];
        $subtotal = $productPrice * $quantity;
        $cartUpdate = [
            'id'       => $id,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ];
        if ($this->cart->save($cartUpdate)) {
            return redirect()->to(route_to('cart_index'))->with('success', 'Daftar belanja berhasil diperbarui!');
        } else {
            return redirect()->to(route_to('cart_index'))->with('error', 'Daftar belanja gagal diperbarui!');
        }
    }

    public function destroy(int $id)
    {
        $cart = $this->cart->where('id', $id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
        if ($this->cart->delete($cart['id'])) {
            return redirect()->to(route_to('cart_index'))->with('success', 'Produk berhasil dihapus dari daftar belanja !');
        } else {
            return redirect()->back()->with('error', 'Produk gagal dihapus!');
        }
    }

    public function invoice()
    {
        return view('pages/sale/invoice');
    }
}
