<?php

namespace App\Console\Commands;

use App\Mail\GreetingMail;
use App\Models\Greeting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendGreeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-greeting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the greeting to the specified email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now('Asia/Manila');

        $greetings = Greeting::where('send_date', $now->toDateString())->get();

        $greetings_count = $greetings->count();

        $this->info("Sending {$greetings_count} scehduled greetings!");

        foreach ($greetings as $greeting) {
            Mail::to($greeting->recipient)->send(
                new GreetingMail($greeting)
            );
        }
    }
}
