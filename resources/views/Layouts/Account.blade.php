<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Vite --}}
    @vite('resources/sass/app.scss')
    {{-- Cropper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.css">
    {{-- CSS --}}
    <style>
        #AccountForm {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        #Design {
            box-shadow: 0 0 20px rgb(98, 0, 255);
        }
    </style>
    @yield('CSS')
</head>
<body class="bg-dark">
    <div class="container-fluid p-0">
        @yield('content')
    </div>
{{-- Vite --}}
@vite('resources/js/app.js')
{{-- Cropper --}}
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>
@yield('jQuery')
</body>
</html>