<div>
<div class="l-filtros d-flex justify-content-between">
<form>
<label>Ciudad: </label>
<select id="selector_ciudad">
<option value="escorts-ibiza">Seleccionar</option>
<option value="{{route('show-escorts','barcelona/')}}">Barcelona</option>
<option value="{{route('show-escorts','madrid/')}}">Madrid</option>
<option value="{{route('show-escorts','ibiza/')}}">Ibiza</option>
<option value="{{route('show-escorts','valencia/')}}">Valencia</option>
<option value="{{route('show-escorts','bilbao/')}}">Bilbao</option>
<option value="{{route('show-escorts','alicante/')}}">Alicante</option>
</select>
</form>
<div class="buscatab d-flex justify-content-between">
@if (Route::is('show-escorts'))
@if ($city)<div class="buscamap"><a href="{{route('search.map',$city->slug)}}"><i class="fa fa-map"></i> Mapa</a> </div>@endif
@endif
<div class="buscatab"><form action=""><input type="search" name="q" id="" class="form-control form-control-flush" placeholder="@lang('general.Search')..."></form></div></div></div></div>
