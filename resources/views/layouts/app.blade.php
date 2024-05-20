<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tokoman') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="https://tokoman.s3.ap-southeast-2.amazonaws.com/asset/logo.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="mainApp" class="min-h-screen bg-gray-100 dark:bg-gray-800">
        @if(session('error'))
            @include('layouts.modal', ['message' => session('error')])
        @endif
        @if(session('success'))
            @include('layouts.modalSucces', ['message' => session('success')])
        @endif
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <div class="">
            @include('layouts.footer')
        </div>
    </div>
</body>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://tokoman.s3.ap-southeast-2.amazonaws.com/TokomanScript.js"></script>
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

<!-- <script>
    window.onload = function() {
        if(performance.navigation.type == 2) {
            location.reload(true);
        }
    }
</script> -->

</html>