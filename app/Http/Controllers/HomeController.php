<?php

namespace App\Http\Controllers;

use App\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.welcome');
    }

    public function store(Request $request, Notification $notification)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:notifications',
            'city' => 'required',
            'zipcode' => 'required|max:6',
            'slogan' => 'required',
            'fileurl' => 'required'
        ]);

        if ($validator->fails()) {

            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }
        $confirmation_code = str_random(30);

        if ($request->fileurl) {
            $file = $request->file('fileurl');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $notification->fileurl = $fileName;
            $notification->name = $request->name;
            $notification->surname = $request->surname;
            $notification->zipcode = $request->zipcode;
            $notification->city = $request->city;
            $notification->slogan = $request->slogan;
            $notification->email = $request->email;
            $notification->confirmation_code = $confirmation_code;
            $notification->created_at = Carbon::now('Europe/Warsaw');

            $notification->save();

        }
        Mail::send('front.verify', ['notifications' => $notification, 'confirmation_code' => $confirmation_code], function ($message) use ($notification) {
            $message->to($notification->email, $notification->name)->subject('Potwierdz adres email');
        });

        \Session::flash('flash_message', 'Dziękujemy za wysłanie zgłoszenia');

        return redirect('/');

    }
}
