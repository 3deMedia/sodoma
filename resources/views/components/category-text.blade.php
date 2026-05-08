<div>
    <form action="{{route('admin-update-texts',$ctext->id)}}" method="post" style="    display: flex;
        align-items: center;
        justify-content: space-around;">
        @csrf
        @method('PUT')
    <input name="name" type="text" value="{{$ctext->name}}" class="form-control  mx-2">
    <textarea name="description_1" class="form-control mx-2" >
        {!! $ctext->description_1 !!}
    </textarea>
    <textarea name="description_2" class="form-control  mx-2">
        {!! $ctext->description_2 !!}
    </textarea>
    <button type="submit" class="btn btn-primary  mx-2">Guardar</button>
    </form>
</div>
