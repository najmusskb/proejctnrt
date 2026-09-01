@extends('layouts.master')

@section('main-content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Home Page Settings</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('home_page_settings.update') }}" method="POST">
                            @csrf

                            <!-- Destinations Section -->
                            <h5 class="mb-3 mt-4">Destinations Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="dest_subtitle" class="form-control" value="{{ $setting->dest_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="dest_title" class="form-control" value="{{ $setting->dest_title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="dest_desc" class="form-control" rows="2">{{ $setting->dest_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Tours Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Tours Section</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="tours_subtitle" class="form-control" value="{{ $setting->tours_subtitle }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="tours_title" class="form-control" value="{{ $setting->tours_title }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="tours_btn" class="form-control" value="{{ $setting->tours_btn }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="tours_desc" class="form-control" rows="2">{{ $setting->tours_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Categories Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Categories Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="cat_subtitle" class="form-control" value="{{ $setting->cat_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="cat_title" class="form-control" value="{{ $setting->cat_title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="cat_desc" class="form-control" rows="2">{{ $setting->cat_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Packages Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Packages Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="pkg_subtitle" class="form-control" value="{{ $setting->pkg_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="pkg_title" class="form-control" value="{{ $setting->pkg_title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="pkg_desc" class="form-control" rows="2">{{ $setting->pkg_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Services Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Services Section</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="srv_subtitle" class="form-control" value="{{ $setting->srv_subtitle }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="srv_title" class="form-control" value="{{ $setting->srv_title }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="srv_btn" class="form-control" value="{{ $setting->srv_btn }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="srv_desc" class="form-control" rows="2">{{ $setting->srv_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Why Choose Us Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Why Choose Us Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="wcu_subtitle" class="form-control" value="{{ $setting->wcu_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="wcu_title" class="form-control" value="{{ $setting->wcu_title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="wcu_desc" class="form-control" rows="2">{{ $setting->wcu_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Partners Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Partners Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="partners_subtitle" class="form-control" value="{{ $setting->partners_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="partners_title" class="form-control" value="{{ $setting->partners_title }}">
                                </div>
                            </div>

                            <!-- Blog Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Blog Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="blog_subtitle" class="form-control" value="{{ $setting->blog_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="blog_title" class="form-control" value="{{ $setting->blog_title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="blog_desc" class="form-control" rows="2">{{ $setting->blog_desc }}</textarea>
                                </div>
                            </div>

                            <!-- Testimonials Section -->
                            <h5 class="mb-3 mt-4 border-top pt-3">Testimonials Section</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="testi_subtitle" class="form-control" value="{{ $setting->testi_subtitle }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="testi_title" class="form-control" value="{{ $setting->testi_title }}">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-md">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
