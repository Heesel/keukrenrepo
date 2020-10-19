@extends('layouts.master')
@section('content')
    <style>
        html { scroll-behavior: smooth; }
    </style>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <h2>Create Post</h2>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        <div class="custom-file">
        {{Form::file('cover_image', ['class' => 'custom-file-input'])}}
            <label class="custom-file-label" for="customFileLangHTML" data-browse="Bestand kiezen">Voeg je document toe</label>
        </div>
    </div>
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['placeholder' => 'Title', 'class' =>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'placeholder' => 'Body', 'class' =>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('type', 'Type')}}<br>
            {{Form::select('type', array('' => 'Selecteer een type post', 
                                         'news' => 'Nieuws', 
                                         'keuken' => 'Keukens'), null, ['class' => 'box'])}}
        </div>
        {{Form::submit('Submit', ['class' =>'btn btn-success'])}}
    {!! Form::close() !!}
    <hr>
    <br>
@endsection