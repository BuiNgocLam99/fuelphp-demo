<?php

namespace Fuel\Tasks;

class Update_Booking_Status
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r update_booking_status
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		echo "\n-------------------------------------------\n\n";
		echo "\nRunning Update booking task";

		$current_time = time();

		$bookings = Model_Booking::find('all', [
            'where' => [
                ['status', '=', 1],
                ['created_at', '<=', $current_time - 5 * 60]
            ]
        ]);

		foreach ($bookings as $booking) {
            $booking->status = 2;
            $booking->save();
        }

		echo "\nUpdate booking task DONE";
		echo "\n-------------------------------------------\n\n";
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r update_booking_status:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Update booking status:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}

}
/* End of file tasks/update_booking_status.php */
