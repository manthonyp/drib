<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="upload_modal_label" aria-hidden="true">
    <div class="modal-dialog d-flex flex-column justify-content-center my-0" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center py-2">
                <h5 class="modal-title" id="upload_modal_label">File Upload</h5>
                <button class="round-button light text-light d-flex justify-content-center" type="button" data-toggle="tooltip" data-placement="bottom" title="Close" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <div class="rippleJS"></div>
                </button>
            </div>
            
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'dropzone', 'class' => 'dropzone d-flex flex-wrap justify-content-center align-items-center h-100', 'files' => true]) !!}
                {{ method_field('PUT') }}

                <div id="file_preview" class="rounded p-3">
                    <div id="preview_template" class="preview-row position-relative d-flex flex-column w-100">
                        <div class="preview-item d-flex justify-content-between align-items-center w-100">
                            <div class="d-flex justify-content-between align-items-center text-truncate">
                                <div class="preview-img position-relative d-flex flex-column align-items-center justify-content-center mr-2">
                                    <img class="image-thumb" src="{{asset('assets/upload-placeholder.png')}}" data-dz-thumbnail>
                                </div>
                                <div class="d-flex flex-column text-truncate mr-2">
                                    <h6 class="text-truncate mb-1" data-dz-name></h6>
                                    <h6 class="mb-0" data-dz-size></h6>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <a href="javascript:void(0)" class="remove text-light border rounded px-1" data-dz-remove>Remove</a>
                                <div class="progress-text text-center"></div>
                            </div>
                            <div class="success text-success">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="fail text-danger">
                                <i class="material-icons">clear</i>
                            </div>
                        </div>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                        <div class="upload-error" data-dz-errormessage></div>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
