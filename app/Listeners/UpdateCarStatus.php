<?php

namespace App\Listeners;

use App\Events\ReservationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCarStatus
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(ReservationUpdated $event)
    {
        $reservation = $event->reservation;
        $car = $reservation->car;
        $car->status = $car->reservations()->where('start_date', '<=', now())
                       ->where('end_date', '>=', now())->exists() ? 1 : 0;
        $car->save();
    }
}
