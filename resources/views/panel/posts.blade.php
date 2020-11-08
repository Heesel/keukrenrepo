@extends('layouts.dashboard')
@section('content')
    <div class="container">
    <button class="btn btn-success btn-lg"><a href="/Aposts/create"> Nieuwe post aanmaken</a></button>
        <div class="d-flex justify-content-center">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">titel</th>
                <th scope="col">gebruiker</th>
                <th scope="col">bewerken</th>
                <th scope="col">verwijder</th>
                <th scope="col">status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($posts as $post )
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user_id}}</td>
                <td><button class="btn btn-success"><a href="/posts/{{$post->id}}/edit">bewerken</a></button></td>
                <td>
                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </td>
                @if($post->approved == 0)
                <td>niet betaald</td>
                @elseif($post->approved == 1)
                <td>betaald</td>
                @endif
            </tr>
            @endforeach
    </table>
    </div>
</div>
<script type="text/javascript">
    $('.confirmation').click(function(e){
        let result = confirm("Weet je zeker dat je de foto wilt verwijderen?");
        if(!result) {
            e.preventDefault();
        }
    });
</script>
@endsection