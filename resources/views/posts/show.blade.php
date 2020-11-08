@extends('layouts.master')
@section('content')
<div class="container">
    <a href="/" class="btn btn-dark">Go Back</a><br><br>
    <h1>{{$post->title}}</h1>
    <a href="/profile/{{$post->user_id}}" style="text-decoration: none; color: black;"><small>geschreven door {{$post->user->name}} op {{$post->created_at}}</small></a>
    <div>
        <img class="postimage" src="/storage/cover_images/{{$post->cover_image}}">
        <hr>
        <h4>
        {!! nl2br(e($post->body)) !!}
        </h4>
    </div>
    <hr>
    <div class="row">
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-trash">Bewerken</a>
                <br>
                <br>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'col-xs-offset-2'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Verwijder', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
                <br>
                <br>
            @elseif(Auth::user()->role == 'admin')
                <a href="/posts/{{$post->id}}/edit" class="btn btn-trash">edit</a>
                <br>
                <br>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'col-xs-offset-2'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
                <br>
                <br>
            @endif
        </div>
        

        <div class="row">
            <div class="col-md-8">
            <!-- vraag 1 knop -->
                <p>
                    <button class="btn btn-success btn-lg" id="commentplaatsbtn" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">Plaats reactie</button>
                </p>
            <!-- antwoord dat uitklapt -->
            <div class="collapse" id="collapse">
                <div id="comment-form" style="margin-top: 30px;">
                    {!!Form::open(['route' => ['comments.stored', $post->id], 'method' => 'POST'])!!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="commentname"> Reactie: </div>
                                {{Form::textarea('comment', null, ['class' => 'form-control', 'id' => 'commenttextarea', 'rows' => '4', 'placeholder' => 'Typ hier uw reactie...'])}} 
                                {{Form::submit('Reactie plaatsen', ['type' => 'button', 'class' => 'btn btn-success'])}}
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>

        
    @endif
    <div class="row">
        <div class="col-md-8" style="margin-top: 30px;">
            <div class="comment-container">
                @foreach($post->comments as $comment)
                <div class="commentname">{{$comment->name}} :</div>
                    <div class="comment">
                        <br/>
                        <div class="comment-text">{!! nl2br(e($comment->comment)) !!}</div>
                        {!!Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST', 'class' => 'col-xs-offset-2'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Verwijder', ['class' => 'btn btn-trash'])}}
                        {!!Form::close()!!}
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection