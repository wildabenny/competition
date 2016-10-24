@extends('layouts.layout-front')

@section('content')
    <div class="container">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('formpost')}}" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Imię</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" name="name" placeholder="Imię"
                               value="{{old('name')}}">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Nazwisko</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" name="surname" placeholder="Nazwisko"
                               value="{{old('surname')}}">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Email</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="Email"
                               value="{{old('email')}}">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Miasto</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input class="form-control" type="text" name="city" placeholder="Miasto"
                               value="{{old('city')}}">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Kod pocztowy</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                        <input name="zipcode" placeholder="Kod pocztowy" value="{{old('zipcode')}}" class="form-control"
                               type="text">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2">Tekst hasła</label>
                <div class="col-xs-10">
                    <textarea name="slogan" class="form-control" placeholder="Długa nazwa" type="text"
                              value="{{old('slogan')}}"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xs-2">Załącznik</label>
                <div class="col-xs-10">
                    <input type="file" name="fileurl" class="form-control" value="{{old('fileurl')}}">
                </div>
            </div>

            <div class="form-group" style="text-align: center">
                <button class="btn btn-primary">Wyślij</button>
            </div>
        </form>
    </div>

    </div>

@endsection