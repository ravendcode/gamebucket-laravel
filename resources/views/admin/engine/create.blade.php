@extends('layouts.admin')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <form action="{{ route('engines.store') }}" method="POST">
    @csrf
    <div class="">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}">
    </div>
    <div class="">
      <button type="submit">Create</button>
    </div>
  </form>
  @include('_includes/errors')
@endsection

