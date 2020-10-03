<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <title> Dealzbook @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    {{--  <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">  --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    {{--  <link href="{{ asset('css/viewer.css') }}" rel="stylesheet">  --}}

    {{--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
  
<div class="flex-center position-ref full-height">

    <!-- navigation -->
      @include('partials/navigation')
    <!-- navigation end -->

    <div class="">
        @yield('content')
    </div>

    <!-- page description -->
    @include('partials/page_description')
    <!-- page description end-->

    @include('partials/footer')

</div>
<script src="/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="{{ mix('js/alpine.min.js') }}" defer></script>
{{--<script src="/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
<script src="/js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="{{ asset('js/viewer.js') }}" defer></script>

<script src="{{ mix('js/app.js') }}" defer></script>

<script src="/js/umd_popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="/js/1bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 

<script type="text/javascript" src="{{ asset('js/3d-flip-book/js/libs/jquery.min.js') }}"></script>

 <script src="{{ asset('js/3d-flip-book/js/libs/html2canvas.min.js') }}" ></script> 
<script src="{{ asset('js/3d-flip-book/js/libs/three.min.js') }}" defer></script>
<script src="{{ asset('js/3d-flip-book/js/libs/pdf.min.js') }}" defer></script>
<script src="{{ asset('js/3d-flip-book/js/dist/3dflipbook.js') }}" defer></script>

</body>
</html>
