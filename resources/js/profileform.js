
let autocomplete;
let address_input;
let country = "es"


function initAutocomplete() {
    address_input = document.querySelector("#profile_address");

    autocomplete = new google.maps.places.Autocomplete(address_input, {
        componentRestrictions: {
            country: [country]
        },
        fields: ["address_components", "geometry"],
        types: ["address"],
    });


    autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.

    const place = autocomplete.getPlace();
    document.querySelector("#latitude").value = place.geometry.location.lat();
    document.querySelector("#longitude").value = place.geometry.location.lng();

    let locality;
    let street_number;
    let route;

    for (const component of place.address_components) {
        const componentType = component.types[0];

        switch (componentType) {


            case "route": {
                route = component.short_name;
                break;
            }
            case "street_number": {
                street_number = component.long_name;
                break;
            }
            case "locality": {
                locality = component.long_name;
                break;
            }


        }
    }

    address_input.value = `${route}  ${street_number ?? ''} , ${locality}`;

}
$(function () {
    initAutocomplete();
})

