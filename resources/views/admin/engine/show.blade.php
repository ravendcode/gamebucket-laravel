@extends('layouts.admin')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <a href="{{ route('engines.edit', $engine) }}">Edit</a>
  <a href="{{ url()->previous() }}">Back</a>
@endsection
