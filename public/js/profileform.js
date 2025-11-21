/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/profileform.js ***!
  \*************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var autocomplete;
var address_input;
var country = "es";

function initAutocomplete() {
  address_input = document.querySelector("#profile_address");
  autocomplete = new google.maps.places.Autocomplete(address_input, {
    componentRestrictions: {
      country: [country]
    },
    fields: ["address_components", "geometry"],
    types: ["address"]
  });
  autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
  var _street_number;

  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  document.querySelector("#latitude").value = place.geometry.location.lat();
  document.querySelector("#longitude").value = place.geometry.location.lng();
  var locality;
  var street_number;
  var route;

  var _iterator = _createForOfIteratorHelper(place.address_components),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var component = _step.value;
      var componentType = component.types[0];

      switch (componentType) {
        case "route":
          {
            route = component.short_name;
            break;
          }

        case "street_number":
          {
            street_number = component.long_name;
            break;
          }

        case "locality":
          {
            locality = component.long_name;
            break;
          }
      }
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  address_input.value = "".concat(route, "  ").concat((_street_number = street_number) !== null && _street_number !== void 0 ? _street_number : '', " , ").concat(locality);
}

$(function () {
  initAutocomplete();
});
/******/ })()
;