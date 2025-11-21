<footer class="mt-5 container pt-2 border border-t " style="background-color: #fafafa; border-radius:8px;">
<div class="d-flex p-2 justify-content-between flex-wrap">
<div class="px-4"><img src="{{ asset('images/escortssecrets.png') }}" style="height: 79px"  alt="Escorts Secrets" /><p> Directorio de citas relax con mujeres con clase. </p></div>
<div class="px-4"><ul class="navbar-nav ml-lg-auto">
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'barcelona')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Barcelona</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'madrid')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Madrid</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'ibiza')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Ibiza</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-escorts', 'bilbao')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Escorts Bilbao</span></a></li></ul></div>
<div class="px-4"><ul class="navbar-nav ml-lg-auto">
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('home')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Otras Ciudades</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-agencies')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Agencias / Clubs</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('show-blog')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Blog</span></a></li>
<li class="nav-item"><a class="nav-link nav-link-icon" href="{{route('contact-us')}}"><span class="nav-link-inner--text"><i class="fa fa-caret-right flechika"></i> Contacto</span></a></li></ul></div></div>
<div class="pt-4">@include('layouts.footers.nav')</div>
</footer>
