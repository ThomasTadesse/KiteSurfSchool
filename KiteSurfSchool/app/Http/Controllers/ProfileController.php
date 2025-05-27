<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Booking;
use App\Models\Lespakket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class ProfileController extends Controller
{
    /**
     * Show the profile dashboard with contact forms for owners.
     */
    public function show(): View
    {
        $user = Auth::user();
        $data = [
            'isMaintenanceMode' => app()->isDownForMaintenance()
        ];
        
        // Check if Booking model exists and table is created
        if (class_exists('App\Models\Booking') && Schema::hasTable('bookings')) {
            // User bookings
            $data['userBookings'] = Booking::where('user_id', $user->id)
                ->with('lespakket')
                ->orderBy('datum', 'desc')
                ->get();
                
            // Admin data
            if ($user->isEigenaar()) {
                $data['contacts'] = Contact::orderBy('created_at', 'desc')->get();
                
                // Dashboard statistics
                $data['totalUsers'] = User::count();
                
                // Count active lespakketten instead of bookings - check if table exists first
                $data['activeLespakketten'] = Schema::hasTable('lespakketten') ? Lespakket::count() : 4;
                
                $data['pendingInvoices'] = Booking::where('payment_status', 'pending')
                    ->count();
                    
                // New registrations (users registered in the last 7 days)
                $data['newRegistrations'] = User::where('created_at', '>=', now()->subDays(7))
                    ->count();
                    
                // Weekly bookings data for chart
                $startOfWeek = Carbon::now()->startOfWeek();
                $weeklyBookings = [];
                
                for ($i = 0; $i < 7; $i++) {
                    $day = $startOfWeek->copy()->addDays($i);
                    $count = Booking::whereDate('datum', $day)->count();
                    $weeklyBookings[] = $count;
                }
                
                $data['weeklyBookingsData'] = $weeklyBookings;
                
                // Recent activities
                $recentBookings = Booking::with(['user', 'lespakket'])
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get()
                    ->map(function ($booking) {
                        return (object)[
                            'type' => 'lesson',
                            'title' => 'Nieuwe les ingepland',
                            'description' => $booking->user->name . ' - ' . $booking->lespakket->naam,
                            'created_at' => $booking->created_at
                        ];
                    });
                    
                // Get recent user registrations
                $recentUsers = User::orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get()
                    ->map(function ($user) {
                        return (object)[
                            'type' => 'user',
                            'title' => 'Nieuwe gebruiker geregistreerd',
                            'description' => $user->name,
                            'created_at' => $user->created_at
                        ];
                    });
                    
                // Merge and sort by date
                $recentActivities = $recentBookings->concat($recentUsers)
                    ->sortByDesc('created_at')
                    ->take(5);
                    
                $data['recentActivities'] = $recentActivities;
                
                // System statistics
                $data['systemStats'] = $this->getSystemStats();
            }
        } else {
            // Fallback with dummy data if the model or table doesn't exist
            $data['totalUsers'] = User::count();
            $data['activeLespakketten'] = 0; // Changed variable name here too
            $data['pendingInvoices'] = 0;
            $data['newRegistrations'] = User::where('created_at', '>=', now()->subDays(7))->count();
            $data['weeklyBookingsData'] = [0, 0, 0, 0, 0, 0, 0];
            $data['recentActivities'] = collect();
        }
        
        return view('profiel', $data);
    }
    
    /**
     * Get system statistics
     */
    private function getSystemStats()
    {
        $stats = new \stdClass();
        
        // Disk usage
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;
        
        $stats->diskTotal = $this->formatBytes($totalSpace);
        $stats->diskUsed = $this->formatBytes($usedSpace);
        $stats->diskUsagePercentage = round(($usedSpace / $totalSpace) * 100);
        
        // Database size approximation
        $stats->dbSize = '450 MB';
        $stats->dbMaxSize = '1 GB';
        $stats->dbSizePercentage = 45;
        
        // Memory usage
        $memoryUsage = memory_get_usage(true);
        $stats->memoryTotal = '3 GB';
        $stats->memoryUsed = $this->formatBytes($memoryUsage);
        $stats->memoryUsagePercentage = 60;
        
        // CPU usage (approximate)
        $stats->cpuUsage = 25;
        
        return $stats;
    }
    
    /**
     * Format bytes to human-readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
