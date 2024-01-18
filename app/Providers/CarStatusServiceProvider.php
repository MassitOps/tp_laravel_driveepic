<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Car;

class CarStatusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        \DB::table('reservations')
            ->orderBy('id')
            ->chunk(200, function ($reservations) {
                foreach ($reservations as $reservation) {
                    $car = Car::find($reservation->car_id);

                    if ($car) {
                        $car->status = $this->isCarUnavailable($reservation) ? 1 : 0;
                        $car->save();
                    }
                }
        });
    }

    private function isCarUnavailable($reservation)
    {
        $now = now()->toDateString();
        return ($reservation->start_date <= $now) && ($reservation->end_date >= $now);
    }
}
