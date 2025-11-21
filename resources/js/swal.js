const {
    default: axios
} = require('axios');
const {
    default: Swal
} = require('sweetalert2');



$(function () {



    // delete escort profile
    // $('.del-prof').on('click', function () {


    //     let thatvar = $(this).attr('data-render');
    //     Swal.fire({
    //         title: 'Estas seguro?',
    //         text: "No podrás deshacerlo!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Si, bórralo!',
    //         showLoaderOnConfirm: true,
    //         preConfirm: (login) => {
    //             return window.axios.get(`api/escort-profile-delete/${thatvar}`)
    //                 .then(response => {
    //
    //                     if (response.status != 200) {
    //                         throw new Error(response.statusText)
    //                     }
    //                     return window.location.reload();
    //                 })
    //                 .catch(error => {
    //                     Swal.showValidationMessage(
    //                         `Request failed: ${error}`
    //                     )
    //                 })
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     });


    // })
    // set escort profile inactive
    $('.hide-prof').on('click', function () {
        $(this).prop('disabled', true);


        let thatvar = $(this).attr('data-render');

        return window.axios.get(`api/escort-profile-disable/${thatvar}`)
            .then(response => {

                if (response.status != 200) {
                    throw new Error(response.statusText)
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado con éxito',
                    showConfirmButton: false,
                    timer: 1500
                })
                return setTimeout(() => window.location.reload(), 1500)
            })
            .catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                )
            })


    })

    // set escort profile active
    $('.show-prof').on('click', function () {
        $(this).prop('disabled', true);

        let thatvar = $(this).attr('data-render');

        return axios.get(`api/escort-profile-enable/${thatvar}`)
            .then(response => {

                if (response.status != 200) {
                    throw new Error(response.statusText)
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Updated succesfully',
                    showConfirmButton: false,
                    timer: 1500
                })
                return setTimeout(() => window.location.reload(), 1500)
            })
            .catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                )
            })
    })
    // solicitar reviison
    $('.rev-req').on('click', async function () {
        $(this).prop('disabled', true);


        let profile_id = $(this).attr('data-render');
        let profile_type = $(this).attr('data-type');

        return axios.get(`profile-review-request?id=${profile_id}&type=${profile_type}`)
            .then(response => {

                if (response.status != 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        titleText: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Solicitud enviada!',
                        text: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return setTimeout(() => window.location.reload(), 1500)

                }
            })
            .catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                )
            })


    })

    //  Agencia quiere hacer vip a escort
    $('.user-wants-vip').on('click', async function () {
        $(this).prop('disabled', true);
        let profile_id = $(this).attr('data-render');
         let confirmation = await  Swal.fire({
            title: 'Subscripción Vip',
            text:'¿Deseas empezar una subscripción Vip con este perfil?',
            showCancelButton: true,
            cancelButtonColor:'#DD6B55',
            confirmButtonColor:'#04AA6D',
            confirmButtonText: 'Adelante',

          })
        if (confirmation.isConfirmed){
            return axios
            .post(`user-wants-vip`,  {profile:profile_id})
                .then(response => {
                    console.log(response);
                    let resp_status = response.data.status != 200 ? 'error':'success'
                    Swal.fire({
                        position: 'top-end',
                        icon: resp_status,
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    return setTimeout(() => window.location.href= window.location.href + '?tab=pending', 1000);
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })

        }
    return;

    })


    // agencia quiere editar escort
    $('.edit-scrt').on('click',function(){
        let escort = $(this).attr('data-render')

        window.location.href="/agency-escort-edit/"+ escort

    })
    // BORRAR MENSAJES RECIBIDOS DE USUARIOS  VISITANTES AL PERFIL DE UN ESCORT O AGENCIA

    $('.del-msg').on('click',function(){
        let msg_id = $(this).attr('data-render');
        return axios
        .delete(`delete-user-message`, { data:{"msg_id": msg_id}})
            .then(response => {
                if (response.status != 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.data,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Succesfully deleted',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return setTimeout(() => window.location.reload(), 1000)

                }
            })
            .catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                )
            })
    })



})
