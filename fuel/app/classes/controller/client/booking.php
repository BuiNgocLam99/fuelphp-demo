<?php

class Controller_Client_Booking extends Controller_Template
{
    public $template = 'client/template';

    public function before()
    {
        parent::before();

        Controller_Auth::checkClient();

        $this->template->title = 'Prefecture';
    }

    public function action_index()
    {
        if (Input::method() == 'POST') {
            $datetime_from = Input::post('datetime_from');
            $datetime_to = Input::post('datetime_to');
            $hotel_id = Input::post('hotel_id');

            if (empty($datetime_from) || empty($datetime_to)) {
                return Response::forge(json_encode([
                    'status' => 'error',
                    'message' => 'Both "datetime_from" and "datetime_to" are required.'
                ]), 400);
            }

            if (new DateTime($datetime_from) >= new DateTime($datetime_to)) {
                return Response::forge(json_encode([
                    'status' => 'error',
                    'message' => 'The "From" datetime must be earlier than the "To" datetime.'
                ]), 400);
            }
            

            try {

                $booking = Model_Booking::forge([
                    'hotel_id' => $hotel_id,
                    'user_id' => Auth::get_user_id()[1],
                    'customer_name' => Auth::get_screen_name(),
                    'customer_contact' => Auth::get_email(),
                    'checkin_time' => $datetime_from,
                    'checkout_time' => $datetime_to,
                    'created_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                    'updated_at' => \Fuel\Core\Date::forge()->format('%Y-%m-%d %H:%M:%S'),
                ]);

                $booking->save();
                return Response::forge(json_encode([
                    'status' => 'success',
                    'message' => 'Booking successfully.'
                ]), 200);
            } catch (Exception $e) {
                return Response::forge(json_encode([
                    'status' => 'error',
                    'message' => 'An error occurred!'
                ]), 400);
            }
        }

        $data = [];

        if (Auth::check()) {
            $user = Model_User::query()
                ->related('booking_list')
                ->related('booking_list.hotel')
                ->related('booking_list.hotel.prefecture')
                ->where('id', Auth::get_user_id()[1])
                ->get();

            $data = [
                'auth' => true,
                'user' => reset($user),
            ];
        } else {
            $data = [
                'auth' => false,
                'message' => 'Please login to view booking list.'
            ];
        }

        $this->template->title = 'Booking';
        $this->template->content = View::forge('client/booking/index', $data);
    }
}