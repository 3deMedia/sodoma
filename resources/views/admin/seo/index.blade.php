<x-admin-layout>
    <div class="container pt-2 pt-md-5">
        <div class="row">
            <div class="col-12 col-md-10 ">

               <div class="container pb-4">

                    <div class="row">
                        <p class="col-2">Vista</p>
                        <p class="col-3">Titulo seo</p>
                        <p class="col-3">Descripción seo</p>
                        <p class="col-3">Explicacion</p>
                        <p class="col-1"></p>
                    </div>

                   <div class="row">
                       @foreach ($seo_pages as $seo_page)
                        <x-seo-page :page="$seo_page" />
                       @endforeach


                   </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout>
