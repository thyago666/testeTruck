<?php

namespace App\Http\Controllers;
USE DB;
use App\Models\Historic;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiDetails()
    {
      $lastHistoric = Historic::latest('created_at')->first();
      $uptime = exec('uptime');
      $databaseConnectionStatus = DB::connection()->getPdo() ? 'Connected' : 'Not connected';
      $memoryUsage = memory_get_usage(true);
  
      return response()->json([
            'database_connection' => $databaseConnectionStatus,
            'last_cron_execution' => $lastHistoric->created_at,
            'uptime' => $uptime,
            'memory_usage' => $memoryUsage,
        ]);
    }
}
