<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notification;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function confirm($confirmation_code)
    {
        if (! $confirmation_code) {
            echo "brak kodu";
        }
        $notification = Notification::where('confirmation_code', 'like', $confirmation_code)
            ->first();

        if (! $notification) {
            echo "brak zgłoszenia";
        }

        $notification->confirmed = 1;
        $notification->confirmation_date = Carbon::now('Europe/Warsaw');
        $notification->confirmation_code = null;
        $notification->save();

        \Session::flash('flash_message', 'Udało się zweryfikować konto');

        return view('/front/thanks');

    }
}
