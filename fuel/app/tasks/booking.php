<?php

namespace Fuel\Tasks;

class Booking
{
    public static function run($speech = null)
    {
        $bookings = \Model_Booking::query()
            ->where('status', '=', 1)
            ->get();

        foreach ($bookings as $booking) {
            $booking->status = 2;
            $booking->updated_at = \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S');
            $booking->save();
        }

        echo "Đã cập nhật " . count($bookings) . " bản ghi.\n";
    }
}
