@extends('layouts.layout-admin')

@section('content')

    <div class="col-md-6 col-md-offset-3">

    </div>


    <div class="container">

        <div class="panel panel-default">
            <div class="panel-heading" style="text-align: center">Szczegóły zgłoszenia</div>
        </div>
        {{--<table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Email</th>
                <th>Kod pocztowy</th>
                <th>Tekst hasła</th>
                <th>Data zgłoszenia</th>
                <th>Potwierdzone</th>
                <th>Data potwierdzenia</th>
                <th>Załącznik</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{$notification->id}}</th>
                    <td>{{$notification->name}}</td>
                    <td>{{$notification->surname}}</td>
                    <td>{{$notification->email}}</td>
                    <td>{{$notification->zipcode}}</td>
                    <td>{{$notification->slogan}}</td>
                    <td>{{$notification->created_at}}</td>
                    <td>
                        @if ($notification->confirmed == 0)
                            NIE
                        @else
                            TAK
                        @endif
                    </td>
                    <td>{{$notification->confirmation_date}}</td>
                    <td>{{$notification->fileurl}}</td>
                </tr>
            </tbody>
        </table>--}}

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dane kontaktowe</h3>
            </div>
            <div class="panel-body">
                {{$notification->name}}  {{$notification->surname}}, {{$notification->zipcode}} {{$notification->city}},
                Email: <strong>{{$notification->email}}</strong>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Data i potwierdzenie zgłoszenia</h3>
            </div>
            <div class="panel-body">
                Zgłoszono: {{$notification->created_at}}, Powierdzono:
                @if($notification->confirmed == 1)
                    {{$notification->confirmation_date}}
                @else
                    Nie potwierdzono
                @endif
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tekst hasła konkursowego</h3>
            </div>
            <div class="panel-body">
                {{$notification->slogan}}
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Załącznik</h3>
            </div>
            <div class="panel-body">
                <a href="/images/{{$notification->fileurl}}">{{$notification->fileurl}}</a>
            </div>
        </div>

    </div>
@endsection