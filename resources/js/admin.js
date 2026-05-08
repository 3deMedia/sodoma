const {
    default: axios
} = require("axios")
const {
    default: Swal
} = require("sweetalert2")

$(function () {

    // aprovar perfil
    $('.btn-approve-profile').on('click', function () {
        let profile_id = $(this).attr('data-id')
        let type = $(this).attr('data-type')
        return axios.get('admin-approve-profile/' + profile_id, {
                params: {
                    type: type
                }
            })
            .then(response => {
                if (response.status !== 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: response.data.message
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => window.location.reload(), 1000);
                }
            })
    })

    // mostrar pefil en admin
    $('.btn-show-profile').on('click', function () {
        let profile_id = $(this).attr('data-id')
        let type = $(this).attr('data-type')



        return axios.get('admin-show-profile/' + profile_id, {
                params: {
                    type: type
                }
            })
            .then(response => {
                if (response.status !== 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: response.data.message
                    })
                } else {

                    $('#profileModal').modal('toggle')
                    $('#profileBody').html(response.data)
                }
            })
    })

    // dejar un mensaje en solicitud de  revisión

    $('.btn-profile-msg').on('click', function () {
        console.log('eii');
        let review_id = $(this).attr('data-id')

        Swal.fire({
                title: 'Dejar mensaje',
                input: 'textarea',
                showLoaderOnConfirm: true,
                preConfirm: (message) => {
                    return axios.post('admin-msg-profile/' + review_id, {
                            message: message
                        })
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText)
                            }
                            return response;
                        })
                        .catch(error => {
                            console.log(error);
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Mensaje enviado',
                        showConfirmButton: false,
                        timer: 1500

                    })
                    window.location.reload();
                }
            })



            .then(response => {
                if (response.status !== 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: response.data.message
                    })
                } else {

                    $('#profileModal').modal('toggle')
                    $('#profileBody').html(response.data)
                }
            })
    })

    $('#payments_table').DataTable({
        "order": [
            [0, 'desc']
        ]
    });
    $('#users_table').DataTable({
        "order": [
            [0, 'desc']
        ]
    });
    $('#reviews_table').DataTable({
        "order": [
            [0, 'desc']
        ]
    });
    $('#notis_table').DataTable({
        "order": [
            [0, 'desc']
        ]
    });


    // haciendo vips
    //escprt
    $('.crt-escort-vip').on('click', function () {
        let escort_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Cuantos meses?',
            input: 'number',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            },
            preConfirm: (months) => {
                return window.axios.post('/admin-create-vip/' + escort_id, {
                        months: months
                    })

                    .then(response => {
                        if (response.status !== 200) {
                            throw new Error(response.statusText)
                        }
                        return response;
                    })
                    .catch(error => {
                        console.log(error);
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

            if (result.isConfirmed) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Mensaje enviado',
                    showConfirmButton: false,
                    timer: 1500

                })
                window.location.reload();

            }

        });
    });


    //sgency

    $('.crt-agency-vip').on('click', function () {
        let agency_id = $(this).attr('data-id');
        Swal.fire({
            title: 'Cuantos meses?',
            input: 'number',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            },
            preConfirm: (months) => {
                return window.axios.post('/admin-create-vip/' + agency_id, {
                        months: months
                    })

                    .then(response => {
                        if (response.status !== 200) {
                            throw new Error(response.statusText)
                        }
                        return response;
                    })
                    .catch(error => {
                        console.log(error);
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

            if (result.isConfirmed) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Mensaje enviado',
                    showConfirmButton: false,
                    timer: 1500

                })
                window.location.reload();
            }

        });
    });




})
