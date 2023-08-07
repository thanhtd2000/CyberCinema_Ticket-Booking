<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Orders;
use App\Models\OrderSchedule;
use Illuminate\Console\Command;
use Google\Cloud\Firestore\Admin\V1\Index\IndexField\Order;

class DeleteOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'records:deleteorder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xoá hoá đơn chưa thanh toán và ghế đã giữ quá time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timeAdd = Carbon::now()->subMinutes(5);
        
        $order =  Orders::where('created_at', '<=', $timeAdd)->where('status', 1)->first();
        if (isset($order)) {
            $order->update(['status' => 3]);
            OrderSchedule::where('order_id', $order->id)->delete();
        }
        OrderSchedule::where('created_at', '<=', $timeAdd)->where('status', 1)->forceDelete();
        $this->info('Xoá bản ghi thành công');
    }
}
