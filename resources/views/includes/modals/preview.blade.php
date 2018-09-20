<div class="modal fade" id="preview_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="preview-toolbar position-relative d-flex justify-content-between px-3" role="toolbar">
            <div class="d-flex">
                <button class="round-button light text-light d-flex justify-content-center" type="button" data-toggle="tooltip" data-placement="bottom" title="Close" data-dismiss="modal">
                    <i class="material-icons">arrow_back</i>
                    <div class="rippleJS"></div>
                </button>
            </div>
            <div class="d-flex justify-content-center align-items-center text-truncate w-100 mx-2">
                <h5 class="preview-title text-truncate text-light mb-0"></h5>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <a class="preview-showinfo" href="javascript:void(0)">
                    <button class="round-button light text-light d-flex justify-content-center" type="button" data-toggle="tooltip" data-placement="bottom" title="Details">
                        <i class="material-icons">info</i>
                        <div class="rippleJS"></div>
                    </button>
                </a>
            </div>
        </div>
        <div class="preview-container position-relative">
            <div class="preview-content position-relative d-flex justify-content-center align-items-center h-100 w-100">
                <div class="preview-backdrop"></div>
                <div class="preview-item position-relative">

                    {{-- if image --}}
                    <img src="" alt="">

                    {{-- if audio --}}
                    <audio controls>
                        Your browser does not support HTML5 audio.
                    </audio>

                    {{-- if video --}}
                    <video controls>
                        Your browser does not support HTML5 video.
                    </video>

                    {{-- <iframe style="display:none" src="" width="100%" height="600px"></iframe> --}}

                    {{-- if other --}}
                    <div class="no-preview text-center p-2">
                        <h3 class="text-light text-uppercase">Preview not available</h3>
                    </div>

                </div>
                <div class="loader">
                    <div class="position-relative d-flex flex-column justify-content-center align-items-center w-100 h-100">
                        <img src="{{asset('assets/loader-light.gif')}}" alt="loader">
                    </div>
                </div>
            </div>
            <div class="preview-info h-100 p-3">
                <h3 class="border-bottom-dark">Details</h3>
                <div class="audio-details">
                    <div class="d-flex flex-column">
                        <h5 class="mb-3 py-2 border-bottom border-secondary">General</h5>
                        <img class="track-cover-art mx-auto mb-2" src="" style="max-height:200px">
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Title</div>
                            <div class="col-sm-8 track-title"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Artist</div>
                            <div class="col-sm-8 track-artist"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Album</div>
                            <div class="col-sm-8 track-album"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Album Artist</div>
                            <div class="col-sm-8 track-album-artist"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Genre</div>
                            <div class="col-sm-8 track-genre"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Year</div>
                            <div class="col-sm-8 track-year"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Track Number</div>
                            <div class="col-sm-8 track-number"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Disc Number</div>
                            <div class="col-sm-8 track-disc-number"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Duration</div>
                            <div class="col-sm-8 track-duration"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Copyright</div>
                            <div class="col-sm-8 track-copyright"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Bitrate</div>
                            <div class="col-sm-8 track-bitrate"></div>
                        </div>
                        <h5 class="mb-3 py-2 border-bottom border-secondary">File</h5>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">File Name</div>
                            <div class="col-sm-8 info-name"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Format</div>
                            <div class="col-sm-8 info-format text-uppercase"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Mimetype</div>
                            <div class="col-sm-8 info-mime"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Size</div>
                            <div class="col-sm-8 info-size"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Modified</div>
                            <div class="col-sm-8 info-modified"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Uploaded</div>
                            <div class="col-sm-8 info-created"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Owner</div>
                            <div class="col-sm-8 info-owner"></div>
                        </div>
                    </div>
                </div>

                <div class="video-details">
                    <div class="d-flex flex-column">
                        <h5 class="mb-3 py-2 border-bottom border-secondary">General</h5>
                        <img class="track-cover-art mx-auto mb-2" src="" style="max-height:200px">
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Dimension</div>
                            <div class="col-sm-8 video-dimension"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Width</div>
                            <div class="col-sm-8 video-width"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Height</div>
                            <div class="col-sm-8 video-height"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Duration</div>
                            <div class="col-sm-8 video-duration"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Bitrate</div>
                            <div class="col-sm-8 video-bitrate"></div>
                        </div>
                        <h5 class="mb-3 py-2 border-bottom border-secondary">File</h5>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">File Name</div>
                            <div class="col-sm-8 info-name"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Format</div>
                            <div class="col-sm-8 info-format text-uppercase"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Mimetype</div>
                            <div class="col-sm-8 info-mime"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Size</div>
                            <div class="col-sm-8 info-size"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Modified</div>
                            <div class="col-sm-8 info-modified"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Uploaded</div>
                            <div class="col-sm-8 info-created"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Owner</div>
                            <div class="col-sm-8 info-owner"></div>
                        </div>
                    </div>
                </div>

                <div class="file-details">
                    <div class="d-flex flex-column">
                        <h5 class="mb-3 py-2 border-bottom border-secondary">File</h5>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">File Name</div>
                            <div class="col-sm-8 info-name"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Format</div>
                            <div class="col-sm-8 info-format text-uppercase"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Mimetype</div>
                            <div class="col-sm-8 info-mime"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Size</div>
                            <div class="col-sm-8 info-size"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Modified</div>
                            <div class="col-sm-8 info-modified"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Uploaded</div>
                            <div class="col-sm-8 info-created"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 text-secondary">Owner</div>
                            <div class="col-sm-8 info-owner"></div>
                        </div>
                    </div>
                </div>
                <div class="loader">
                    <div class="position-relative d-flex flex-column justify-content-center align-items-center w-100 h-100">
                        <img src="{{asset('assets/loader-light.gif')}}" alt="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>