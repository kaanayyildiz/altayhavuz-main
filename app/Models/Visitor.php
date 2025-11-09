<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'date',
    ];

    /**
     * Get today's unique visitors count
     */
    public static function getTodayUniqueVisitors()
    {
        return DB::table('visitors')
            ->whereDate('visited_at', today())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get total unique visitors count
     */
    public static function getTotalUniqueVisitors()
    {
        return DB::table('visitors')
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get today's total visits count
     */
    public static function getTodayTotalVisits()
    {
        return self::whereDate('visited_at', today())->count();
    }

    /**
     * Get total visits count
     */
    public static function getTotalVisits()
    {
        return self::count();
    }

    /**
     * Get visitors count for last 7 days
     */
    public static function getLast7DaysVisitors()
    {
        return DB::table('visitors')
            ->where('visited_at', '>=', Carbon::now()->subDays(7))
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get visits count for last 7 days
     */
    public static function getLast7DaysVisits()
    {
        return self::where('visited_at', '>=', Carbon::now()->subDays(7))->count();
    }
}
