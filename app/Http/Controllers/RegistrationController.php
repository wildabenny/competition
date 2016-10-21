<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

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

        return redirect('/');

    }
}
