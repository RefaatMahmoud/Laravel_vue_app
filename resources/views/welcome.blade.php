<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fontawesome/css/all.min.css')}}">
    <title>Laravel Vue </title>
</head>
<body>
<div id="app"></div>
<script src="{{asset('public/js/app.js')}}"></script>
</body>
</html>
