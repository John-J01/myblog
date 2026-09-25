<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function migrate()
    {
        Artisan::call('db:seed');
        return 'DONE';
    }

    public function clear_cache()
    {
        Artisan::call('config:cache');
        return 'DONE';
    }
}
