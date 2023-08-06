<?php

namespace App\Models;

use App\Models\User;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\OrderProducts;
use App\Models\OrderSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_schedule()
    {
        return $this->hasMany(OrderSchedule::class, 'order_id');
    }
    public function order_products()
    {
        return $this->hasMany(OrderProducts::class, 'order_id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }  
    // public static function totalSalesByMonth()
    // {
    //     $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    //     $query = DB::table('orders')
    //         ->selectRaw('MONTH(created_at) as month, COALESCE(SUM(total), 0) as total_sales')
    //         ->groupBy('month');
        
    //     $queries = [];
        
    //     foreach ($months as $month) {
    //         $queries[] = $query->clone()->whereRaw('MONTH(created_at) = ?', [$month]);
    //     }
        
    //     $unionQuery = implode(' UNION ', array_map(function ($q) {
    //         return '(' . $q->toSql() . ')';
    //     }, $queries));
        
    //     $results = DB::table(DB::raw("($unionQuery) AS union_result"))
    //         ->mergeBindings($queries)
    //         ->selectRaw('month, SUM(total_sales) as total_sales')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get()
    //         ->map(function ($item) use ($months) {
    //             $item->month_name = 'Tháng ' . $item->month;
    //             return $item;
    //         });
        
    //     return $results;
    // }
}