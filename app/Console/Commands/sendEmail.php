<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Models\Client;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email {--template= : The email template to use}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

//    public function send(Template $template, array $client): string
//    {
//        $mailer = Mail::build([
//            'transport' => 'mailgun',
//        ]);
//
//        $message = $mailer->to($client['email'])->send(new ReminderEmail($template));
//
//        return trim($message->getMessageId(), '<>');
//    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $templateId = $this->option('template');
        sleep(15);
        Log::info('Success Run : ' . $templateId);
//        $now = Carbon::now();
//
//        $templates = Template::where('schedule_time', '<=', $now)->get();
//
//        foreach ($templates as $template) {
//            $query = Client::query();
//
//            // Apply conditions based on include_sended
//            if ($template->include_sended) {
//                $clients = $query->orderByDesc('id')->limit($template->count)->get();
//            } else {
//                $clients = $query->whereNotNull('is_sent')->orderByDesc('id')->limit($template->count)->get();
//            }
//
//            foreach ($clients as $client) {
//                // Simulate sending email (replace with actual Mail facade usage)
//                Mail::raw($template->content, function ($message) use ($client, $template) {
//                    $message->to($client->email)
//                        ->subject('Scheduled Email: ' . $template->name)
//                        ->from('smtp@fmcsafiling.com');
//                });
//
//                // Update client's send timestamp (optional, based on logic)
//                $client->update(['send' => $now]);
//            }
//
//            // Reset schedule_time after processing
//            $template->update(['schedule_time' => null]);
//        }
//
//        $this->info('Email sending process completed at ' . $now);
    }
}
