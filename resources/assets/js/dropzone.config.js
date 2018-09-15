// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#preview_template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var uploaded = []
Dropzone.options.dropzone = {
    maxFilesize: 10,
    maxFiles: 50,
    thumbnailWidth: 40,
    thumbnailHeight: 40,
    dictDefaultMessage: 'Drop or select files to upload',
    dictFileTooBig: 'File is too big. Max upload size is 10 MB.',
    dictCancelUpload: 'Cancel',
    dictRemoveFile: 'Remove',
    previewsContainer: '#file_preview',
    previewTemplate: previewTemplate,
    init: function () {
        this.on('addedfile', function () {
            $('#upload_modal .dz-message').hide();
            $('#file_preview').show();
        });
        this.on('success', function (file) {
            $(file.previewTemplate).find('.remove').hide();
            $(file.previewTemplate).find('.success').show();
        });
        this.on('error', function () {
            $(file.previewTemplate).find('.remove').hide();
            $(file.previewTemplate).find('.failed').show();
        });
        this.on('queuecomplete', function () {
            var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>Files successfully uploaded.</div>';

            $('#status').append(alertbox);
            setTimeout(function() {
               window.location.reload();
            }, 4000);
        });
    }
};
