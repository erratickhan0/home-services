<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/favicon.png" sizes="32x32" />
    <link href="{{url(mix('assets/admin/css/app.css'))}}" rel="stylesheet">
</head>
<body>
<div id="app">

    <router-view></router-view>
</div>
<script src="{{ mix('assets/admin/js/app.js') }}"></script>
</body>
</html>
