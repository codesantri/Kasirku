<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div id="receipt-print" class="receipt mx-auto shadow-lg">
        <div class="receipt-header text-center">
            <h5 class="fw-bold text-primary">Takitech Store</h5>
            <p class="text-muted mb-0">Jl. Teknologi No. 123, Jakarta</p>
            <p class="text-muted mb-0">Telp: 021-5556789</p>
        </div>

        <div class="mt-3">
            <p class="fw-bold mb-0"><strong>Invoice: </strong> #<?= $sale['invoice'] ?></p>
            <p class="fw-bold"><strong>Kasir: </strong><?= $sale['user_name'] ?></p>
            <p class="mb-0"><strong>Tanggal:</strong> <?= date('d F Y', strtotime($sale['created_at'])) ?></p>
            <p class="mb-0"><strong>Waktu:</strong> <?= date('h:i A', strtotime($sale['created_at'])) ?></p>
            <p><strong>Metode Pembayaran:</strong>
                <?php if ($sale['status'] == 'cash'): ?>
                    <span class="badge bg-success">Tunai</span>
                <?php else : ?>
                    <span class="badge bg-success">Hutang</span>
                <?php endif; ?>
            </p>
        </div>

        <table class="table mt-3">
            <thead class="border-bottom">
                <tr class="fw-bold text-dark">
                    <th>Item</th>
                    <th class="text-end">Harga</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($invoice as $item) : ?>
                    <tr>
                        <td><?= $item['product_name'] ?></td>
                        <td class="text-end"><?= rp($item['product_price']) ?></td>
                        <td class="text-center"><?= $item['quantity'] . '/' . $item['unit_name'] ?></td>
                        <td class="text-end fw-bold"><?= rp($item['subtotal']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="border-top fw-bold text-primary">
                    <td colspan="3">Total</td>
                    <td class="text-end">Rp <?= rp($sale['total']) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="receipt-footer text-center">
            <p class="mb-1 text-secondary">Terima kasih telah berbelanja!</p>
            <p class="text-secondary">Kami tunggu kedatangan Anda kembali!</p>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="<?= route_to('home_product') ?>" class="btn btn- shadow-sm"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
        <button class="btn btn-primary shadow-sm" onclick="printReceipt()">🖨 Cetak Struk</button>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css') ?>
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        /* Ditingkatkan dari 10px agar lebih terbaca */
    }

    .receipt {
        width: 210mm;
        /* height: 297mm; */
        margin: auto;
        padding: 20px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        /* Meningkatkan ukuran font konten */
    }

    .receipt-header {
        border-bottom: 2px dashed #888;
        padding-bottom: 10px;
        text-align: center;
    }

    .receipt-header h5 {
        font-size: 18px;
        /* Memperbesar ukuran font judul toko */
        font-weight: bold;
        color: #007bff;
    }

    .receipt-footer {
        text-align: center;
        font-size: 14px;
        /* Meningkatkan ukuran font footer */
        color: #6c757d;
        margin-top: 10px;
        border-top: 2px dashed #888;
        padding-top: 10px;
    }

    .logo {
        max-width: 70px;
    }

    .table td,
    .table th {
        padding: 8px;
        font-size: 13px;
        /* Meningkatkan ukuran font tabel */
    }

    /* Gaya cetak */
    @media print {
        body {
            font-size: 12px;
        }

        .receipt {
            width: 100%;
            font-size: 13px;
        }

        .btn {
            display: none;
        }
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script>
    function printReceipt() {
        var printElement = document.getElementById('receipt-print').outerHTML;
        var printWindow = window.open('', '_blank');

        printWindow.document.open();
        printWindow.document.write(`
           <html>
    <head>
        <title>Cetak Struk</title>
        <style>
            body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; }
            .receipt { 
                width: 210mm;  
                margin: auto; 
                padding: 20px; 
                background: white; 
                border: 1px solid #ddd; 
                border-radius: 10px; 
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); 
                box-sizing: border-box;
            }
            .receipt-header, .receipt-footer { 
                text-align: center; 
                border-bottom: 2px dashed #888; 
                padding-bottom: 10px; 
            }
            .table { 
                width: 100%; 
                border-collapse: collapse; 
            }
            .table td, .table th { 
                padding: 8px; 
                text-align: left; 
            }
            .border-bottom { 
                border-bottom: 1px solid #000; 
            }
            @media print {
                body { 
                    margin: 0; 
                    padding: 0; 
                }
                .receipt {
                    page-break-before: always; 
                }
            }
        </style>
    </head>
    <body onload="window.print(); window.onafterprint = function() { window.close(); }">
        ${printElement}
    </body>
</html>

        `);
        printWindow.document.close();
    }
</script>
<?= $this->endSection(); ?>