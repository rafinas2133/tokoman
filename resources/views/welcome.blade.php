<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/logo.png">
    <title>{{ config('app.name', 'Tokoman') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="mainApp" class=" bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <div class="bg-slate-300 dark:bg-gray-900">
        @include('layouts.toko')
        @include('layouts.stokbarang')
        </div>
        @include('layouts.footer')
    </div>
</body>
<script src="https://tokoman.s3.ap-southeast-2.amazonaws.com/TokomanScript.js"></script>
@auth
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://tokoman.s3.ap-southeast-2.amazonaws.com/modalPusher.js"></script>
<script>
    var pusher = new Pusher('c7361a97e7eadb2f7fe4', {
        cluster: 'ap1'
    });
    fetch('/theAPI', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            var userReceives=data;
            console.log(userReceives.replace(' ',''))
            var channelLogout = pusher.subscribe(userReceives.replace(' ',''));
            channelLogout.bind('my-event', function (data) {
                createModal(data.massage);
            });
        });
</script>
@endauth
<!-- <script>
    window.onload = function() {
        if(performance.navigation.type == 2) {
            location.reload(true);
        }
    }
</script> -->

</html>