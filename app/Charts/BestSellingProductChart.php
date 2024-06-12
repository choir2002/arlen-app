<?php

namespace App\Charts;

use App\Models\DetailPenjualan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BestSellingProductChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        // Mendapatkan produk terlaris dan menggabungkan kuantitas berdasarkan nama produk
        $produkTerlaris = DetailPenjualan::select('name_product', \DB::raw('SUM(qty) as total_qty'))
            ->groupBy('name_product')
            ->orderBy('total_qty', 'desc')
            ->get();

        // Menyiapkan data untuk chart
        $productNames = $produkTerlaris->pluck('name_product')->toArray();
        $totalQty = $produkTerlaris->pluck('total_qty')->toArray();

        return $this->chart->barChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData('Jumlah Terjual', $totalQty)
            ->setXAxis($productNames);
    }
}
