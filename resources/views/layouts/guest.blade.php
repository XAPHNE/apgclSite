<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('website.partials.header')

    </head>

    <body style="font-size:14px;">
        @include('website.partials.navBar')
        
        @yield('content')

        @include('website.partials.footer')
    </body>
</html>
