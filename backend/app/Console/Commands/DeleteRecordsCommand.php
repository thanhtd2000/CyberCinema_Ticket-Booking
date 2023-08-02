<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\OrderSchedule;
use Illuminate\Console\Command;

class DeleteRecordsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'records:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $timeAdd = Carbon::now()->subMinutes(1);

        OrderSchedule::where('created_at', '<=', $timeAdd)->where('status', 1)->where('order_id', null)->forceDelete();

        $this->info('Records deleted successfully.');
    }
}
