<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
    @else
    @endif
</head>

<body>
    <script>
        const dashboardNumbers = @json($dash);
        const winner_numbers = @json($winner_numbers);
        document.addEventListener("DOMContentLoaded", () => {
            lotto.createDashboardFromNums(dashboardNumbers);
            lotto.createBalls(winner_numbers);
        });
    </script>
    <div id="wrapper"></div>
    <div class="kimutatas">
        <p class="title">Kimutatás</p>
        <div id="dashboard"></div>
    </div>
</body>

</html>
