<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', 'Active')->get();
        return response($tickets, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        dd($request->validated());
        $ticket = new Ticket($request->validated());
        if($ticket->save()) {
            return response(
                'Заявка успешно отправлена!', 200
            )->header('Content-Type', 'text/plain');
        } else {
            return response(
                'Ошибка при отправке заявки. Проверьте данные.', 400
            )->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->validated());
        return response($ticket, 200);
    }

    public function create()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
