@extends('frontend.layouts.app')
@section('content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
         
            <div class="col-xxl-5 col-xl-10 col-lg-12">
                <div class="uploader-main text-center d-flex flex-column justify-content-center align-items-center dropzone p-3">
                    <span class="dropzone-message">Drop Here</span>
                    <div class="row">
                        <div class="col-xxl-12">
                            <span class="upload-icon animate__bounce"></span>
                            <h1 class="mb-5">Upload and share your images</h1>
                            <p class="mb-5"><span class="strikethrough">Drag and drop anywhere you want and</span> start uploading your images now. 32 MB limit. Direct image links and HTML thumbnails.</p>
                            <div class="row mb-3 hide-noscript">
                                <div class="col-xxl-12">
                                    <button type="button" class="btn btn-outline-light" data-trigger="image_uploader">Start Uploading</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="row hide-script" enctype="multipart/form-data" action="{{route('file-uploads')}}">
                        <div class="row mb-3">
                            <div class="col-xxl-12">
                                <input type="file" name="image_uploader[]" id="image_uploader" class="form-control mb-3" multiple accept="image/*">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xxl-12">
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
                        <div class="row mb-3 hide-script text-center">
                            <div class="col-xxl-12">
                                <button type="submit" class="btn btn-outline-light">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection