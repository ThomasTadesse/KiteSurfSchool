<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function toggleMaintenanceMode(Request $request)
    {
        $isMaintenanceMode = (bool) $request->input('maintenance_mode', false);
        
        // Store the maintenance mode state in cache
        Cache::forever('maintenance_mode', $isMaintenanceMode);
        
        if ($isMaintenanceMode) {
            return redirect()->back()->with('success', 'De onderhouds-modus is nu actief.');
        } else {
            return redirect()->back()->with('success', 'De onderhouds-modus is nu uitgeschakeld.');
        }
    }
}
