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
        $threshold = Carbon::now()->subMinutes(5);

        OrderSchedule::where('created_at', '<=', $threshold)->where('status', 1)->delete();

        $this->info('Records deleted successfully.');
    }
}
