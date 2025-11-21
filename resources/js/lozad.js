// using CommonJS modules
var lozad = require('lozad')

const el = document.querySelectorAll('img');
const observer = lozad(el); // passing a `NodeList` (e.g. `document.querySelectorAll()`) is also valid
observer.observe();


$(function(){
    // bind change event to select
    $('#selector_ciudad').on('change', function () {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
  });
