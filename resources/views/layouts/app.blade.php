<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Ace Tennis' }}</title>
    <link crossorigin href="https://fonts.gstatic.com/" rel="preconnect"/>
    <link as="style" href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800" onload="this.rel='stylesheet'" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
    @stack('head')
</head>
<body class="bg-white" style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
    <div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            @include('components.header')
            <main class="flex-1">
                @yield('content')
            </main>
            @include('components.footer')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
