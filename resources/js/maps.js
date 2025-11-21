import { MarkerClusterer } from "@googlemaps/markerclusterer";
window.onload = function initMap() {

    const center_map = center;
    const escorts_data = geodata;
    let locations = [];

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        disableDefaultUI: true,
        center: center_map,
        panControl: false,
        zoomControl: true,
        scaleControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        MapTypeControl: false,
        fullScreenControl: false,
        streetViewControl: false,
        OverviewMapControl: false,
        mapTypeControlOptions: false

    });

    let markers = [];
    escorts_data.forEach(user => {
        markers.push(createMarker(user, map));
    });

    let markerCluster = new MarkerClusterer({ markers, map });
    // markerCluster.renderer.render()


}
var prev_infowindow = false;
function createMarker(user, map) {
    const template =
        `<div class="d-flex flex-column map-panel">
        <a href="${user.link}"><img src="${user.image}" style="height:150px;" class="mx-auto"/></a>
    <p class="px-2 lineh08"><span class="firstHeading"><a href="${user.link}">${user.name}</a></span><br />
    <span class="price">${user.price} €</span></p>
    </div>`;

    const svg = window.btoa(`<svg width="382" height="382" viewBox="0 0 382 382" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect width="382" height="381" rx="190.5" fill="white"/>
    <path d="M173.244 0.912922C86.9443 8.61292 15.6443 75.6129 2.24433 161.813C-5.05567 208.313 5.64433 257.513 31.5443 296.513L36.9443 304.613L44.5443 298.213C55.8443 288.613 78.3443 273.813 93.6443 265.913C123.344 250.613 165.444 233.113 206.144 219.213L233.144 210.013V205.113C233.044 198.913 230.244 194.813 222.644 189.913C216.144 185.713 214.444 185.013 181.644 174.413C151.944 164.713 137.944 158.113 129.244 149.413C125.844 146.113 121.944 141.213 120.744 138.513C109.444 114.913 131.344 81.5129 177.044 52.8129C196.144 40.8129 218.744 30.5129 236.644 25.6129C243.444 23.8129 247.644 23.4129 257.644 23.4129C276.744 23.4129 288.144 27.5129 299.444 38.2129C309.544 47.7129 312.244 55.6129 309.144 66.4129C305.544 79.2129 294.144 93.8129 278.144 106.313C265.744 116.013 261.044 118.413 246.644 122.813C232.544 127.013 228.644 127.613 228.644 125.513C228.644 124.813 236.344 116.613 245.744 107.313C272.444 80.7129 282.644 66.4129 282.644 55.2129C282.644 51.8129 282.044 49.3129 280.944 47.9129C273.544 38.8129 242.544 47.5129 207.544 68.4129C176.444 87.0129 154.444 107.313 148.544 122.813C141.244 141.913 152.744 150.813 204.144 165.813C223.144 171.313 234.644 177.213 243.844 185.813C247.844 189.513 252.544 194.913 254.144 197.713C255.844 200.513 257.644 202.813 258.144 202.813C258.744 202.813 265.644 201.513 273.644 199.813C281.644 198.213 295.044 196.113 303.344 195.213C318.244 193.513 318.644 193.513 327.844 195.613C332.944 196.813 340.844 198.213 345.344 198.913C349.844 199.513 354.044 200.613 354.644 201.313C356.744 203.813 351.644 205.513 333.744 208.813C313.744 212.313 261.644 225.313 260.044 227.113C259.444 227.813 258.144 230.313 257.244 232.613C251.844 246.713 231.344 268.913 206.344 287.713C176.044 310.413 125.944 340.313 100.244 350.913L91.4443 354.613L99.7443 359.113C110.544 365.013 128.244 372.113 139.944 375.213C159.944 380.613 165.644 381.313 191.144 381.313C212.544 381.313 216.444 381.013 226.644 378.913C255.544 373.013 282.544 361.113 305.544 344.113C314.544 337.413 331.644 321.013 339.144 311.813C359.344 287.013 373.044 256.913 379.344 223.313C381.444 212.113 382.244 181.313 380.744 169.113C375.344 125.913 355.944 85.9129 325.644 55.8129C293.344 23.6129 252.344 4.81292 205.644 0.812922C192.644 -0.287078 187.344 -0.287078 173.244 0.912922Z" fill="#FF0000"/>
    <path d="M187.144 251.713C142.444 269.613 108.144 286.413 85.6443 301.313C75.2443 308.213 59.3443 321.613 57.5443 325.013C56.4443 327.013 56.8443 327.613 60.5443 331.013L64.7443 334.713L71.9443 332.113C88.5443 326.113 108.644 316.313 125.644 305.813C140.144 296.813 168.544 277.513 181.144 268.013C191.544 260.213 211.044 243.013 209.644 242.913C209.344 242.813 199.244 246.813 187.144 251.713Z" fill="#FF0000"/>
    </svg>
    `);

    const marker = new google.maps.Marker({
        position: { lat: user.lat, lng: user.lng },
        map,
        icon: {
            url: `data:image/svg+xml;base64,${svg}`,
            scaledSize: new google.maps.Size(45, 45),
        },
        // label: {
        //     text: 'Escorts Secret',
        //     color: "rgba(255,255,255,0.9)",
        //     fontSize: "12px",
        // },
    });


    const infoWindow = new google.maps.InfoWindow({
        content: template,

    });

    marker.addListener("click", () => {


        infoWindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });

        if (prev_infowindow) {
            prev_infowindow.close();
        }
        prev_infowindow = infoWindow;

    });

    return marker;
}

