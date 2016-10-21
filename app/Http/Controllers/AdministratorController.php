<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdministratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showAll()
    {
        $notifications = Notification::paginate(10);

        return view ('admin/index', ['notifications' => $notifications]);
    }

    public function details($id)
    {
        $notification = Notification::where('id', $id)
            ->first();

        return view('admin/details', ['notification' => $notification]);
    }
}
