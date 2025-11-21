<x-admin-layout>
    @php
    $u_type=$user->user_type_id ;
    @endphp

    <div class="container pt-2 pt-md-5">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-6 mx-auto">
                <form action="{{route('admin-user-update',$user->id)}}" method="post" class="p-2 border border-2">
                @csrf
                @method('PUT')

                <div class="p-2">
                    <div class="form-group">
                        <label for="email">Correo</label><br>
                        <input type="email" name="email" id="name" class="form-control"  value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                      <label for="">Coins</label>
                      <input type="text"
                          class="form-control form-control-sm" name="coins" id="" aria-describedby="helpId" value="{{$user->coins}}">

                    </div>
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="text"
                            class="form-control form-control-sm" name="contrasena" >

                      </div>
                    <div class="form-group">
                        <label for="">tipo</label>
                      <p>{{$u_type == 1 ? 'escort':'agency'}}</p>
                      @if ($user->Profile())
                      <a href="{{route('admin-profile-show',$user->Profile()->id)}}" >Ver perfil</a>
                  @else
                      <p>Aun No tiene perfil creado</p>
                  @endif

                      </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>

                </form>

                <button class="btn btn-info" data-toggle="modal" data-target="#modelId">Registrar transferencia</button>
            </div>
        </div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nueva transferencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('new-transfer')}}" method="post">
                            @csrf
                            <div class="form-group">
                              <label for="">Cantidad</label>
                              <input type="hidden" name="user_id" value="{{$user->id}}">
                              <input type="hidden" name="order_id" value="1">
                              <input type="hidden" name="payment_method" value="bank_transfert">
                              <input type="hidden" name="intent" value="capture">
                              <input type="text" name="amount">
                              <input type="hidden" name="status" value="success">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
