<x-admin-layout>
    <div class="container pt-2 pt-md-5">
        <div class="row">
            <div class="col-12 col-md-10 ">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                    Nueva categoria
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva Categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin-post-texts') }}" method="post" class="d-flex flex-column">
                                    @csrf
                                    <div class="form-group d-flex flex-column">
                                        <label for="">Nombre categoria</label>
                                        <input type="text" name="name">

                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label for="">Descriptcion 1</label>
                                        <textarea name="description_1">  </textarea>
                                    </div>
                                    <div class="form-group d-flex flex-column">
                                        <label for="">Descriptcion 2</label>
                                        <textarea name="description_2"></textarea>
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
                <div class="container pt-5 pb-8">

                    <div class="row">

                        <p class="col-3">Categoria</p>
                        <p class="col-3">Descripción 1</p>
                        <p class="col-3">Descripcion 2</p>
                        <p class="col-1"></p>
                    </div>

                    <div class="row">
                        @foreach ($category_texts as $ctext)
                            <x-category-text :ctext="$ctext" />
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout>
