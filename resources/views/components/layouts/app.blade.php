<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Mad planner' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="pb-5">
            {{ $slot }}
        </div>
        <livewire:navigation.bottom-bar :current_url="request()->url()" />
    </body>
</html>
