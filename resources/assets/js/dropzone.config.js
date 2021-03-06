// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#preview_template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

Dropzone.options.dropzone = {
    maxFilesize: 50,
    maxFiles: 20,
    thumbnailWidth: 40,
    thumbnailHeight: 40,
    timeout: 0,
    dictDefaultMessage: 'Drop or select files to upload',
    dictFileTooBig: 'File is too big. Max upload size is 50 MB.',
    previewsContainer: '#file_preview',
    previewTemplate: previewTemplate,
    init: function () {
        this.on('addedfile', function() {
            $('#upload_modal .dz-message').hide();
            $('#upload_modal .modal-header').hide();
            $('#file_preview').show();
        });
        this.on('processing', function(file) {
            $(file.previewTemplate).find('.remove').text('Cancel');
        });
        this.on('uploadprogress', function(file, progress) {
            $(file.previewTemplate).find('.progress-text').text(Math.round(progress)+'%');
        });
        this.on('success', function(file) {
            if (file.xhr.response == 'true') {
                $(file.previewTemplate).find('.remove').hide();
                $(file.previewTemplate).find('.fail').show();
                $(file.previewTemplate).find('.progress-text').hide();
                $(file.previewTemplate).find('.progress').hide();
                $(file.previewTemplate).find('.upload-error').text('File exceeds the storage limit.');
            } else {
                $(file.previewTemplate).find('.remove').hide();
                $(file.previewTemplate).find('.success').show();
                $(file.previewTemplate).find('.progress-text').hide();
                $(file.previewTemplate).find('.progress').hide();
            }
        });
        this.on('error', function(file) {
            $(file.previewTemplate).find('.remove').hide();
            $(file.previewTemplate).find('.fail').show();
            $(file.previewTemplate).find('.progress-text').hide();
            $(file.previewTemplate).find('.progress').hide();
        });
        this.on('queuecomplete', function() {
            var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>Queue completed! Page reloading...</div>';

            $('#status').append(alertbox);
            setTimeout(function() {
               window.location.reload();
            }, 4000);
        });
    }
};
