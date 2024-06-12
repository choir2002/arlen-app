@extends('layouts.main')

@section('container')
    
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Retur Barang</h1>
                <!--end::Title-->
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
                    <li class="breadcrumb-item text-muted">Retur Barang</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">

                <!--begin::Secondary button-->
                <!--end::Secondary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
        <div class="fw-bold me-5">
        <span class="me-2" ></span></div>
        <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected"></button>
    </div>
    <!--end::Group actions-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari Retur" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
							<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Tambah Retur</a>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Tanggal Retur</th>
                                <th class="min-w-125px">Nama </th>
                                <th class="min-w-125px">Kategori</th>
                                <th class="min-w-125px">Unit</th>
                                <th class="min-w-125px">Stok</th>
                                {{-- <th class="min-w-125px">Harga Satuan</th> --}}
                                {{-- <th class="min-w-125px">Total</th> --}}
                                <th class="min-w-125px">Retur</th>
                                <th class="min-w-125px">Keterangan</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($returs as $retur)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $retur->date }}</a>
                                </td>
                                <td>{{ $retur->name_product }}</td>
                                <td>{{ $retur->category }}</td>
                                <td>{{ $retur->unit }}</td>
                                <td>{{ $retur->stock }}</td>
                                {{-- <td>{{ $retur->unit_price }}</td> --}}
                                {{-- <td>{{ $retur->total }}</td> --}}
                                <td>{{ $retur->qty }}</td>
                                <td>{{ $retur->information }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<!--begin::Modal - Tambah Produk-->
<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Tambah Retur</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="/retur" method="post">
                    @csrf   
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Tanggal Retur</span>
                        </label>
                        <!--end::Label-->
                        <div class="w-100">
                            <input type="text" class="form-control form-control-solid" name="date" id="date" >
                        </div>
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Produk</span>
                        </label>
                        <!--end::Label-->
                        <div class="w-100">
                            <select name="name_product" id="name_product" class="form-select form-select-solid">
                                <option value="">Pilih Produk</option>
                                @foreach ($produks as $produk)
                                <option value="{{ $produk->name_product }}" data-id-produk="{{ $produk->id }}" data-category="{{ $produk->category }}" data-unit="{{ $produk->unit }}" data-unit-price="{{ $produk->selling_price }}" data-stock="{{ $produk->qty }}">{{ $produk->name_product }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <input type="text" name="category" id="category">
                    <input type="text" name="unit" id="unit">
                    <input type="text" name="stock" id="stock">
                    <input type="text" name="unit_price" id="unit_price">
                    <input type="text" name="total" id="total">
                    <input type="text" name="total_stock" id="total_stock">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Retur</span>
                        </label>
                        <!--end::Label-->
                        <div class="w-100">
                            <input type="text" class="form-control form-control-solid" name="qty" id="qty" >
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Keterangan</span>
                        </label>
                        <!--end::Label-->
                        <div class="w-100">
                            <input type="text" class="form-control form-control-solid" name="information" id="information" >
                        </div>
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
                <div></div></form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Tambah Produk-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
 // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
 function getTodayDate() {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan di JavaScript dimulai dari 0
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Mengatur nilai input tanggal ke tanggal hari ini saat halaman dimuat
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('date').value = getTodayDate();
    });

    // Mengambil data produk dan menghitung total
    $(document).ready(function () {
        $('#name_product').on('change', function () {
            var selectedProduct = $(this).val();
            var selectedOption = $(this).find(':selected');
            var category = selectedOption.data('category');
            var unit = selectedOption.data('unit');
            var stock = selectedOption.data('stock');
            var unitPrice = selectedOption.data('unit-price');
            var idProduk = selectedOption.data('id-produk');

            $('#category').val(category);
            $('#unit').val(unit);
            $('#stock').val(stock);
            $('#unit_price').val(unitPrice);

            // Reset total and qty input fields when product changes
            $('#total').val('');
            $('#qty').val('');
            $('#total_stock').val('');
        });

        // Update total when qty input changes
        $('#qty').on('input', function () {
            var qty = $(this).val();
            var unitPrice = $('#unit_price').val();
            var stock = $('#stock').val();
            var total = qty * unitPrice;
            var totalStok = stock - qty;
            $('#total').val(total);
            $('#total_stock').val(totalStok);
        });
    });
</script>
@endsection