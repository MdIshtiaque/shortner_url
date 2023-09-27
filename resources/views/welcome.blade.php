<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    @include('partial.style')
    @stack('css')
</head>
<body>
@include('inc.navbar')
@include('inc.header')
<div class="container mt-3">
    @yield('content')

</div>

<!-- Bootstrap JS and jQuery CDN (required for Bootstrap) -->
@include('partial.script')
@stack('js')

</body>
</html>
