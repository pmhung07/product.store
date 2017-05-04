<?php

namespace App\Console\Commands;

use App\Models\GaData;
use Illuminate\Console\Command;

use Log;

class CronDataGa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:data-ga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron data from google analytics';

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
     * @return mixed
     */
    public function handle()
    {
        Log::info('Ga cron running');

        $startDate = date('Y-m-d', strtotime('-1 day'));
        $endDate   = date('Y-m-d', strtotime('-1 day'));

        $ga = new \Nht\Hocs\GaData();
        $data = $ga->fetch($startDate, $endDate);

        $exits = GaData::where('date', $startDate)->first();

        if(!$exits) {
            $gaModel = new GaData;
            $gaModel->bounce_rate = $data['ga:bounceRate'];
            $gaModel->visit = $data['ga:users'];
            $gaModel->page_view = $data['ga:pageviews'];
            $gaModel->unique_page_view = $data['ga:uniquePageviews'];
            $gaModel->session_duration = $data['ga:sessionDuration'];
            $gaModel->avg_session_duration = $data['ga:avgSessionDuration'];
            $gaModel->time_on_page= $data['ga:timeOnPage'];
            $gaModel->avg_time_on_page = $data['ga:avgTimeOnPage'];
            $gaModel->date = $startDate;
            $gaModel->save();
        } else {
            $exits->updated_at = date('Y-m-d H:i:s');
            $exits->save();
        }
    }
}
