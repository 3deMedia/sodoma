const FilePond = require('filepond');

const FilePondPluginImagePreview = require('filepond-plugin-image-preview');
const FilePondPluginImageCrop = require('filepond-plugin-image-crop');
const FilePondPluginImageExifOrientation = require('filepond-plugin-image-exif-orientation');
const FilePondPluginFileValidateType = require('filepond-plugin-file-validate-type');
const FilePondPluginFileValidateSize = require('filepond-plugin-file-validate-size');
const FilePondPluginImageTransform = require('filepond-plugin-image-transform');
const FilePondPluginFileMetadata = require('filepond-plugin-file-metadata');
const {
    default: Swal
} = require('sweetalert2');

FilePond.registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview, FilePondPluginImageTransform, FilePondPluginFileValidateType,
    FilePondPluginImageCrop, FilePondPluginFileValidateSize, FilePondPluginFileMetadata);

$(function () {



    // coger el id del input para crear filepond
    // fotos principales
    const agency_input = document.getElementById('agency_photo');

    // fotos de la galeria de escort
    const escort_input = document.getElementById('escort_photos');

    const token = $('meta[name="csrf-token"]').attr('content');
    let input;



    let options = {
        storeAsFile: true,
        checkValidity: true,
        imagePreviewHeight: 300,
        allowFileSizeValidation:true,
        maxFileSize:'5MB',
        credits: false,
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'],
        allowImageValidateSize: true,
        imagePreviewMarkupShow: true,
        server: {
            headers: {
                'X-CSRF-TOKEN': token,
            }
        }
    }

        input = escort_input ?? agency_input;

        createFilepond(input, options)


    function createFilepond(input, options) {
       FilePond.create(input, options);
    }
});
