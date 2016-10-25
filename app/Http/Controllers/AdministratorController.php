<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notification;
use File;
use Maatwebsite\Excel\Facades\Excel;

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

        return view('admin/index', ['notifications' => $notifications]);
    }

    public function details($id)
    {
        $notification = Notification::where('id', $id)
            ->first();

        return view('admin/details', ['notification' => $notification]);
    }

    public function export()
    {

        $notification = Notification::select('id', 'name', 'surname', 'email', 'slogan', 'created_at', 'confirmation_date')
            ->orderBy('created_at', 'desc')
            ->orderBy('confirmation_date', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        if ($notification) {

            $notificationArray = $notification->toArray();

            Excel::create('zgloszenia', function ($excel) use ($notificationArray) {

                $excel->setTitle('zgłoszenia do konkursu');
                $excel->setCreator('Ja')->setCompany('SafiStudio');
                $excel->setDescription('Opis');

                $excel->sheet('Sheet1', function ($sheet) use ($notificationArray) {
                    $sheet->setOrientation('landscape');
                    $sheet->row(1, array(
                        'Id',
                        'Imię',
                        'Nazwisko',
                        'Email',
                        'Treść hasła',
                        'Data zgłoszenia',
                        'Data potwierdzenia'
                    ));
                    $sheet->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12);
                    $sheet->getColumnDimension('A')->setAutoSize(true);
                    $sheet->getColumnDimension('B')->setAutoSize(true);
                    $sheet->getColumnDimension('C')->setAutoSize(true);
                    $sheet->getColumnDimension('D')->setAutoSize(true);
                    $sheet->getColumnDimension('E')->setAutoSize(true);
                    $sheet->getColumnDimension('F')->setAutoSize(true);
                    $sheet->getColumnDimension('G')->setAutoSize(true);
                    foreach ($sheet->getRowDimension() as $rd) {
                        $rd->setRowHeight(-1);
                    }
                    $sheet->getStyle('A1:G1')->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'DDDDDD')
                            )
                        )
                    );
                    $sheet->fromArray($notificationArray, NULL, 'A3', false, false);
                });
            })->store('xlsx', storage_path('excel'));

        }

        \Session::flash('flash_message', 'Dane wyeksportowane');

        return redirect('/');
    }
}
