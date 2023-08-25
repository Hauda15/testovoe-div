<?php

namespace App\Services;

use App\Enums\TicketStatus;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Mail\TicketMail;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

class TicketService
{
    public function storeTicket(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $ticket = new Ticket($data);
        return $ticket->save();
    }

    public function updateTicket(string $id, UpdateTicketRequest $request): bool
    {
        $ticket = Ticket::findOrFail($id);
        if($ticket->update($request->validated())) {
            Mail::to($ticket->email)->send(new TicketMail($ticket));
            return true;
        }
        return false;
    }
}
