<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pesanan (7 Hari Terakhir)';
    protected static ?int $sort = 2; // Urutan tampilan di dashboard

    protected function getData(): array
    {
        
        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Masuk',
                    'data' => [2, 5, 3, 10, 8, 12, 15], // Data dummyseminggu ini
                    'backgroundColor' => '#db2777', 
                    'borderColor' => '#db2777',
                ],
            ],
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Bisa ganti 'bar' atau 'line'
    }
}