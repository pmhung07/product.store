<?php

namespace App\Console\Commands;

use App\Models\EmailMarketingQueue;
use App\Models\EmailMarketingSendMailLog;
use Illuminate\Console\Command;

class EmailMarketingSendEmailQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email-marketing:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email marketing';

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
        $timeStr = date('Y-m-d H:i', time());

        $rows = EmailMarketingQueue::join('email_template', 'email_marketing_queue.template_id', '=', 'email_template.id')
                                    ->select('email_marketing_queue.*', 'email_template.content', 'email_template.title')
                                    ->where('send_schedule_at', $timeStr)
                                    ->get();

        $config = config('mail.from');
        foreach($rows as $row) {
            \Mail::send('layout/mail/send-mail-template', ['title' => $row->title,'content' => $row->content], function ($m) use ($row, $config) {
                $m->from($config['address'], $config['name']);
                $m->to($row->email, $row->email)->subject($row->title);
            });
            $log = new EmailMarketingSendMailLog([
                'campain_id' => $row->campain_id,
                'customer_id' => $row->customer_id,
                'template_id' => $row->template_id
            ]);
            $log->save();
        }
    }
}
