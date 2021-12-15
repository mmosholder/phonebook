<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <meta name="description" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<!-- Global site tag (gtag.js) - Google Analytics -->

</head>
<body>
  <div id="app">
    <app></app>
  </div>
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
