<div class="container d-flex justify-content-sm-between"><div class="copyright text-center text-xl-left"><span class="ml-1 text-black">  &copy; {{ now()->year }} - {{ config('app.name')}}</span></div>
<div><ul class="nav nav-footer justify-content-center justify-content-xl-end"><li class="nav-item"><a href="{{route('legal.show','privacy')}}" class="p-1 mcolor text-sm" >{{__('general.Privacy')}}</a></li><li class="nav-item"><a href="{{route('legal.show','terms')}}" class="p-1 mcolor text-sm" >{{__('general.Terms')}}</a></li>
<li class="nav-item"><a href="{{route('legal.show','usc18')}}" class="p-1 mcolor text-sm" >U.S.C. 18</a></li>
<li class="nav-item"><a href="{{route('links','links')}}" class="p-1 mcolor text-sm" >Links</a></li>
</ul></div></div>
