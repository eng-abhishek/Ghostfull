@extends('frontend.layouts.app')
@section('content')
<main>
    <div class="container-fluid">            
        <div class="row justify-content-center align-items-center">
            <div class="col-xxl-12 col-xl-12 col-md-12 my-3 text-center">
                <h1>Pricing</h1>
                <p>Ghostful provides free hosting services. Upgrade to unlock all the features.</p>
            </div>
        </div> 
        <div class="row justify-content-evenly justify-content-xxl-center align-items-center">
            <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6 my-3">
                <div class="pricing-wrap">
                    <div class="pricing-head bg1">
                        <h2>Basic</h2>
                        <p>Lorem ipsum consectetur.</p>
                    </div>
                    <div class="pricing-gap">
                        <div class="pricing-body bg1">
                            <ul class="list-unstyled">
                                <li><span class="no"></span> No Ads</li>
                                <li><span class="no"></span> Direct Linking</li>
                                <li><span class="no"></span> Unlimited space</li>
                                <li><span class="yes"></span> 2 MB file size per image</li>
                                <li><span class="no"></span> Image Resizing</li>
                            </ul>
                            <div class="text-center">
                                <h3>Free</h3>
                                <a href="{{url('sign-up')}}" class="btn btn-outline-light">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6 my-3">
                <div class="pricing-wrap">
                    <div class="pricing-head bg2">
                        <h2>Standard</h2>
                        <p>Lorem ipsum consectetur.</p>
                    </div>
                    <div class="pricing-gap">
                        <div class="pricing-body bg2">
                            <ul class="list-unstyled">
                                <li><span class="no"></span> No Ads</li>
                                <li><span class="yes"></span> Direct Linking</li>
                                <li><span class="no"></span> Unlimited space</li>
                                <li><span class="yes"></span> 10 MB file size per image</li>
                                <li><span class="no"></span> Image Resizing</li>
                            </ul>
                            <div class="text-center">
                                <h3>INR 200/pm</h3>
                                <a href="{{url('sign-up')}}" class="btn btn-outline-light">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6 my-3">
                <div class="pricing-wrap">
                    <div class="pricing-head bg3">
                        <h2>Premium</h2>
                        <p>Lorem ipsum consectetur.</p>
                    </div>
                    <div class="pricing-gap">
                        <div class="pricing-body bg3">
                            <ul class="list-unstyled">
                                <li><span class="yes"></span> No Ads</li>
                                <li><span class="yes"></span> Direct Linking</li>
                                <li><span class="yes"></span> Unlimited space</li>
                                <li><span class="yes"></span> 64 MB file size per image</li>
                                <li><span class="yes"></span> Image Resizing</li>
                            </ul>
                            <div class="text-center">
                                <h3>INR 500/pm</h3>
                                <a href="{{url('sign-up')}}" class="btn btn-outline-light">Signup</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <div class="row mt-3">
            <div class="col-xl-12 text-center my-3">
                <img src="frontend/assets/images/sample1.gif" alt="" class="img-fluid">
            </div>
        </div>  
    </div>
</main>
@endsection