<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="all">
  <title>@yield('title', 'App') - {{ config('app.name') }}</title>
  <link rel="shortcut icon" href="/favicon.ico">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <style>
    .error {
      border-color: red;
    }
  </style>
  @stack('styles')
</head>
<body>
  <nav>
    <ul>
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('games.index') }}">Games</a></li>
      <li><a href="{{ route('admin') }}">Admin</a></li>
    </ul>
  </nav>
  @yield('content')
  @stack('scripts')
</body>
</html>
