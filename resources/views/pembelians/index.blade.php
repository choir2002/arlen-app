@extends('layouts.main')

@section('container')
    
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
                    <li class="breadcrumb-item text-muted"><a href="/pembelian" class="text-muted text-hover-primary">Pembelian Barang</a></li>
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
                <!--begin::Contacts-->
                <div class="card card-flush h-lg-100" id="kt_contacts_main">
                    <!--begin::Card header-->
                    <div class="card-header pt-7" id="kt_chat_contacts_header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-1 me-2">
                            </span>
                            <!--end::Svg Icon-->
                            <h2>Tambah Pembelian Barang Baru</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5">
                        <!--begin::Form-->
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="/pembelian" method="post">
                            @csrf
                            <!--begin::Row-->
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Tanggal Barang Masuk</span>
                                        </label>
                                        <!--end::Label-->
                                        <div class="w-100">
                                            <input type="date" class="form-control form-control-solid flatpickr-input" name="date" id="date">
                                        </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Nama Supplier</span>
                                        </label>
                                        <!--end::Label-->
                                        <select name="name_supplier" id="name_supplier" class="form-select form-select-solid ">
                                            <option value="">Pilih Supplier</option>
                                            @foreach ($suppliers as $supllier)
                                            <option value="{{ $supllier->name }}">{{ $supllier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                     <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-sm-4 ">
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Nama Produk</span>
                                </label>
                                <!--end::Label-->
                                <select name="name_product" id="name_product" class="form-select form-select-solid ">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produks as $produk)
                                    <option value="{{ $produk->name_product }}">{{ $produk->name_product }}</option>
                                    @endforeach
                                </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Kategori</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <input type="text" class="form-control form-control-solid" name="category" id="category" readonly>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Jumlah</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <input type="hidden" class="form-control form-control-solid" name="jumlah_lama" id="jumlah_lama" value="0">
                                    <input type="number" class="form-control form-control-solid" name="qty" id="qty" value="0">
                                    <input type="hidden" class="form-control form-control-solid" name="total_stok" id="total_stok" value="0">
                                    <input type="hidden" class="form-control form-control-solid" name="total_semua" id="total_semua" value="0">
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Unit</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <input type="text" class="form-control form-control-solid" name="unit" id="unit" readonly>
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Harga Satuan</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <input type="number" class="form-control form-control-solid" name="unit_price" id="unit_price" value="0">
                                </div>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-semibold form-label mt-3">
                                    <span class="required">Total</span>
                                </label>
                                <!--end::Label-->
                                <div class="w-100">
                                    <input type="number" class="form-control form-control-solid" name="total" id="total">
                                </div>
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Harga Jual/Unit</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" class="form-control form-control-solid" name="selling_price" id="selling_price">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Separator-->
                    <div class="separator mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Action buttons-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Batal</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Action buttons-->
                     <div></div>
            </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Contacts-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#name_product').on('change', function () {
            var selectedProduct = $(this).val();

            // Ambil data produk yang sesuai dari data yang Anda miliki
            var selectedCategory = {!! $produks->pluck('category', 'name_product') !!};
            var selectedUnit = {!! $produks->pluck('unit', 'name_product') !!};
            var selectedJumlahLama = {!! $produks->pluck('qty', 'name_product') !!};

            // Isi nilai kategori dan unit sesuai dengan produk yang dipilih
            $('#category').val(selectedCategory[selectedProduct]);
            $('#unit').val(selectedUnit[selectedProduct]);
            $('#jumlah_lama').val(selectedJumlahLama[selectedProduct]);
        });
    });

   // Ambil elemen input
    var qtyInput = document.getElementById('qty');
    var unitPriceInput = document.getElementById('unit_price');
    var totalInput = document.getElementById('total');
    var jumlahLamaInput = document.getElementById('jumlah_lama');
    var totalStokInput = document.getElementById('total_stok');
    var totalSemuaInput = document.getElementById('total_semua');

    // Tambahkan event listener untuk menghitung total saat nilai input berubah
    qtyInput.addEventListener('input', calculateTotal);
    unitPriceInput.addEventListener('input', calculateTotal);

    function calculateTotal() {
        // Ambil nilai jumlah, jumlah lama, dan harga satuan
        var qty = parseFloat(qtyInput.value);
        var jumlahLama = parseFloat(jumlahLamaInput.value);
        var unitPrice = parseFloat(unitPriceInput.value);

        // Hitung total
        var total = qty * unitPrice;
        var totalStok = qty + jumlahLama;
        var totalSemua = totalStok * unitPrice;

        // Tampilkan total pada input total dan total stok
        totalInput.value = total; 
        totalStokInput.value = totalStok;
        totalSemuaInput.value = totalSemua;
    }
</script>

@endsection