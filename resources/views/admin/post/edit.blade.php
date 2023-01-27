@extends('layouts.app')

@section('content')
    <div class="container p-5">

        <h1 class="text-center p-4">Modifica</h1>

        <form method="POST" action="{{ route('admin.post.update', $post->id) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Titolo</label>
                <input value="{{ $post->title }}" name="title" type="text" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrizione</label>
                <textarea name="description" class="form-control">{{ $post->body }}</textarea>
            </div>

            <div>
                <label>Categories</label>
                <select class="form-control" name="category_id">
                    <option value="">Seleziona</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Modifica</button>

        </form>

    </div>
@endsection
