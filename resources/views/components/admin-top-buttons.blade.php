
    <div class="row">
        <div class="col-12 mx-auto">

            @if ($profile->is_vip)
                <a href="{{ route('admin-delete-vip', $profile->id) }}" class="btn btn-danger">Quitar Vip</a>
            @else
                <button class="btn btn-primary crt-agency-vip" data-id="{{ $profile->id }}">Crear Vip</button>
            @endif
            <a href="{{ route('admin-user-show', $profile->User->id) }}" class="btn btn-info">Ver Usuario</a>
            @if ($profile->type_id == 2 && $profile->User->coins >= $escortcost)
                <a href="{{ route('admin-create-escort-for', $profile->id) }}" class="btn btn-success">Crear
                    escort</a>
            @endif

            @if ($profile->verified)
                <a href="{{ route('admin.verify', $profile->id) }}" class="btn btn-danger">Quitar Verificado</a>
            @else
                <a href="{{ route('admin.verify', $profile->id) }}" class="btn btn-success">Verificar</a>
            @endif
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                Cambiar slug
            </button>

            <a href="{{ route('download-profile-images', $profile->id) }}" class="btn btn-success"><i
                    class="fas fa-file-archive" aria-hidden="true"></i> &nbsp; Imagenes</a>
        </div>
        <div class="mt-3">
            @if ($profile->type_id == 2 && $profile->User->coins >= $escortcost)
                @php
                    $escorts_count = $profile->Escorts()->count();
                @endphp
                <h5>Nº Escorts: {{ $escorts_count }}</h5>
                @if ($escorts_count > 0)
                    <p>
                        <a href="{{ route('admin-show-agency-escorts', $profile->id) }}" class="btn btn-secondary">Ver
                            Escorts</a>
                    </p>
                @endif


            @endif
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin-change-slug', $profile->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar slug</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <div class="form-group">
                                <label for="">sLUG</label>
                                <input type="text" name="slug" id="" class="form-control" value="{{ $profile->uid }}"
                                    placeholder="tu-puta-preferida-69" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

