@props(['status'])

@if($status=='success')
<div class="alert alert-success alert-dismissible fade show mt-1 mt-md-4 mx-2 mx-md-4 w-100" role="alert">
    <strong>{{$status}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@else
<div class="alert alert-danger alert-dismissible fade show mt-1 mt-md-4 mx-2 mx-md-4 w-100" role="alert">
    <strong>{{$status}}</strong>
    <button type="button" class="close text-black" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

