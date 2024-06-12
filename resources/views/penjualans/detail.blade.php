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
                    <li class="breadcrumb-item text-muted"><a href="/laporan-penjualan" class="text-muted text-hover-primary">Laporan Penjualan</a></li>
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
                            <h2>Data Detail Penjualan</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-5">
                        <!--begin::Form-->
                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Transaksi #{{ $penjualans->id }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-175px">Item</th>
                                                <th class="min-w-100px text-end"></th>
                                                <th class="min-w-70px text-end">Jumlah</th>
                                                <th class="min-w-100px text-end">Harga</th>
                                                <th class="min-w-100px text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Products-->
                                            @foreach ($detail_penjualans as $detail_penjualan)
                                            <tr>
                                                <!--begin::Product-->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <a href="" class="fw-bold text-gray-600 text-hover-primary">{{ $detail_penjualan->name_product }}</a>
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <!--end::Product-->
                                                <!--begin::SKU-->
                                                <td class="text-end"></td>
                                                <!--end::SKU-->
                                                <!--begin::Quantity-->
                                                <td class="text-end">{{ $detail_penjualan->qty }}</td>
                                                <!--end::Quantity-->
                                                <!--begin::Price-->
                                                <td class="text-end">{{ $detail_penjualan->unit_price }}</td>
                                                <!--end::Price-->
                                                <!--begin::Total-->
                                                <td class="text-end">{{ $detail_penjualan->total }}</td>
                                                <!--end::Total-->
                                            </tr>
                                            @endforeach
                                            <!--begin::Subtotal-->
                                            <tr>
                                                <td colspan="4" class="text-end">Subtotal</td>
                                                <td class="text-end">{{ $penjualans->subtotal }}</td>
                                            </tr>
                                            <!--end::Subtotal-->
                                            <!--begin::VAT-->
                                            <tr>
                                                <td colspan="4" class="text-end">Diskon</td>
                                                <td class="text-end">{{ $penjualans->discount }}</td>
                                            </tr>
                                            <!--end::VAT-->
                                            <!--begin::Grand total-->
                                            <tr>
                                                <td colspan="4" class="fs-3 text-dark text-end">Total Bayar</td>
                                                <td class="text-dark fs-3 fw-bolder text-end">{{ $penjualans->total_payment }}</td>
                                            </tr>
                                            <!--end::Grand total-->
                                        </tbody>
                                        <!--end::Table head-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
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


@endsection