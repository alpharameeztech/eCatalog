<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> eCatalog @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">

</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="container mx-auto">

        <!-- navigation -->
        @include('partials/navigation')
        <!-- navigation end -->

        @yield('content')


    </div>

    @include('partials/footer')

</div>

<script src="{{ mix('js/alpine.min.js') }}" defer></script>

</body>
</html>
