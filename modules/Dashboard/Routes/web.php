<?php

$current_hostname = app(Hyn\Tenancy\Contracts\CurrentHostname::class);

if ($current_hostname) {
    Route::domain($current_hostname->fqdn)->group(function () {
        Route::middleware(['auth', 'locked.tenant'])->group(function () {
            Route::redirect('/', '/dashboard');
            Route::prefix('dashboard')->group(function () {
                Route::get('/', 'DashboardController@index')->name('tenant.dashboard.index');
                Route::get('filter', 'DashboardController@filter');
                Route::get('stock-by-product/records', 'DashboardController@stockByProduct');
            });
            //Commands
            Route::get('command/df', 'DashboardController@df')->name('command.df');
        });
    });
}
