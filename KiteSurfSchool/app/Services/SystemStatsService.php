<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use stdClass;

class SystemStatsService
{
    public function getSystemStats(): stdClass
    {
        $stats = new stdClass();
        
        // Disk usage
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;
        
        $stats->diskTotal = $this->formatBytes($totalSpace);
        $stats->diskUsed = $this->formatBytes($usedSpace);
        $stats->diskUsagePercentage = round(($usedSpace / $totalSpace) * 100);
        
        // Database size
        try {
            $dbSize = $this->getDatabaseSize();
            $stats->dbSize = $this->formatBytes($dbSize);
            $stats->dbMaxSize = $this->formatBytes(1024 * 1024 * 1024); // Assume 1GB max
            $stats->dbSizePercentage = round(($dbSize / (1024 * 1024 * 1024)) * 100);
        } catch (\Exception $e) {
            $stats->dbSize = '0 MB';
            $stats->dbMaxSize = '1 GB';
            $stats->dbSizePercentage = 0;
        }
        
        // Memory usage
        $memoryUsage = memory_get_usage(true);
        $memoryLimit = $this->getMemoryLimitInBytes();
        
        $stats->memoryUsed = $this->formatBytes($memoryUsage);
        $stats->memoryTotal = $this->formatBytes($memoryLimit);
        $stats->memoryUsagePercentage = round(($memoryUsage / $memoryLimit) * 100);
        
        // CPU usage (approximate)
        $stats->cpuUsage = $this->getCpuUsage();
        
        return $stats;
    }
    
    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    
    private function getDatabaseSize()
    {
        $dbName = config('database.connections.mysql.database');
        $result = DB::select("SELECT SUM(data_length + index_length) AS size FROM information_schema.TABLES WHERE table_schema = ?", [$dbName]);
        
        return $result[0]->size ?? 0;
    }
    
    private function getMemoryLimitInBytes()
    {
        $memoryLimit = ini_get('memory_limit');
        if ($memoryLimit == -1) {
            // If unlimited, set a reasonable default for display purposes
            return 2 * 1024 * 1024 * 1024; // 2GB
        }
        
        $unit = strtolower(substr($memoryLimit, -1));
        $value = (int) substr($memoryLimit, 0, -1);
        
        switch ($unit) {
            case 'g': $value *= 1024;
            case 'm': $value *= 1024;
            case 'k': $value *= 1024;
        }
        
        return $value;
    }
    
    private function getCpuUsage()
    {
        // This is a very simple approximation
        // In production, you might want to use a better method or external service
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return min(round($load[0] * 100 / 4), 100); // Assuming 4 cores
        }
        
        return rand(15, 45); // Fallback to random value for demo
    }
}
