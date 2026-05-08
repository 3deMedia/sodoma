<nav class="navbar navbar-expand-xl navbar-light secrets-nav pl-1">
<div class="container"><a class="navbar-brand pt-0" href="{{ route('home') }}"><img src="{{ asset('images/escortssecrets-logo.jpg') }}" style="height: 88px" alt="Secrets Directorio de Escorts de Lujo" /></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="navbar-default">
<div class="navbar-collapse-header">
<div class="row">
<div class="col-6 collapse-brand"><a href="javascript:void(0)"><img src="{{ asset('images/escortssecrets-logo.jpg') }}" style="height: 63px" alt="Escorts Secrets Publicidad" /></a></div>
<div class="col-6 collapse-close">
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span></button>
</div></div></div>
<ul class="navbar-nav ml-lg-auto">
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'barcelona/')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Barcelona</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'madrid/')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Madrid</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('home')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Más Escorts</span></a></li>
@if (auth()->check())
<li class="nav-item mt-4 mt-xl-1"><a class="bmanun" href="{{ route('my-account') }}"><span class="nav-link-inner--text"> {{ __('general.navs.myaccount') }}</span></a></li>
@else
<li class="nav-item mt-4 mt-xl-1"><a class="bmanun" href="{{ route('login') }}"><span class="nav-link-inner--text"> {{ __('general.navs.publishads') }}</span></a><a href="{{route('login')}}" class="buser"><span class="nav-link-inner--text"> {{ __('general.navs.login') }}</span></a></li>
@endif
 </ul></div></div></nav>
