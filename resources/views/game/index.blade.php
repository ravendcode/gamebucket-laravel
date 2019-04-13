@extends('layouts.base')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <nav>
    <ul>
      <li><a href="{{ route('games.create') }}">Create Game</a></li>
    </ul>
  </nav>
  <div>
    @forelse ($games as $game)
      <article>
        <h4><a href="{{ route('games.show', $game) }}">{{ $game->title }}</a></h4>
        <a href="{{ route('games.destroy', $game) }}" onclick="event.preventDefault();confirm('You are sure?') ? document.getElementById('{{ $game->id }}-delete-form').submit() : false">Delete</a>
        <form id="{{ $game->id }}-delete-form" action="{{ route('games.destroy', $game) }}" method="POST">
          @method('DELETE')
          @csrf
        </form>
      </article>
    @empty
      <article>
        <h4>Games Not Yet</h4>
      </article>
    @endforelse
  </div>
@endsection
