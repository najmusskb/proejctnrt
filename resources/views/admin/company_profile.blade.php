@extends('layouts.master')
@section('title', 'Update Company Profile')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Company Profile</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            <i class="fas fa-edit"></i> Update Company Profile
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <div class="row">
                            <form method="post" action="{{ route('company.profile.update', $com_profile->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="com_name" value="{{ $com_profile->com_name }}" class="form-control form-control-sm shadow-none">
                                                @error('com_name') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            <label for="" class="col-sm-3 col-form-label">Phone One</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone" value="{{ $com_profile->phone }}" class="form-control form-control-sm shadow-none">
                                                @error('phone') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="" class="col-sm-3 col-form-label">WhatsApp Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="whatsapp" value="{{ $com_profile->whatsapp }}" class="form-control form-control-sm shadow-none" placeholder="e.g. +974 77804557">
                                                <small class="text-muted">With country code. Shown on the WhatsApp floating button.</small>
                                                @error('whatsapp') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            <label for="" class="col-sm-3 col-form-label">Phone Two</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone_two" value="{{ $com_profile->phone_two }}" class="form-control form-control-sm shadow-none">
                                                @error('phone_two') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" value="{{ $com_profile->email }}" class="form-control form-control-sm shadow-none">
                                                @error('email') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="" class="col-sm-3 col-form-label">Email-2</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email1" value="{{ $com_profile->email1 }}" class="form-control form-control-sm shadow-none">
                                                @error('email1') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="" class="col-sm-3 col-form-label">Map</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="map" value="{{ $com_profile->map }}" class="form-control form-control-sm shadow-none">
                                                @error('map') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            <label for="" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="address" rows="2" class="form-control form-control-sm shadow-none">{{ $com_profile->address }}</textarea>
                                                @error('address') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Phone Three</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone_three" value="{{ $com_profile->phone_three }}" class="form-control form-control-sm shadow-none">
                                                @error('phone_three') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="title" class="col-sm-3 col-form-label">Facebook</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="facebook" value="{{ $com_profile->facebook }}" class="form-control form-control-sm shadow-none" id="facebook">
                                                @error('facebook') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
        
                                            <label for="title" class="col-sm-3 col-form-label">Twitter</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="twitter" value="{{ $com_profile->twitter }}" class="form-control form-control-sm shadow-none" id="twitter">
                                                @error('twitter') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
            
                                            <label for="title" class="col-sm-3 col-form-label">Youtube</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="youtube" value="{{ $com_profile->youtube }}" class="form-control form-control-sm shadow-none">
                                                @error('youtube') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            
            
                                            <label for="title" class="col-sm-3 col-form-label">Instagram</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="instagram" value="{{ $com_profile->instagram }}" class="form-control form-control-sm shadow-none">
                                                @error('instagram') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            

                                            <div class="col-12 my-3"><hr><h6 class="text-primary">Counter Stats</h6></div>

                                            <label class="col-sm-3 col-form-label">Counter 1 Icon</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter1_icon" value="{{ $com_profile->counter1_icon ?? 'fas fa-users' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 1 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter1_number" value="{{ $com_profile->counter1_number ?? '1,658+' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 1 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter1_label" value="{{ $com_profile->counter1_label ?? 'Happy Customers' }}" class="form-control form-control-sm shadow-none">
                                            </div>

                                            <label class="col-sm-3 col-form-label">Counter 2 Icon</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter2_icon" value="{{ $com_profile->counter2_icon ?? 'fas fa-cogs' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 2 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter2_number" value="{{ $com_profile->counter2_number ?? '254+' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 2 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter2_label" value="{{ $com_profile->counter2_label ?? 'Project Complete' }}" class="form-control form-control-sm shadow-none">
                                            </div>

                                            <label class="col-sm-3 col-form-label">Counter 3 Icon</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter3_icon" value="{{ $com_profile->counter3_icon ?? 'fas fa-user-shield' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 3 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter3_number" value="{{ $com_profile->counter3_number ?? '2M+' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 3 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter3_label" value="{{ $com_profile->counter3_label ?? 'Registered Member' }}" class="form-control form-control-sm shadow-none">
                                            </div>

                                            <label class="col-sm-3 col-form-label">Counter 4 Icon</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter4_icon" value="{{ $com_profile->counter4_icon ?? 'fas fa-trophy' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 4 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter4_number" value="{{ $com_profile->counter4_number ?? '12+' }}" class="form-control form-control-sm shadow-none">
                                            </div>
                                            <label class="col-sm-3 col-form-label">Counter 4 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter4_label" value="{{ $com_profile->counter4_label ?? 'Years Experience' }}" class="form-control form-control-sm shadow-none">
                                            </div>

                                            <label for="inputPassword" class="col-sm-3 col-form-label">Logo</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" class="form-control shadow-none" id="logo" onchange="mainThambUrl(this)">
                                                @error('image') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($com_profile)) ? asset($com_profile->logo) : asset('images/no.png') }}" id="logoThmb" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                            </div>

                                            <label for="cta_bg" class="col-sm-3 col-form-label">CTA Background Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="cta_bg" class="form-control shadow-none" id="cta_bg" onchange="mainThambUrl(this)">
                                                @error('cta_bg') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($com_profile)) ? asset($com_profile->cta_bg) : asset('images/no.png') }}" id="ctaThmb" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                                <small class="text-muted">Shown as background of the "Get Contact Us fast" section on the homepage.</small>
                                            </div>

                                            <label for="favicon" class="col-sm-3 col-form-label">Favicon</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="favicon" class="form-control shadow-none" id="favicon" onchange="faviconThmbUrl(this)">
                                                @error('favicon') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($com_profile) && !empty($com_profile->favicon)) ? asset($com_profile->favicon) : asset('images/no.png') }}" id="faviconThmb" style="width: 32px; height: 32px; object-fit: cover; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                                <small class="text-muted">Browser tab icon. Best: square PNG/ICO, 32x32 or 64x64 px.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit" class="btn btn-success shadow-none">Save</button>
                                    </div>
                                </div>
                            </form> 
                        </div>
                         
                    </div>
                </div>  
            </div>
            
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $(input).closest('.col-sm-9').find('img').attr('src',e.target.result).width(100).height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function faviconThmbUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#faviconThmb').attr('src',e.target.result).width(32).height(32);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

@endpush




