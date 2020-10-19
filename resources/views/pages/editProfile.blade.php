@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <h2>Gegevens bewerken</h2>
    <p>Pas hieronder je gegevens aan en klik op opslaan om je wijzigingen toe te passen</p>
    {!! Form::open(['action' => ['profileController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::file('avatar')}}
        </div>
        <div class="form-group">
            {{Form::label('name', 'Naam')}}
            {{Form::text('name', $user->name, ['placeholder' => 'Name', 'class' =>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'E-mail')}}
            {{Form::text('email', $user->email, ['id' => 'article-ckeditor', 'placeholder' => 'Email', 'class' =>'form-control'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class' =>'btn btn-success'])}}
    {!! Form::close() !!}
    <br>
    {!!Form::open(['action' => ['profileController@destroy', $user->id], 'method' => 'POST', 'class' => 'col-xs-offset-2'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Verwijder Account', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    <br>
    <br>
    <br>
@endsection