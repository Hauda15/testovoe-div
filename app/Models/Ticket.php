<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'message', 'comment', 'status',
    ];

    protected $casts = [
        'status' => TicketStatus::class,
    ];
}
