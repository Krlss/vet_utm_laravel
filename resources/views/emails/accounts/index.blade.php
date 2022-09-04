<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
</head>

<body>
    {{$message}}
</body>

</html>