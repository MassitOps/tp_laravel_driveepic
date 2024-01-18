<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationUpdated
{
    use Dispatchable, SerializesModels;

    public $reservation;
    
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }
}
