<?php

namespace App\Jobs;

use App\Mail\ReminderEmail;
use App\Models\Client;
use App\Models\Template;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $templateId;

    /**
     * Create a new job instance.
     *
     * @param string $templateId
     */
    public function __construct($templateId)
    {
        $this->templateId = $templateId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now();
        $template = Template::where('id', $this->templateId)->first();
        $query = Client::query();
        if ($template->include_sent) {
            $clients = $query->orderByDesc('id');
        } else {
            $clients = $query->whereNotNull('is_sent')->orderByDesc('id')->limit($template->count)->get();
        }
        if ($template->count > 0) {
            $clients = $clients->limit($template->count)->get();
        } else {
            $clients = $clients->get();
        }
        dd($clients);
        foreach ($clients as $client) {
            // Simulate sending email (replace with actual Mail facade usage)
            Mail::to($client->email)->send(new ReminderEmail($template));
            $client->update(['send' => $now]);
        }
    }
}
