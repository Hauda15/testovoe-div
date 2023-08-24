<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Active = 'Active';
    case Resolved = 'Resolved';
}
