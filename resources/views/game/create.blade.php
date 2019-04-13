@extends('layouts.base')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="">
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="{{ old('title') }}">
    </div>
    <div class="">
      <label for="file">File:</label>
      <input type="file" name="file" id="file">
    </div>
    <div class="">
      <button type="submit">Create</button>
    </div>
  </form>

  @include('_includes/errors')
@endsection
