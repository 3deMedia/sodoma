require('select2');

$(function () {

    $('.js-example-basic-single').select2({
        placeholder: 'Selecciona'
    });
    $('.js-example-basic-multiple').select2();

    //// normal escort  prodile
    // delete options when change geodata

    $('#e-country-select').on('change', function () {
        $('#e-cities-select').empty();
            ('#e-region-select').empty();
    })

    $('#e-region-select').on('change', function () {
        $('#e-cities-select').empty();
    })

    // searh related geodata in db

    $('#e-region-select').select2({
        ajax: {
            url: '/api/ajax-regions',
            dataType: 'json',
            data: function (params) {
                let country_id = $('#e-country-select').val();
                var query = {
                    search: params.term,
                    country: country_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });

    $('#e-cities-select').select2({
        ajax: {
            url: '/api/ajax-cities',
            dataType: 'json',
            data: function (params) {
                let region_id = $('#e-region-select').val();
                var query = {
                    search: params.term,
                    region: region_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });



    // agency-escort new profile
    $('#ae-country-select').on('change', function () {

        $('#ae-cities-select').empty()
        $('#ae-region-select').empty()
    })

    $('#ae-region-select').on('change', function () {
       $('#ae-cities-select').empty()
    })

    $('#ae-region-select').select2({
        width: 'resolve',
        ajax: {
            url: '/api/ajax-regions',
            dataType: 'json',
            data: function (params) {
                let country_id = $('#ae-country-select').val();
                var query = {
                    search: params.term,
                    country: country_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });

    $('#ae-cities-select').select2({
        width: 'resolve',
        ajax: {
            url: '/api/ajax-cities',
            dataType: 'json',
            data: function (params) {
                let region_id = $('#ae-region-select').val();
                var query = {
                    search: params.term,
                    region: region_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });

    // agency profile
    $('#a-country-select').on('change', function () {
     $('#a-cities-select').empty()
        $('#a-region-select').empty()

    })

    $('#a-region-select').on('change', function () {
        $('#a-cities-select').empty()
    })

    $('#a-region-select').select2({
        ajax: {
            url: '/api/ajax-regions',
            dataType: 'json',
            data: function (params) {
                let country_id = $('#a-country-select').val();
                var query = {
                    search: params.term,
                    country: country_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });

    $('#a-cities-select').select2({
        ajax: {
            url: '/api/ajax-cities',
            dataType: 'json',
            data: function (params) {
                let region_id = $('#a-region-select').val();
                var query = {
                    search: params.term,
                    region: region_id
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: obj.name
                        };
                    })
                };
            }
        }
    });


})
