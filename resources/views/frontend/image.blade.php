@extends('frontend.layouts.app')
@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 text-center my-3">
                <img src="{{asset('assets/frontend/images/sample1.gif')}}" alt="" class="img-fluid">
            </div>
        </div>                  
        <div class="row justify-content-center align-items-center">
            <div class="col-xxl-4 col-xl-6 col-md-12 text-center my-3">
                <div class="image-viewer">
                    <!-- <img src="assets/images/close.png" alt="" class="img-fluid"> -->
                    <img src="https://drive.google.com/uc?id=1I3G996rdkq7rgt7Xz_YfR5E1M1HUIScO" alt="" class="img-fluid">
                </div>
                <div class="sidebar my-3">
                    <ul class="list-unstyled d-flex justify-content-center mb-0 flex-wrap">
                        <li><a href="#" class="sidebar-link strikethrough" data-bs-toggle="modal" data-bs-target="#edit_image_Modal"><span class="edit"></span> Edit</a></li>
                        <li><a href="#" class="sidebar-link strikethrough"><span class="delete"></span> Delete</a></li>
                        <li><a href="#" class="sidebar-link"><span class="download"></span> Download</a></li>
                        <li><a href="#" class="sidebar-link strikethrough"><span class="like"></span>  Like</a></li>
                        <li><a href="#" class="sidebar-link strikethrough" data-bs-toggle="modal" data-bs-target="#share_Modal"><span class="share"></span>  Share</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 col-md-12 my-3">
                <div class="embed-wrap">
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Image Name</h6>
                            </div>
                            <div class="col-lg-8">
                                <p>image-name.jpg</p>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Dimensions</h6>
                            </div>
                            <div class="col-lg-8">
                                <p>1920x1080</p>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Size</h6>
                            </div>
                            <div class="col-lg-8">
                                <p>3.2 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Uploaded</h6>
                            </div>
                            <div class="col-lg-8">
                                <p>3 minutes ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Views</h6>
                            </div>
                            <div class="col-lg-8">
                                <p>28</p>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-muted"><small>Direct links</small></h5>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>Image link</h6>
                            </div>
                            <div class="col-lg-8">
                                <div class="copy-area">
                                    <input type="text" class="form-control link-list" value="https://ghostful.com/dWfAs" readonly>
                                    <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-muted"><small>Full image (linked)</small></h5>
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <h6>HTML</h6>
                            </div>
                            <div class="col-lg-8">
                                <div class="copy-area">
                                    <input type="text" class="form-control link-list" value="&#x3C;a href=&#x22;https://ghostful.com/dWfAs&#x22;&#x3E;&#x3C;img src=&#x22;https://ghostful.com/image-name.jpg&#x22; alt=&#x22;image-name&#x22;&#x3E;&#x3C;/a&#x3E;" readonly>
                                    <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>BBCode</h6>
                            </div>
                            <div class="col-lg-8">
                                <div class="copy-area">
                                    <input type="text" class="form-control link-list" value="[url=https://ghostful.com/dWfAs][img]https://ghostful.com/dWfAs/image-name.jpg[/img][/url]" readonly>
                                    <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="embed-list">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-muted"><small>Thumbnail image (linked)</small></h5>
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <h6>HTML</h6>
                            </div>
                            <div class="col-lg-8">
                                <div class="copy-area">
                                    <input type="text" class="form-control link-list" value="&#x3C;a href=&#x22;https://ghostful.com/dWfAs&#x22;&#x3E;&#x3C;img src=&#x22;https://ghostful.com/image-name.jpg&#x22; alt=&#x22;image-name&#x22;&#x3E;&#x3C;/a&#x3E;" readonly>
                                    <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <h6>BBCode</h6>
                            </div>
                            <div class="col-lg-8">
                                <div class="copy-area">
                                    <input type="text" class="form-control link-list" value="[url=https://ghostful.com/dWfAs][img]https://ghostful.com/dWfAs/image-name.jpg[/img][/url]" readonly>
                                    <a href="#" title="Copy" class="btn btn-dark btn-sm copy-link strikethrough">Copy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 text-center my-3">
                <img src="{{asset('assets/frontend/images/sample1.gif')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</main>
@endsection
