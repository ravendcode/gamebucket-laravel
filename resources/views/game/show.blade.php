@extends('layouts.base')

@section('title', $title)

@push('styles')
  <link rel="shortcut icon" href="{{ $publicPath }}/TemplateData/favicon.ico">
  <link rel="stylesheet" href="{{ $publicPath }}/TemplateData/style.css">
  <style>
    .webgl-content {
      margin-top: 20px;
    }
  </style>
@endpush

@section('content')
  <h1>{{ $title }}</h1>
  <h4>Engine: {{ $game->engine->name ?? 'None' }}</h4>
  <?php require_once $storage . '/' . $game->path . '/' . 'index.unity.html' ?>
@endsection

@push('scripts')
  <script src="{{ $publicPath }}/TemplateData/UnityProgress.js"></script>
  <script src="{{ $publicPath }}/Build/UnityLoader.js"></script>
  <script>
    var gameInstance = UnityLoader.instantiate("gameContainer", "{{ $publicPath }}/Build/{{ $filenameWithoutExt }}.json", {onProgress: UnityProgress});
  </script>
@endpush
