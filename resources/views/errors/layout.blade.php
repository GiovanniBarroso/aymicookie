<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error @yield('code') - @yield('title')</title>
    @vite('resources/css/errors.css')
</head>

<body>
    <main class="error-container">
        <h1>@yield('code')</h1>
        @yield('message')
    </main>
</body>

</html>
