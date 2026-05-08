<x-guest-layout>
    @push('meta')
        <meta name="description" content="{{ $seo->seo_description }}" />
        <meta name="keywords" content="{{ $seo->seo_keywords }}" />
        <title>{{ config('app.name') }} | {{ $seo->seo_title }}</title>
    @endpush
    <div class="container py-4">
        <div class="row">
            <div class="col-12 mx-auto bg-white p-4">

                        <h1 class="h3 mb-4 fw-bold">Aviso Legal</h1>
                        <p class="text-sm m-1 p-2">En cumplimiento de lo dispuesto en la Ley Orgánica 15/1999, de 13 de Diciembre, de Protección de Datos de Carácter Personal (LOPD) se informa al usuario que todos los datos que nos proporcione serán incorporados a un fichero, creado y mantenido bajo la responsabilidad de Escorts Secrets.</p>

                        <p class="text-sm m-1 p-2">Siempre se va a respetar la confidencialidad de sus datos personales que sólo serán utilizados con la finalidad de gestionar los servicios ofrecidos, atender a las solicitudes que nos plantee, realizar tareas administrativas, así como remitir información técnica, comercial o publicitaria por vía ordinaria o electrónica.</p>

                        <p class="text-sm m-1 p-2">Para ejercer sus derechos de oposición, rectificación o cancelación deberá dirigirse a la sede de la empresa en Conde Salvatierra 08006 Barcelona, escribirnos al siguiente correo info @escortssecrets.com.</p>
                    <p class="text-sm m-1 p-2">Navegar y utilizar los servicios de Escorts Secrets www.escortssecrtes.com le atribuye le compromete como usuario a la aceptación de todas las condiciones publicadas en este aviso legal.</p>


                </div>
         </div>
    </div>
</x-guest-layout>
