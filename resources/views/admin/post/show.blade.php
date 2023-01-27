@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ $posts->title }}</h1>
        <p>
            {{ $posts->body }}
        </p>
    </div>
@endsection
