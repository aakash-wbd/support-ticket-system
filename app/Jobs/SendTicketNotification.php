<?php

namespace App\Jobs;

use App\Mail\TicketNotification;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTicketNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $status;
    protected $recipientEmail;

    /**
     * Create a new job instance.
     */
    public function __construct(Ticket $ticket, string $status, string $recipientEmail)
    {
        $this->ticket         = $ticket;
        $this->status         = $status;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recipientEmail)->send(new TicketNotification($this->ticket, $this->status));
    }
}
