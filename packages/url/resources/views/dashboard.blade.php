<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Url Shortener Dashboard</title>
    <script src="{{ asset('packages/url/js/app.js') }}" defer></script>
    <link href="{{ asset('packages/url/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <app :backend="{{ json_encode($backend) }}"></app>
</div>
</body>
</html>
