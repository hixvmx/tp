<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Test</title>
</head>

<body>
    <main>
        @include('components.header')

        @yield('content')
    </main>

    @vite('resources/js/app.js')

    <script type="module">
        Echo.channel('my-channel')
            .listen('NotifEvent', (e) => {
                alert(e.message);
            });
    </script>
</body>

</html>
