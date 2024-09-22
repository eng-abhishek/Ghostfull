    <footer>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-md-6">
                    <ul class="list-unstyled d-flex justify-content-md-start justify-content-center social-links">
                        <li><a href="#" title="Facebook" target="_blank"><img src="{{asset('assets/frontend/images/facebook.png')}}" class="social-image" alt="Facebook"></a></li>
                        <li><a href="#" title="Twitter" target="_blank"><img src="{{asset('assets/frontend/images/twitter.png')}}" class="social-image" alt="Twitter"></a></li>
                        <li><a href="#" title="Instagram" target="_blank"><img src="{{asset('assets/frontend/images/instagram.png')}}" class="social-image" alt="Instagram"></a></li>
                    </ul>
                </div>
                <div class="col-xxl-6 col-md-6">
                    <p class="text-md-end text-center">Copyright &copy; 2022-2023 | Ghostful</p>
                </div>
            </div>
        </div>
    </footer>
    <input type="checkbox" id="toggler" class="d-none">

    <div class="offcanvas offcanvas-top">
        <div class="offcanvas-body">
            <div class="d-flex justify-content-between">
                <div class="allowed-files">
                    <p>JPG PNG BMP GIF TIF WEBP HEIC PDF <span class="ps-2">32 MB</span></p>
                </div>
                <label for="toggler" class="btn-close text-white text-end"></label>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <div class="text-center">
                        <img src="{{asset('assets/frontend/images/upload-icon.png')}}" class="status-icon" alt="">
                        <h3><span class="strikethrough">Drag and drop or paste images here to upload</span></h3>
                        <p>You can also <a href="#" title="" class="text-nowrap" data-trigger="image_uploader">browse from your computer</a> or <a href="#" title="" class="text-nowrap" data-bs-toggle="modal" data-bs-target="#url_Modal">add image URLs</a></p>
                    </div>
                </div>
            </div>
            <!-- Alter Selecting Start -->
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-12 col-lg-12 text-center">
                    <ul class="d-flex flex-wrap justify-content-center list-unstyled" id="preview_list">

                    </ul>
                </div>
            </div>
            <form id="offcanvasForm" style="display: none;">
                <div class="row mb-3 justify-content-center">
                    <div class="col-xxl-4 col-lg-6">
                        <label for="validity" class="form-label">Auto delete file: <span class="text-danger">*</span></label>
                        <select name="validity" id="validity" class="form-select">
                            <option value="1" selected="">Don't autodelete</option>
                            <option value="2">After 5 minutes</option>
                            <option value="3">After 15 minutes</option>
                            <option value="4">After 30 minutes</option>
                            <option value="5">After 1 hour</option>
                            <option value="6">After 3 hours</option>
                            <option value="7">After 6 hours</option>
                            <option value="8">After 12 hours</option>
                            <option value="9">After 1 day</option>
                            <option value="10">After 2 days</option>
                            <option value="11">After 3 days</option>
                            <option value="12">After 4 days</option>
                            <option value="13">After 5 days</option>
                            <option value="14">After 6 days</option>
                            <option value="15">After 1 week</option>
                            <option value="16">After 2 weeks</option>
                            <option value="17">After 3 weeks</option>
                            <option value="18">After 1 month</option>
                            <option value="19">After 2 months</option>
                            <option value="20">After 3 months</option>
                            <option value="21">After 4 months</option>
                            <option value="22">After 5 months</option>
                            <option value="23">After 6 months</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-xxl-4 col-lg-6 text-center">
                        <button type="submit" id="upload_btn" class="btn btn-outline-light" disabled>Upload</button>
                        <a href="javascript:void(0);" class="btn btn-secondary btn-reset">Reset</a>
                    </div>
                </div>
            </form>
            <!-- Alter Selecting End -->
            <!-- Alter Uploading Start -->
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <div class="text-center">
                        <img src="{{asset('assets/frontend/images/success-icon.png')}}" class="status-icon" alt="">
                        <h2>Upload complete</h2>
                        <p>You can <a href="#" title="" class="text-nowrap">create a new album</a> with the content just uploaded. You must <a href="#" title="" class="text-nowrap">create an account</a> or <a href="#" title="" class="text-nowrap">sign in</a> to save this content into your account.</p>
                    </div>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-12 col-lg-12 text-center">
                    <ul class="d-flex flex-wrap justify-content-center list-unstyled">
                        <li class="p-2">
                            <div class="result-image">
                                <a href="#" title=""><img src="https://www.patterndrive.com/storage/top-cybersecurity-courses-in-india-1659445127.jpg" alt="" class="img-fluid"></a>
                            </div>
                        </li>
                        <li class="p-2">
                            <div class="result-image">
                                <a href="#" title=""><img src="https://www.patterndrive.com/storage/top-cybersecurity-courses-in-india-1659445127.jpg" alt="" class="img-fluid"></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <label for="" class="form-label">Embed Codes:</label>
                    <select name="" id="" class="form-select">
                        <optgroup label="Links">
                            <option value="1" selected="selected">Viewer links</option>
                        </optgroup>
                        <optgroup label="HTML Codes">
                            <option value="2">HTML full linked</option>
                            <option value="3">HTML thumbnail linked</option>
                        </optgroup>
                        <optgroup label="BBCodes">
                            <option value="4">BBCode full linked</option>
                            <option value="5">BBCode thumbnail linked</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-xxl-4 col-lg-6">
                    <div class="link-area">
                        <textarea name="" id="" class="form-control link-list" rows="5" placeholder="Links" readonly>https://ghostful.com/dWfAs
                        https://ghostful.com/2aQqew</textarea>
                        <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                    </div>
                </div>
            </div>
            <!-- Alter Uploading End -->
        </div>
    </div>
    <div class="offcanvas-backdrop"></div>
    <!-- Modal -->
    <div class="modal fade" id="edit_image_Modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Edit Image</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-xxl-12 text-center">
                                <img src="" alt="" class="img-fluid" id="modal_image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xxl-12">
                                <label for="" class="form-label">Image Name(optional):</label>
                                <input type="text" name="" id="image_name" class="form-control" placeholder="Image Name">
                            </div>
                        </div>
                        <div class="row resize-wrap">
                            <div class="col-xxl-12">
                                <label for="" class="form-label">Resize Image:</label>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <input type="number" pattern="\d+" step="1" name="" id="image_width" class="form-control" placeholder="Width">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <input type="number" pattern="\d+" step="1" name="" id="image_height" class="form-control" placeholder="Height">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xxl-12">
                                <label for="" class="form-label">Description(optional):</label>
                                <textarea name="" id="" class="form-control" placeholder="Brief description of this image"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="url_Modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Add Image URL</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="viaURLForm">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-xxl-12">
                                <label for="" class="form-label">Image URL:</label>
                                <input type="text" name="" id="image_url" class="form-control" placeholder="Image URL">
                                <span class="invalid-feedback" id="image_url_msg"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-light">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <noscript>
        <div class="toast-container position-fixed end-0 p-3">
            <div id="noscript-toast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-danger text-center">
                    Turn on Javascript to enjoy full feature!
                </div>
            </div>
        </div>
    </noscript>

    <script src="{{asset('assets/frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    @yield('scripts')