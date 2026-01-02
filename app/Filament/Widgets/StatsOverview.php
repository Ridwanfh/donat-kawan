<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format(Order::where('status', 'completed')->sum('total_price'), 0, ',', '.'))
                ->description('Pemasukan dari order selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Grafik dummy kecil untuk estetika

            Stat::make('Order Baru', Order::where('status', 'pending')->count())
                ->description('Menunggu konfirmasi')
                ->descriptionIcon('heroicon-m-bell')
                ->color('warning'),

            Stat::make('Produk Donat', Product::count())
                ->description('Total varian tersedia')
                ->color('primary'),
        ];
    }
}