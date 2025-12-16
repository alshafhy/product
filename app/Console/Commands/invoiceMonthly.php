<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;

class invoiceMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This job issues every user a new invoice on monthly based';

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
         $today = date('Y-m-d');
            $notPayed = DB::table('invoice')->where('date_to', '=', $today)->get();
            if($notPayed){
                $date_to = date('Y-m-d', strtotime('+1 month'));
                foreach ($notPayed as $one){
                    $invoice = array(
                    'user_id' => $one->user_id,
                    'date_from' => $today,
                    'date_to' => $date_to
                    );
                    DB::table('invoice')->insert($invoice);
                    if ($one->state == 0){
                       DB::table('users')
                        ->where('id', $one->user_id)->orWhere('subuser', $one->user_id)
                        ->update(['subuser_No' => 0]);
                    }
                    $user = DB::table('users')->where('id', '=', $one->user_id)->first();
                    Mail::send('emails.didntPay', ['user' => $user], function ($m) use ($user) {
                    //$m->from('info@muqaym.com', 'منصة المقيّم العقاري');
                    $m->to($user->email)->subject('تم إغلاق بعض الخصائص من حسابك, يرجى الإسراع بالسداد');
                });
            }
         }
    }
}
