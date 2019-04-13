@extends('layouts.admin')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <nav>
    <ul>
      <li><a href="{{ route('engines.create') }}">Create Game Engine</a></li>
    </ul>
  </nav>
  <div>
    @forelse ($engines as $engine)
      <article>
        <h4><a href="{{ route('engines.show', $engine) }}">{{ $engine->name }}</a></h4>
        <a href="{{ route('engines.destroy', $engine) }}" onclick="event.preventDefault();confirm('You are sure?') ? document.getElementById('{{ $engine->id }}-delete-form').submit() : false">Delete</a>
        <form id="{{ $engine->id }}-delete-form" action="{{ route('engines.destroy', $engine) }}" method="POST">
          @method('DELETE')
          @csrf
        </form>
      </article>
    @empty
      <article>
        <h4>Game Engine Not Yet</h4>
      </article>
    @endforelse
  </div>
@endsection
