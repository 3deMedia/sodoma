<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@stack('meta')
<link href="{{ asset('images/favicon.jpg')}}" rel="icon" type="image/png">
<link type="text/css" href="{{ asset('argon') }}/css/argon.min.css?v=1.0.0" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{{ mix('css/secrets_front.css') }}">
<link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.min.css" rel="stylesheet">
<link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WKZXQ6X5PS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-WKZXQ6X5PS');
</script>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6Le3P9oqAAAAAMCrR7p9bRF96qABlXVbziiHXSFU"></script>
<script>
    document.addEventListener('submit', function (e) {
    e.preventDefault();
    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute('6Le3P9oqAAAAAMCrR7p9bRF96qABlXVbziiHXSFU', {action: 'submit'}).then(function($token){
        let form = e.target;
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'g-recaptcha-response';
        input.value = $token;
        form.appendChild(input);
        form.submit();
      });
    });
    });
</script>
</head>
<body>
<div class="container-fluid container px-0" >
<header>
@include('guest.layouts.navbar')
</header>
<div style="min-height: 70vh;">
<div class="order-0 order-sm-1 main-content mx-0 pb-4">
{{$slot}}
</div>
</div>
@include('layouts.footers.guest')
</div>
<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
<script src="{{ asset('argon') }}/js/argon.min.js?v=1.0.0"></script>
<script src="{{ asset('js/lozad.js') }}"></script>
</body>
</html>
