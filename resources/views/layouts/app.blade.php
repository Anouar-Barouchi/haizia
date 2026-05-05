<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'مسابقة حيزية')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @livewireStyles
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f9f7f2; }
    </style>
</head>
<body class="min-h-screen py-10 px-4 flex justify-center items-center">
    @yield('content')
    @livewireScripts
</body>
</html>
