<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SysVents</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.min.css') }}" />
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script type="module" src="{{asset('assets/js/scripts.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="d-flex flex-column">
    @include('components.nav')
    @include('components.alerts')
    {{ $slot }}
    <div class="footer-container d-flex flex-grow-1 align-items-end">
        @include('components.footer')
    </div>
</body>
</html>
