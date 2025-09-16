<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name', 'Document'))</title>
    @stack('styles')
</head>
<body class="@yield('body-class', '')">
@yield('content')
</body>
</html>
