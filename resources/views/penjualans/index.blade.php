@extends('layouts.main')

@section('container')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="d-flex flex-column flex-column-fluid">
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/dashboard" class="text-muted text-hover-primary">Beranda</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><a href="/penjualan" class="text-muted text-hover-primary">Penjualan Barang</a></li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="row gy-5 g-xl-10">
            <!-- Form -->
            <div class="col-xl-6">
                <form class="card h-md-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="fw-bold text-gray-900 m-0">Transaksi #{{ $nextSaleId }}</h3>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Tanggal Hari Ini</span>
                                    </label>
                                    <input type="text" name="tanggal_visual" id="tanggal_visual" class="form-control form-control-solid" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nama Kasir</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" value="{{auth()->user()->name}}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nama Produk</span>
                                    </label>
                                    <div class="w-100">
                                        <select name="name_product" id="name_product" class="form-select form-select-solid">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                            <option value="{{ $produk->name_product }}" data-id-produk="{{ $produk->id }}" data-unit-price="{{ $produk->selling_price }}" data-qty="{{ $produk->qty }}">{{ $produk->name_product }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Jumlah</span>
                                    </label>
                                    <input type="number" name="qty" id="qty" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_produk" id="id_produk">
                        <input type="hidden" name="jumlah_lama" id="jumlah_lama" class="form-control form-control-solid" >
                        <input type="hidden" name="unit_price" id="unit_price" class="form-control form-control-solid" >
                        
                        <input type="hidden" name="total_stok" id="total_stok" class="form-control form-control-solid" >
                        <input type="hidden" name="total_harga" id="total_harga" class="form-control form-control-solid" >
                        
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <button id="tambahBtn" type="button" class="btn btn-primary">
                                    <span class="indicator-label">Tambah</span>
                                    <span class="indicator-progress">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Tap pane-->
                            <div class="tab-pane fade show active" id="kt_stats_widget_2_tab_1" role="tabpanel">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                <th class="ps-0 w-50px">ITEM</th>
                                                <th class="text-end min-w-140px">Jumlah</th>
                                                <th class="pe-0 text-end min-w-120px">Harga</th>
                                                <th class="pe-0 text-end min-w-120px">Total Harga</th>
                                                <th class="pe-0 text-end min-w-120px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        {{-- <tbody> --}}
                                        <tbody id="itemTableBody">
                                            <!-- Data produk akan ditampilkan di sini -->
                                            @php
                                                $subtotal = 0;
                                            @endphp
                                            @foreach ($detail_penjualans as $detail_penjualan)
                                                @if ($detail_penjualan->sale_id == $nextSaleId)

                                                <tr>
                                                    <td>{{ $detail_penjualan->name_product }}</td>
                                                    <td class="text-end">{{ $detail_penjualan->qty }}</td>
                                                    <td class="text-end">{{ $detail_penjualan->unit_price }}</td>
                                                    <td class="text-end">{{ $detail_penjualan->total }}</td>
                                                    <td class="text-end">
                                                        <form id="hapusForm" action="/penjualan-hapus/{{ $detail_penjualan->id }}" method="POST" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="hapusData()" class="menu-link px-3 border-hover-transparent border-transparent btn btn-block ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 100 100">
                                                                        <path fill="#f37e98" d="M25,30l3.645,47.383C28.845,79.988,31.017,82,33.63,82h32.74c2.613,0,4.785-2.012,4.985-4.617L75,30"></path>
                                                                        <path fill="#f15b6c" d="M65 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S65 36.35 65 38zM53 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S53 36.35 53 38zM41 38v35c0 1.65-1.35 3-3 3s-3-1.35-3-3V38c0-1.65 1.35-3 3-3S41 36.35 41 38zM77 24h-4l-1.835-3.058C70.442 19.737 69.14 19 67.735 19h-35.47c-1.405 0-2.707.737-3.43 1.942L27 24h-4c-1.657 0-3 1.343-3 3s1.343 3 3 3h54c1.657 0 3-1.343 3-3S78.657 24 77 24z"></path>
                                                                        <path fill="#1f212b" d="M66.37 83H33.63c-3.116 0-5.744-2.434-5.982-5.54l-3.645-47.383 1.994-.154 3.645 47.384C29.801 79.378 31.553 81 33.63 81H66.37c2.077 0 3.829-1.622 3.988-3.692l3.645-47.385 1.994.154-3.645 47.384C72.113 80.566 69.485 83 66.37 83zM56 20c-.552 0-1-.447-1-1v-3c0-.552-.449-1-1-1h-8c-.551 0-1 .448-1 1v3c0 .553-.448 1-1 1s-1-.447-1-1v-3c0-1.654 1.346-3 3-3h8c1.654 0 3 1.346 3 3v3C57 19.553 56.552 20 56 20z"></path>
                                                                        <path fill="#1f212b" d="M77,31H23c-2.206,0-4-1.794-4-4s1.794-4,4-4h3.434l1.543-2.572C28.875,18.931,30.518,18,32.265,18h35.471c1.747,0,3.389,0.931,4.287,2.428L73.566,23H77c2.206,0,4,1.794,4,4S79.206,31,77,31z M23,25c-1.103,0-2,0.897-2,2s0.897,2,2,2h54c1.103,0,2-0.897,2-2s-0.897-2-2-2h-4c-0.351,0-0.677-0.185-0.857-0.485l-1.835-3.058C69.769,20.559,68.783,20,67.735,20H32.265c-1.048,0-2.033,0.559-2.572,1.457l-1.835,3.058C27.677,24.815,27.351,25,27,25H23z"></path>
                                                                        <path fill="#1f212b" d="M61.5 25h-36c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h36c.276 0 .5.224.5.5S61.776 25 61.5 25zM73.5 25h-5c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h5c.276 0 .5.224.5.5S73.776 25 73.5 25zM66.5 25h-2c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h2c.276 0 .5.224.5.5S66.776 25 66.5 25zM50 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v25.5c0 .276-.224.5-.5.5S52 63.776 52 63.5V38c0-1.103-.897-2-2-2s-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2v-3.5c0-.276.224-.5.5-.5s.5.224.5.5V73C53 74.654 51.654 76 50 76zM62 76c-1.654 0-3-1.346-3-3V47.5c0-.276.224-.5.5-.5s.5.224.5.5V73c0 1.103.897 2 2 2s2-.897 2-2V38c0-1.103-.897-2-2-2s-2 .897-2 2v1.5c0 .276-.224.5-.5.5S59 39.776 59 39.5V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C65 74.654 63.654 76 62 76z"></path>
                                                                        <path fill="#1f212b" d="M59.5 45c-.276 0-.5-.224-.5-.5v-2c0-.276.224-.5.5-.5s.5.224.5.5v2C60 44.776 59.776 45 59.5 45zM38 76c-1.654 0-3-1.346-3-3V38c0-1.654 1.346-3 3-3s3 1.346 3 3v35C41 74.654 39.654 76 38 76zM38 36c-1.103 0-2 .897-2 2v35c0 1.103.897 2 2 2s2-.897 2-2V38C40 36.897 39.103 36 38 36z"></path>
                                                                    </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    // Tambahkan total penjualan ke subtotal
                                                    $subtotal += $detail_penjualan->total;
                                                @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--end::Tap pane-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </form>
            </div>
            <!-- End Form -->
            <!-- List of Items -->
            <div class="col-xl-6">
            <form method="post" action="/penjualan"  id="penjualanForm">
                @csrf
                <div class="card h-md-100">
                    <div class="card-header py-5">
                            <div class="fv-row mb-0">
                                <label class="fs-6 fw-semibold form-label mt-0">
                                    <span class="">Diskon</span>
                                </label>
                                <input type="number" name="discount" id="discount" class="form-control form-control-solid">
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="fv-row mb-0">
                                <label class="fs-6 fw-semibold form-label mt-0">
                                    <span class="required">Tunai</span>
                                </label>
                                <input type="number" name="cash" id="cash" class="form-control form-control-solid">
                            </div>
                            <div class="fv-row mb-0">
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Kembalian</span>
                                </label>
                                <input type="number" name="return" id="return" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-10 m-3">
                            <div class="fs-6 fw-bold text-white">
                                <span class="d-block lh-1 mb-2">Subtotal</span>
                                <span class="d-block mb-2">Diskon</span>
                                <span class="d-block fs-2qx lh-1">Total Bayar</span>
                            </div>
                            <div class="fs-6 fw-bold text-white text-end">
                                <span class="d-block lh-1 mb-2" id="subtotal_d">Rp. {{ number_format($subtotal, 2) }}</span>
                                <span class="d-block mb-2" id="discount_display"></span>
                                <span class="d-block fs-2qx lh-1" id="total_payment_d"></span>
                            </div>
                        </div>

                            <input type="hidden" name="date" id="date" class="form-control form-control-solid" readonly>
                            <input type="hidden" name="no_sale" id="no_sale" value="{{ $nextSaleId }}" class="form-control form-control-solid">
                            <input type="hidden" name="name_cashier" id="name_cashier" value="{{auth()->user()->name}}" class="form-control form-control-solid">
                            <input type="hidden" name="subtotal" id="subtotal" class="form-control form-control-solid">
                            <input type="hidden" name="total_payment" id="total_payment" class="form-control form-control-solid">
                            <input type="hidden" name="export" id="exportPdf" value="">
                            <div class="m-5">
                                <div class="button-container d-flex justify-content-between">
                                    <button type="button"  id="saveAsPdfButton" class="btn btn-primary fs-3 w-40 py-3">Simpan & Cetak Struk</button>
                                    <button type="button" id="saveButton" class="btn btn-primary fs-3 w-40 py-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End List of Items -->
        </div>
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
</div>

<script>
// Mendapatkan elemen input tanggal visual berdasarkan ID
var tanggalVisualInput = document.getElementById('tanggal_visual');

// Mendapatkan elemen input tanggal berdasarkan ID
var tanggalDateInput = document.getElementById('date');

// Mendapatkan tanggal hari ini
var today = new Date();

// Menyimpan nama bulan dalam array
var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

// Mendapatkan tanggal, bulan, dan tahun hari ini
var day = today.getDate();
var monthIndex = today.getMonth();
var year = today.getFullYear();

// Format tanggal visual
var formattedDateVisual = day + ' ' + months[monthIndex] + ' ' + year;

// Set nilai input tanggal visual
tanggalVisualInput.value = formattedDateVisual;

// Set nilai input tanggal date dengan tanggal hari ini (format default)
tanggalDateInput.value = today.toISOString().slice(0, 10);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
//mengambil data produk
$(document).ready(function () {
    $('#name_product').on('change', function () {
        var selectedProduct = $(this).val();
        var selectedOption = $(this).find(':selected');
        var unitPrice = selectedOption.data('unit-price');
        var qty = selectedOption.data('qty');
        var idProduk = selectedOption.data('id-produk');

        $('#unit_price').val(unitPrice);
        $('#jumlah_lama').val(qty);
        $('#id_produk').val(idProduk);
    });
});

// Fungsi untuk menambahkan item ke dalam database penjualan
function addItemToDatabase() {
    var sale_id = $('#no_sale').val();
    var productName = $('#name_product').val();
    var qty = $('#qty').val();
    var unitPrice = $('#unit_price').val();
    var totalHargaItem = $('#total_harga').val();

    $.ajax({
        type: 'POST',
        url: '/penjualan/add-item',
        data: {
            _token: '{{ csrf_token() }}',
            sale_id: sale_id,
            productName: productName,
            qty: qty,
            unitPrice: unitPrice,
            totalHargaItem: totalHargaItem,
        },
        success: function(response) {
            console.log('Data berhasil disimpan ke database penjualan');
            calculateTotal();
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
            if (xhr.responseText) {
                console.error('Detail error:', xhr.responseText);
            }
        }
    });
}

// Fungsi untuk mengupdate data di tabel produk
function updateProductData() {
    var idProduk = $('#id_produk').val();
    var totalStok = $('#total_stok').val();

    $.ajax({
        type: 'POST',
        url: '/penjualan/update-produk',
        data: {
            _token: '{{ csrf_token() }}',
            idProduk: idProduk,
            totalStok: totalStok,
        },
        success: function(response) {
            console.log('Data produk berhasil diperbarui');
            // Lakukan tindakan lain jika diperlukan setelah pembaruan
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
            if (xhr.responseText) {
                console.error('Detail error:', xhr.responseText);
            }
        }
    });
}

// Event listener untuk tombol tambah
$(document).ready(function() {
    $('#tambahBtn').click(function(e) {
        e.preventDefault();
        addItemToDatabase(); // Panggil fungsi untuk menyimpan data penjualan
        updateProductData(); // Panggil fungsi untuk memperbarui data produk
    });
});

function hapusData() {
    fetch('/penjualan-hapus/{{ $detail_penjualan->id }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Terjadi kesalahan saat menghapus data.');
        }
        return response.json();
    })
    .then(data => {
        // Handle response jika diperlukan
        // Contoh: Tampilkan pesan sukses, atau perbarui tampilan
        console.log(data);
        // Merefresh halaman otomatis setelah 2 detik
        setTimeout(function(){
            window.location.reload();
        }, 1000); // waktu dalam milidetik (2 detik dalam contoh ini)
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


// Ambil elemen input
var qtyInput = document.getElementById('qty');
var jumlahLamaInput = document.getElementById('jumlah_lama');
var totalStokInput = document.getElementById('total_stok');
var hargaBarangInput = document.getElementById('unit_price');
var totalHargaInput = document.getElementById('total_harga');

// Tambahkan event listener untuk menghitung total saat nilai input berubah
qtyInput.addEventListener('input', calculateTotal);

function calculateTotal() {
// Ambil nilai jumlah, jumlah lama, dan harga satuan
var qty = parseFloat(qtyInput.value);
var jumlahLama = parseFloat(jumlahLamaInput.value);
var hargaBarang = parseFloat(hargaBarangInput.value);

// Hitung total
var totalStok = jumlahLama - qty;
var totalHarga = qty * hargaBarang;

// Tampilkan total pada input total dan total stok
totalStokInput.value = totalStok;
totalHargaInput.value = totalHarga;

// Ambil nilai subtotal, diskon, dan tunai
var subtotal = parseFloat($('#subtotal_d').text().replace('Rp.', '').replace(',', ''));
var discount = parseFloat($('#discount').val() || 0);
var cash = parseFloat($('#cash').val());

// Hitung total pembayaran setelah diskon
var totalPayment = subtotal - discount;
var totalKembalian = cash - totalPayment;

// Tampilkan nilai diskon dan total pembayaran setelah diskon
$('#discount_display').text('-Rp.' + discount.toLocaleString());

// Jika diskon tidak diinput, total pembayaran tetap subtotal
if ($('#discount').val() === "") {
    totalPayment = subtotal;
}
$('#total_payment').val(Math.floor(totalPayment));
$('#subtotal').val(Math.floor(subtotal));

$('#total_payment_d').text('Rp.' + totalPayment.toLocaleString());
// Tampilkan nilai kembalian
$('#return').val(totalKembalian);
}

// Tambahkan event listener untuk menghitung total saat nilai input diskon berubah
var discountInput = document.getElementById('discount');
discountInput.addEventListener('input', calculateTotal);

var cashInput = document.getElementById('cash');
cashInput.addEventListener('input', calculateTotal);

document.addEventListener('DOMContentLoaded', function () {
        // Ambil tombol "Simpan" dan "Simpan sebagai PDF"
        var saveButton = document.getElementById('saveButton');
        var saveAsPdfButton = document.getElementById('saveAsPdfButton');

        // Tambahkan event listener untuk tombol "Simpan sebagai PDF"
        saveAsPdfButton.addEventListener('click', function () {
            // Set nilai input hidden 'export' menjadi 'pdf'
            document.getElementById('exportPdf').value = 'pdf';
            // Submit formulir
            document.getElementById('penjualanForm').submit();
        });

        // Tambahkan event listener untuk tombol "Simpan"
        saveButton.addEventListener('click', function () {
            // Kosongkan nilai input hidden 'export'
            document.getElementById('exportPdf').value = '';
            // Submit formulir
            document.getElementById('penjualanForm').submit();
        });
    });

</script>

@endsection
