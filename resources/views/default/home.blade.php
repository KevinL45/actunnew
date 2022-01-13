@extends('layouts.base')

@section('body')

<div class="row">
    <div class="col-6">
        <h1 class="text-center">Accueil</h1>
    </div>
</div>

@foreach ($posts as $post)


<div class="card" style="width: 18rem;">
    <img src="{{asset('storage/posts/'.$post->photo)}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$post->title}}</h5>
      <p class="card-text">{{$post->content}}</p>
      <a href="#" class="btn btn-primary">Voir</a>
    </div>
  </div>
  @endforeach

@endsection
