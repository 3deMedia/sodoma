
@props(['page'])
<form action="{{route('admin-seo-update',$page->id)}}" method="POST"class="container">
    @csrf
    @method('PUT')
    <div class="row">

<div class="col-2">
    <span> {{$page->view}}</span>
</div>
<div class="col-3">
    <input type="text" name="seo_title" value="{{$page->seo_title}}" class="form-control"/>
</div>
<div class="col-3">
    <input type="text" name="seo_description" value="{{$page->seo_description}}" class="form-control"/>
</div>
<div class="col-3">
    <span> {{$page->explanation}}</span>
</div>
<div class="col-1">
    <button type="submit" class=" btn btn-success"><i class="fas fa-save    "></i></button>
</div>
    </div>

</form>
