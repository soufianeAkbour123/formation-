@extends('frontend.master')
@section('home')
<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
</head>
<body>
    <div id="app">
        <calendar :events="events"></calendar>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
@endsection