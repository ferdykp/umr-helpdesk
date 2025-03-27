<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $role = Auth::check() ? Auth::user()->role : null;

            // Query untuk masing-masing tabel
            $reportQuery = Laporan::query();
            // $wrQuery = Wr::query();
            // $midlifeQuery = Midlife::query();
            // $overhaulQuery = Overhaul::query();
            // $periodicQuery = Periodic::query();
            // $lainnyaQuery = Lainnya::query();
            // $stockCodeQuery = StockCode::query(); // Tambahkan query untuk StockCode

            // Jika role adalah 'supplier', tambahkan filter tertentu
            if ($role === 'user') {
                $reportQuery->where('home_wh', 'UTVH');
                //     $wrQuery->where('home_wh', 'UTVH');
                //     $midlifeQuery->where('home_wh', 'UTVH');
                //     $overhaulQuery->where('home_wh', 'UTVH');
                //     $periodicQuery->where('home_wh', 'UTVH');
                //     $lainnyaQuery->where('home_wh', 'UTVH');
                //     $stockCodeQuery->where('home_wh', 'UTVH'); // Filter StockCode jika perlu
            }

            // Hitung total data untuk masing-masing kategori
            $dataCounts = [
                'reportCount' => $reportQuery->count(),
                // 'wrCount' => $wrQuery->count(),
                // 'midlifeCount' => $midlifeQuery->count(),
                // 'overhaulCount' => $overhaulQuery->count(),
                // 'periodicCount' => $periodicQuery->count(),
                // 'lainnyaCount' => $lainnyaQuery->count(),
                // 'stockCodeCount' => $stockCodeQuery->count(), // Hitung StockCode
            ];

            // Kirim semua data ke view
            $view->with($dataCounts);
        });
    }
}