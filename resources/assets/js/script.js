$(function() {
    // popper js init
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    });

    // focus on item on click
    $('.card').click(function() {
        $(this).focus();
    });

    // hide alert message after 5 seconds
    setTimeout(function() {
        $('.alert').slideUp(200, function(){
            $(this).remove(); 
        });
    }, 5000);

    // submit download-form on click
    $('form.download-form').click(function() {
        $(this).submit();
    });

    // clear search when out of focus
    $('#form-sd .search').focusout(function() {
        $(this).val('');
    });

    // show sidebar
    $('#sidebar-show').click(function() {
        $('#sidebar').addClass('show');
        $('.sidebar-backdrop').show();
        $('body').css('overflow-y', 'hidden');
    });
    
    // hide sidebar
    $('#sidebar-hide, .sidebar-backdrop').click(function() {
        $('#sidebar').removeClass('show');
        $('.sidebar-backdrop').hide();
        $('body').css('overflow-y', 'auto');
    });

    // show search form for mobile
    $('#search-mobile--show').click(function() {
        $('#form-sm').addClass('show');
        $('#form-sm .search').focus();
    });
    
    // hide search form for mobile
    $('#search-mobile--hide').click(function() {
        $('#form-sm').removeClass('show');
    });

    // hide mobile search when window view port is not for small device
    $(window).resize(function() {
        if($(window).width() >= 768) {
            $('#form-sm').removeClass('show');
        }
    });

    // view toggle
    $('.list-view').click(function() {
        $(this).addClass('active');
        $('.grid-view').removeClass('active');
        $('.content .row').addClass('list');
        $('.card-dropdown').removeClass('dropup');
    });
    $('.grid-view').click(function() {
        $(this).addClass('active');
        $('.list-view').removeClass('active');
        $('.content .row').removeClass('list');
        $('.card-dropdown').addClass('dropup');
    });

    // set view session
    $('.list-view, .grid-view').click(function() {
        var view = $(this).data('view');
        var token =  $('meta[name=csrf-token]').attr('content');
        
        $.ajax({
            url: '/dashboard/view',
            method: 'GET',
            data: {
                'view': view,
                '_token': token
            }
        });
    });
  
    // get file name when selecting file for avatar
    $('#avatar').change(function(){
        var input = $('#avatar');
        var length = input[0].files.length;
        var items = input[0].files;
        
        if (length > 0) {
            for (var i = 0; i < length; i++) {
                // get file name
                var filename = items[i].name;
            }
    
            $('.file-selected').text('Selected: '+filename);
        }
    });

    // preview from card thumbnail
    $('.preview-thumb').dblclick(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/info',
            method: 'GET',
            data: {
                'id': fileId,
                '_token': token
            },
            beforeSend: function() {
                $('#preview_modal').modal('show');
                $('.preview-info .loader').show();
                $('.preview-content .loader').show();
            },                 
            success: function(data) {
                if (data.category == 'audio') {
                    $('#preview_modal .preview-item audio').css('display', 'block');
                    $('#preview_modal .preview-item audio').attr('src', '../' + data.storage_path);
                    $('#preview_modal .preview-title').text(data.original_name);

                    $('.preview-info .audio-details .track-cover-art').attr('src', data.track_cover_art);
                    $('.preview-info .audio-details .track-title').text(data.track_title);
                    $('.preview-info .audio-details .track-artist').text(data.track_artist);
                    $('.preview-info .audio-details .track-album').text(data.track_album);
                    $('.preview-info .audio-details .track-album-artist').text(data.track_album_artist);
                    $('.preview-info .audio-details .track-genre').text(data.track_genre);
                    $('.preview-info .audio-details .track-year').text(data.track_year);
                    $('.preview-info .audio-details .track-number').text(data.track_number);
                    $('.preview-info .audio-details .track-disc-number').text(data.track_disc_number);
                    $('.preview-info .audio-details .track-duration').text(data.track_duration);
                    $('.preview-info .audio-details .track-copyright').text(data.track_copyright);
                    $('.preview-info .audio-details .track-bitrate').text(data.track_bitrate);

                    $('.preview-info .audio-details .info-name').text(data.original_name);
                    $('.preview-info .audio-details .info-format').text(data.format);
                    $('.preview-info .audio-details .info-mime').text(data.mimetype);
                    $('.preview-info .audio-details .info-size').text(data.size);
                    $('.preview-info .audio-details .info-modified').text(data.modified);
                    $('.preview-info .audio-details .info-created').text(data.uploaded);
                    $('.preview-info .audio-details .info-owner').text(data.owner);

                    $('.preview-info .file-details').css('display', 'none');
                    $('.preview-info .video-details').css('display', 'none');
                    $('.preview-info .audio-details').css('display', 'block');
                } 
                
                else if (data.category == 'video') {
                    $('#preview_modal .preview-item video').css('display', 'block');
                    $('#preview_modal .preview-item video').attr('src', '../' + data.storage_path);
                    $('#preview_modal .preview-title').text(data.original_name);

                    $('.preview-info .video-details .video-dimension').text(data.video_width + 'x' + data.video_height);
                    $('.preview-info .video-details .video-width').text(data.video_width);
                    $('.preview-info .video-details .video-height').text(data.video_height);
                    $('.preview-info .video-details .video-duration').text(data.video_duration);
                    $('.preview-info .video-details .video-framerate').text(data.video_framerate);
                    $('.preview-info .video-details .video-bitrate').text(data.video_bitrate);

                    $('.preview-info .video-details .info-name').text(data.original_name);
                    $('.preview-info .video-details .info-format').text(data.format);
                    $('.preview-info .video-details .info-mime').text(data.mimetype);
                    $('.preview-info .video-details .info-size').text(data.size);
                    $('.preview-info .video-details .info-modified').text(data.modified);
                    $('.preview-info .video-details .info-created').text(data.uploaded);
                    $('.preview-info .video-details .info-owner').text(data.owner);

                    $('.preview-info .file-details').css('display', 'none');
                    $('.preview-info .audio-details').css('display', 'none');
                    $('.preview-info .video-details').css('display', 'block');
                }

                else if (data.category == 'image') {
                    $('#preview_modal .preview-item img').css('display', 'block');
                    $('#preview_modal .preview-item img').attr('src', '../' + data.storage_path);
                    $('#preview_modal .preview-item img').attr('alt', data.original_name);
                    $('#preview_modal .preview-title').text(data.original_name);

                    $('.preview-info .file-details .info-name').text(data.original_name);
                    $('.preview-info .file-details .info-format').text(data.format);
                    $('.preview-info .file-details .info-mime').text(data.mimetype);
                    $('.preview-info .file-details .info-size').text(data.size);
                    $('.preview-info .file-details .info-modified').text(data.modified);
                    $('.preview-info .file-details .info-created').text(data.uploaded);
                    $('.preview-info .file-details .info-owner').text(data.owner);

                    $('.preview-info .audio-details').css('display', 'none');
                    $('.preview-info .video-details').css('display', 'none');
                    $('.preview-info .file-details').css('display', 'block');
                }

                else {
                    $('#preview_modal .preview-item .no-preview').css('display', 'block');
                    $('#preview_modal .preview-title').text(data.original_name);

                    $('.preview-info .file-details .info-name').text(data.original_name);
                    $('.preview-info .file-details .info-format').text(data.format);
                    $('.preview-info .file-details .info-mime').text(data.mimetype);
                    $('.preview-info .file-details .info-size').text(data.size);
                    $('.preview-info .file-details .info-modified').text(data.modified);
                    $('.preview-info .file-details .info-created').text(data.uploaded);
                    $('.preview-info .file-details .info-owner').text(data.owner);

                    $('.preview-info .audio-details').css('display', 'none');
                    $('.preview-info .video-details').css('display', 'none');
                    $('.preview-info .file-details').css('display', 'block');
                }

                $('.preview-info .loader').hide();
                $('.preview-content .loader').hide();
            }
        });
    });

    // get file info
    $('.preview, .file-showinfo').click(function() {
        var fileId = $(this).data('id');
        var from = $(this).data('from');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/info',
            method: 'GET',
            data: {
                'id': fileId,
                'from': from,
                '_token': token
            },
            beforeSend: function() {
                if (from == 'preview') {
                    $('.preview-info .loader').show()
                    $('.preview-content .loader').show()
                } else {
                    $('#file-info .loader').show();
                }
            },                     
            success: function(data) {
                if (data.from == 'preview') {

                    $('#preview_modal').modal('show');
                    
                    if (data.category == 'audio') {
                        $('#preview_modal .preview-item audio').css('display', 'block');
                        $('#preview_modal .preview-item audio').attr('src', '../' + data.storage_path);
                        $('#preview_modal .preview-title').text(data.original_name);
    
                        $('.preview-info .audio-details .track-cover-art').attr('src', data.track_cover_art);
                        $('.preview-info .audio-details .track-title').text(data.track_title);
                        $('.preview-info .audio-details .track-artist').text(data.track_artist);
                        $('.preview-info .audio-details .track-album').text(data.track_album);
                        $('.preview-info .audio-details .track-album-artist').text(data.track_album_artist);
                        $('.preview-info .audio-details .track-genre').text(data.track_genre);
                        $('.preview-info .audio-details .track-year').text(data.track_year);
                        $('.preview-info .audio-details .track-number').text(data.track_number);
                        $('.preview-info .audio-details .track-disc-number').text(data.track_disc_number);
                        $('.preview-info .audio-details .track-duration').text(data.track_duration);
                        $('.preview-info .audio-details .track-copyright').text(data.track_copyright);
                        $('.preview-info .audio-details .track-bitrate').text(data.track_bitrate);
    
                        $('.preview-info .audio-details .info-name').text(data.original_name);
                        $('.preview-info .audio-details .info-format').text(data.format);
                        $('.preview-info .audio-details .info-mime').text(data.mimetype);
                        $('.preview-info .audio-details .info-size').text(data.size);
                        $('.preview-info .audio-details .info-modified').text(data.modified);
                        $('.preview-info .audio-details .info-created').text(data.uploaded);
                        $('.preview-info .audio-details .info-owner').text(data.owner);
    
                        $('.preview-info .file-details').css('display', 'none');
                        $('.preview-info .video-details').css('display', 'none');
                        $('.preview-info .audio-details').css('display', 'block');
                    } 
                    
                    else if (data.category == 'video') {
                        $('#preview_modal .preview-item video').css('display', 'block');
                        $('#preview_modal .preview-item video').attr('src', '../' + data.storage_path);
                        $('#preview_modal .preview-title').text(data.original_name);
    
                        $('.preview-info .video-details .video-dimension').text(data.video_width + 'x' + data.video_height);
                        $('.preview-info .video-details .video-width').text(data.video_width);
                        $('.preview-info .video-details .video-height').text(data.video_height);
                        $('.preview-info .video-details .video-duration').text(data.video_duration);
                        $('.preview-info .video-details .video-bitrate').text(data.video_bitrate);
    
                        $('.preview-info .video-details .info-name').text(data.original_name);
                        $('.preview-info .video-details .info-format').text(data.format);
                        $('.preview-info .video-details .info-mime').text(data.mimetype);
                        $('.preview-info .video-details .info-size').text(data.size);
                        $('.preview-info .video-details .info-modified').text(data.modified);
                        $('.preview-info .video-details .info-created').text(data.uploaded);
                        $('.preview-info .video-details .info-owner').text(data.owner);
    
                        $('.preview-info .file-details').css('display', 'none');
                        $('.preview-info .audio-details').css('display', 'none');
                        $('.preview-info .video-details').css('display', 'block');
                    }
    
                    else if (data.category == 'image') {
                        $('#preview_modal .preview-item img').css('display', 'block');
                        $('#preview_modal .preview-item img').attr('src', '../' + data.storage_path);
                        $('#preview_modal .preview-item img').attr('alt', data.original_name);
                        $('#preview_modal .preview-title').text(data.original_name);
    
                        $('.preview-info .file-details .info-name').text(data.original_name);
                        $('.preview-info .file-details .info-format').text(data.format);
                        $('.preview-info .file-details .info-mime').text(data.mimetype);
                        $('.preview-info .file-details .info-size').text(data.size);
                        $('.preview-info .file-details .info-modified').text(data.modified);
                        $('.preview-info .file-details .info-created').text(data.uploaded);
                        $('.preview-info .file-details .info-owner').text(data.owner);
    
                        $('.preview-info .audio-details').css('display', 'none');
                        $('.preview-info .video-details').css('display', 'none');
                        $('.preview-info .file-details').css('display', 'block');
                    }
    
                    else {
                        $('#preview_modal .preview-item .no-preview').css('display', 'block');
                        $('#preview_modal .preview-title').text(data.original_name);
    
                        $('.preview-info .file-details .info-name').text(data.original_name);
                        $('.preview-info .file-details .info-format').text(data.format);
                        $('.preview-info .file-details .info-mime').text(data.mimetype);
                        $('.preview-info .file-details .info-size').text(data.size);
                        $('.preview-info .file-details .info-modified').text(data.modified);
                        $('.preview-info .file-details .info-created').text(data.uploaded);
                        $('.preview-info .file-details .info-owner').text(data.owner);
    
                        $('.preview-info .audio-details').css('display', 'none');
                        $('.preview-info .video-details').css('display', 'none');
                        $('.preview-info .file-details').css('display', 'block');
                    }
                    
                    $('.preview-info .loader').hide();
                    $('.preview-content .loader').hide();
                }

                else if (data.from == 'main') {
                    if (data.category == 'audio') {
                        $('#file-info .preview-item audio').css('display', 'block');
                        $('#file-info .preview-item audio').attr('src', '../' + data.storage_path);
                        $('#file-info .preview-title').text(data.original_name);
    
                        $('#file-info .audio-details .track-cover-art').attr('src', data.track_cover_art);
                        $('#file-info .audio-details .track-title').text(data.track_title);
                        $('#file-info .audio-details .track-artist').text(data.track_artist);
                        $('#file-info .audio-details .track-album').text(data.track_album);
                        $('#file-info .audio-details .track-album-artist').text(data.track_album_artist);
                        $('#file-info .audio-details .track-genre').text(data.track_genre);
                        $('#file-info .audio-details .track-year').text(data.track_year);
                        $('#file-info .audio-details .track-number').text(data.track_number);
                        $('#file-info .audio-details .track-disc-number').text(data.track_disc_number);
                        $('#file-info .audio-details .track-duration').text(data.track_duration);
                        $('#file-info .audio-details .track-copyright').text(data.track_copyright);
                        $('#file-info .audio-details .track-bitrate').text(data.track_bitrate);
    
                        $('#file-info .audio-details .info-name').text(data.original_name);
                        $('#file-info .audio-details .info-format').text(data.format);
                        $('#file-info .audio-details .info-mime').text(data.mimetype);
                        $('#file-info .audio-details .info-size').text(data.size);
                        $('#file-info .audio-details .info-modified').text(data.modified);
                        $('#file-info .audio-details .info-created').text(data.uploaded);
                        $('#file-info .audio-details .info-owner').text(data.owner);
    
                        $('#file-info .file-details').css('display', 'none');
                        $('#file-info .video-details').css('display', 'none');
                        $('#file-info .audio-details').css('display', 'block');
                    } 
                    
                    else if (data.category == 'video') {
                        $('#file-info .preview-item video').css('display', 'block');
                        $('#file-info .preview-item video').attr('src', '../' + data.storage_path);
                        $('#file-info .preview-title').text(data.original_name);
    
                        $('#file-info .video-details .video-dimension').text(data.video_width + 'x' + data.video_height);
                        $('#file-info .video-details .video-width').text(data.video_width);
                        $('#file-info .video-details .video-height').text(data.video_height);
                        $('#file-info .video-details .video-duration').text(data.video_duration);
                        $('#file-info .video-details .video-framerate').text(data.video_framerate);
                        $('#file-info .video-details .video-bitrate').text(data.video_bitrate);
    
                        $('#file-info .video-details .info-name').text(data.original_name);
                        $('#file-info .video-details .info-format').text(data.format);
                        $('#file-info .video-details .info-mime').text(data.mimetype);
                        $('#file-info .video-details .info-size').text(data.size);
                        $('#file-info .video-details .info-modified').text(data.modified);
                        $('#file-info .video-details .info-created').text(data.uploaded);
                        $('#file-info .video-details .info-owner').text(data.owner);
    
                        $('#file-info .file-details').css('display', 'none');
                        $('#file-info .audio-details').css('display', 'none');
                        $('#file-info .video-details').css('display', 'block');
                    }
    
                    else if (data.category == 'image') {
                        $('#file-info .preview-item img').css('display', 'block');
                        $('#file-info .preview-item img').attr('src', '../' + data.storage_path);
                        $('#file-info .preview-item img').attr('alt', data.original_name);
                        $('#file-info .preview-title').text(data.original_name);
    
                        $('#file-info .file-details .info-name').text(data.original_name);
                        $('#file-info .file-details .info-format').text(data.format);
                        $('#file-info .file-details .info-mime').text(data.mimetype);
                        $('#file-info .file-details .info-size').text(data.size);
                        $('#file-info .file-details .info-modified').text(data.modified);
                        $('#file-info .file-details .info-created').text(data.uploaded);
                        $('#file-info .file-details .info-owner').text(data.owner);
    
                        $('#file-info .audio-details').css('display', 'none');
                        $('#file-info .video-details').css('display', 'none');
                        $('#file-info .file-details').css('display', 'block');
                    }
    
                    else {
                        $('#file-info .preview-item .no-preview').css('display', 'block');
                        $('#file-info .preview-title').text(data.original_name);
    
                        $('#file-info .file-details .info-name').text(data.original_name);
                        $('#file-info .file-details .info-format').text(data.format);
                        $('#file-info .file-details .info-mime').text(data.mimetype);
                        $('#file-info .file-details .info-size').text(data.size);
                        $('#file-info .file-details .info-modified').text(data.modified);
                        $('#file-info .file-details .info-created').text(data.uploaded);
                        $('#file-info .file-details .info-owner').text(data.owner);
    
                        $('#file-info .audio-details').css('display', 'none');
                        $('#file-info .video-details').css('display', 'none');
                        $('#file-info .file-details').css('display', 'block');
                    }

                    $('#file-info .loader').hide();
                }
            }
        });
    });

    // stop video, audio and hide elements when modal is hidden
    $('#preview_modal').on('hidden.bs.modal', function() {
        $('.preview-item audio, .preview-item video').attr('src', '');
        $('.preview-item > :not(.preview-backdrop)').css('display', 'none');
        $('.preview-info').removeClass('show');
        $('.preview-content').removeClass('showed-info');
    });

    // show main info sidebar
    $('.file-showinfo').click(function() {
        $('#file-info').addClass('show');
        $('.content').addClass('showed-info');
    });

    // hide main info sidebar
    $('.file-hideinfo').click(function() {
        $('#file-info').removeClass('show');
        $('.content').removeClass('showed-info');
    });

    // toggle preview info sidebar
    $('.preview-showinfo').click(function() {
        $('.preview-info').toggleClass('show');
        $('.preview-content').toggleClass('showed-info');
    });

    // hide modal when clicked outside the item
    $('.preview-backdrop').click(function() {
        $('#preview_modal').modal('hide');
    });

    // increment file download count
    $('#download_button').click(function() {
        var fileId = $(this).data('id');
        var shareToken = $(this).data('share-token');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/download/' + fileId + '/' + shareToken,  
            method: 'GET',
            data: {
                '_token': token
            },
            beforeSend: function() {
                $('#download_button').attr('value', 'Fetching...');
            },
            complete: function() {
                $('#download_button').attr('value', 'Downloading...').prop('disabled', 'true');
            },
            success: function(data) {
                $('#download_button').attr('value', 'Downloading...').prop('disabled', 'true');
            }
        });
    });

    // create shareable link
    $('.preview-share').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/share',
            method: 'POST',
            data: {
                'id': fileId,
                'action': 'grant',
                '_token': token
            },                            
            success: function(data) {
                $('#share_modal').modal('show');
                $('#share_modal input').val(window.location.protocol + "//" + window.location.host + data.share_url);
                $('a[data-share-id*='+ data.id + ']').hide();
                $('a[data-unshare-id*='+ data.id + '], a[data-sharelink-id*='+ data.id + ']').css('display', 'block');
            }
        });
    });

    // copy link to clipboard
    // change class when clicked
    $('.clipboard-copy').click(function() {
        $(this).text('').append('<i class="fas fa-check-square mr-2"></i>Copied to clipboard').attr('disabled', '').attr('aria-disabled', 'true');
        $('#share_modal input').select();
        document.execCommand('copy');
    });

    // reset clipboard copy button to btn-default
    $('#share_modal').on('hidden.bs.modal', function() {
        $('.clipboard-copy').text('').append('<i class="far fa-copy mr-2"></i>Copy to clipboard').removeAttr('disabled', '').removeAttr('aria-disabled', 'true');
    });

    // get shareable link
    $('.preview-sharelink').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/shared/link',
            method: 'GET',
            data: {
                'id': fileId,
                '_token': token
            },                            
            success: function(data) {
                $('#share_modal input').val(window.location.protocol + "//" + window.location.host + data.share_url);
                $('#share_modal').modal();
            }
        });
    });
 
    // revoke shareable link
    $('.preview-unshare').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/share',
            method: 'POST',
            data: {
                'id': fileId,
                'action': 'revoke',
                '_token': token
            },                            
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>Shareable link removed.</div>';

                $('a[data-unshare-id*='+ data.id + '], a[data-sharelink-id*='+ data.id + ']').hide();
                $('a[data-share-id*='+ data.id + ']').css('display', 'block');

                $('#status').append(alertbox);

                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });

    // move file to trash
    $('.file-trash').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/trash',
            method: 'POST',
            data: {
                'id': fileId,
                'action': 'trash',
                '_token': token
            },                            
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>File moved to trash.</div>';

                $('#status').append(alertbox);
                $('div[data-id*="'+ data.id +'"]').remove();

                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });

    // recover file frome trash
    $('.file-restore').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/restore',
            method: 'POST',
            data: {
                'id': fileId,
                'action': 'restore',
                '_token': token
            },                            
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>File restored from trash.</div>';

                $('#status').append(alertbox);
                $('div[data-id*="'+ data.id +'"]').remove();

                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });

    // delete file permanently
    $('.file-delete').click(function() {
        var fileId = $(this).data('id');
        var token =  $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: '/file/delete',
            method: 'POST',
            data: {
                'id': fileId,
                '_token': token
            },                            
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>File deleted permanently.</div>';

                $('#status').append(alertbox);
                $('div[data-id*="'+ data.id +'"]').remove();

                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });

    // delays event handler's function
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    // search user by the inputted value
    $('.search-user').keyup(function() {
        var searchValue = $(this).val();
        
        delay(function(){

            $.ajax({
                url: '/dashboard/admin/searchUsers',
                method: 'GET',
                data: {
                    'searchValue': searchValue
                },
                success: function(users) {
                    $('.row.list').html('');

                    $.each(users, function( index, user ) {
                        $('.row.list').append(createHtmlForUserData(user));
                    });
                }
            });

        }, 500 );
    });

    // returns block of html for tha user's data that is to be append in the list
    function createHtmlForUserData(user) {
        if (user.avatar != null)
            var avatar = `<div class="image-thumb rounded-circle" style="background:url('../../storage/`+ user.avatar +`') no-repeat scroll center center / cover;"></div>`;
        else
            var avatar = `<div class="image-thumb rounded-circle" style="background:url('../../assets/default-avatar.png') no-repeat scroll center center / cover;"></div>`;

        var admin = ``;
        if(user.type !== 'admin') {
            admin = 
            `<div class="card-dropdown dropup rounded-circle position-static">
                <button class="dropdown-toggle rounded-circle px-2 py-1" id="cardDropdown" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                    <div class="rippleJS"></div>
                </button>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item change-type" href="javascript:void(0)">
                        <div class="d-table-cell text-center pr-3"><i class="fas fa-exchange-alt"></i></div>
                        <div class="d-table-cell">Change Type</div>
                    </a>

                    <a class="dropdown-item delete-user" href="javascript:void(0)">
                        <div class="d-table-cell text-center pr-3"><i class="fas fa-trash"></i></div>
                        <div class="d-table-cell">Delete</div>
                    </a>
                </div>
            </div>`;
        }
        

        blockOfHtml = 
        `<div data-id="`+ user.id +`" class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3 user-data">
            <div class="card" tabindex='1'>
                <div class="card-img-top position-relative d-flex flex-column align-items-center justify-content-center border-bottom">`
                +
                    avatar   
                +
                `</div>
                <div class="card-body position-relative px-2 py-2">
                    <h6 class="text-truncate mb-0">`+ user.name +`</h6>
                    <h6 class="text-truncate text-secondary mt-1 mb-0 account-type">`+ user.type +`</h6>          
                </div>`
                +
                    admin
                +
            `</div>
        </div>`;

        return blockOfHtml;
    }

    // change account type of user
    $(document).on('click', '.change-type', function() {
        var userId = $(this).closest('div.user-data').data('id');
        var token =  $('meta[name=csrf-token]').attr('content');
        
        $.ajax({
            url: '/account/changeType',
            method: 'POST',
            data: {
                'id': userId,
                '_token': token
            },
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>User '+data.name+"'s account type was changed to "+data.type+'.</div>';
                
                $('#status').append(alertbox);
                $('div.user-data[data-id*="'+ data.id +'"] h6.account-type').text(data.type);
                $('div.user-data[data-id*="'+ data.id +'"] div.card-dropdown').remove();

                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });

    // delete user
    $(document).on('click', '.delete-user', function() {
        var userId = $(this).closest('div.user-data').data('id');
        var token =  $('meta[name=csrf-token]').attr('content');
        
        $.ajax({
            url: '/account/'+userId,
            method: 'POST',
            data: {
                '_method': 'DELETE',
                'id': userId,
                '_token': token
            },
            success: function(data) {
                var alertbox = '<div class="alert alert-darken alert-dismissable"><a href="javascript:void(0)" class="close ml-2" data-dismiss="alert" aria-label="close">&times;</a><i class="fas fa-check mr-2"></i>User '+data.name+' deleted.</div>';
                
                $('#status').append(alertbox);
                $('div.user-data[data-id*="'+ data.id +'"]').remove();
                
                setTimeout(function() {
                    $('.alert').slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 5000);
            }
        });
    });
});