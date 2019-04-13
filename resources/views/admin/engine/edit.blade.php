@extends('layouts.admin')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <form action="{{ route('engines.update', $engine) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="{{ $engine->name }}">
    </div>
    <div class="">
      <button type="submit">Edit</button>
    </div>
  </form>
  @include('_includes/errors')
  <a href="{{ url()->previous() }}">Back</a>
@endsection
