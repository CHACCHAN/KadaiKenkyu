<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Vite --}}
    @vite('resources/sass/app.scss')
    {{-- Cropper --}}
    <link rel="stylesheet" href="{{ asset('Layouts/CSS/cropper.min.css') }}">
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
<script src="{{ asset('Layouts/JS/cropper.min.js') }}"></script>
<script type="text/javascript">
let target = document.getElementById('SendButton');
let submit = document.getElementById('EventButton');
target.addEventListener('click', () => {
    let targetBackUp = target.innerHTML;
    target.innerHTML = `
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        送信中...
    `;
    target.disabled = true;
    submit.click();
});

submit.addEventListener('click', () => {
    target.click();
});
</script>
@yield('jQuery')
</body>
</html>