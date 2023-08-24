<?php

namespace App\Jobs;

use App\Models\Ticket;
use App\Models\TicketArchive;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MoveResolvedTickets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $items = Ticket::where('status', 'Resolved')->get();
        $items = $items->makeHidden(['id'])->toArray();
        TicketArchive::insert($items);
        Ticket::where('status', 'Resolved')->delete();
    }
}
