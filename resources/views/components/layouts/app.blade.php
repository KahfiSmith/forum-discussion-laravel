<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Forum' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-300 text-black">
    <div class="p-4">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>
