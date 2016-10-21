@extends('layouts.layout-admin')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading" style="text-align: center">Zgłoszenia</div>
    </div>

    <div class="container">
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Data zgłoszenia</th>
                <th>Potwierdzone</th>
                <th>Data potwierdzenia</th>
                <th>Szczegóły</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <th scope="row">{{$notification->id}}</th>
                    <td>{{$notification->name}}</td>
                    <td>{{$notification->surname}}</td>
                    <td>{{$notification->created_at}}</td>
                    <td>
                        @if ($notification->confirmed == 0)
                            NIE
                            @else
                        TAK
                            @endif
                    </td>
                    <td>{{$notification->confirmation_date}}</td>
                    <td><a href="{{route('details', ['notification' => $notification->id])}}">
                            <button class="btn btn-primary btn-xs">Szczegóły</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container" style="text-align: center">
            {{$notifications->links()}}
        </div>
    </div>
@endsection