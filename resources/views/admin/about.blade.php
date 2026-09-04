@extends('layouts.master')
@section('title', 'Update About')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > About</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            <i class="fas fa-edit"></i> Update About
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        
                            <form method="post" action="{{ route('about.update', $about->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title" value="{{ $about->title }}" class="form-control form-control-sm shadow-none" id="title">
                                                @error('title') <span style="color: red">{{$message}}</span> @enderror
                                            </div>

                                            <label for="subtitle" class="col-sm-3 col-form-label">Subtitle</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="subtitle" value="{{ @$about->subtitle }}" class="form-control form-control-sm shadow-none" id="subtitle">
                                            </div>

                                            <label for="inputPassword" class="col-sm-3 col-form-label">Image </label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" class="form-control shadow-none" id="image" onchange="mainThambUrl(this)">
                                                @error('image') <span style="color: red">{{$message}}</span> @enderror
                                                
                                                <div class="">
                                                    <img src="{{ (!empty($about)) ? asset($about->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" class="form-control form-control-sm shadow-none" id="editor" rows="4">{{ @$about->description }}</textarea>
                                                @error('description') <span style="color: red">{{$message}}</span> @enderror
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">
                                <h6 class="text-primary text-uppercase font-weight-bold">Checkmarks (List Items)</h6>
                                <div class="row">
                                    @for($i = 0; $i < 4; $i++)
                                    <div class="col-lg-6 mb-2">
                                        <label for="checkmark{{ $i }}" class="col-sm-3 col-form-label">Check #{{ $i + 1 }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="checkmarks[]" value="{{ @$about->checkmarks[$i] }}" class="form-control form-control-sm shadow-none" id="checkmark{{ $i }}">
                                        </div>
                                    </div>
                                    @endfor
                                </div>

                                <hr class="my-2">
                                <h6 class="text-primary text-uppercase font-weight-bold">Buttons</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="button_text" class="col-sm-3 col-form-label">Button 1 Text</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="button_text" value="{{ @$about->button_text }}" class="form-control form-control-sm shadow-none" id="button_text">
                                            </div>
                                            <label for="button_link" class="col-sm-3 col-form-label">Button 1 Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="button_link" value="{{ @$about->button_link }}" class="form-control form-control-sm shadow-none" id="button_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="button2_text" class="col-sm-3 col-form-label">Button 2 Text</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="button2_text" value="{{ @$about->button2_text }}" class="form-control form-control-sm shadow-none" id="button2_text">
                                            </div>
                                            <label for="button2_link" class="col-sm-3 col-form-label">Button 2 Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="button2_link" value="{{ @$about->button2_link }}" class="form-control form-control-sm shadow-none" id="button2_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">
                                <h6 class="text-primary text-uppercase font-weight-bold">Counters (Stats Overlay)</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="counter1_number" class="col-sm-3 col-form-label">Counter 1 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter1_number" value="{{ @$about->counter1_number }}" class="form-control form-control-sm shadow-none" id="counter1_number">
                                            </div>
                                            <label for="counter1_label" class="col-sm-3 col-form-label">Counter 1 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter1_label" value="{{ @$about->counter1_label }}" class="form-control form-control-sm shadow-none" id="counter1_label">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="counter2_number" class="col-sm-3 col-form-label">Counter 2 Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter2_number" value="{{ @$about->counter2_number }}" class="form-control form-control-sm shadow-none" id="counter2_number">
                                            </div>
                                            <label for="counter2_label" class="col-sm-3 col-form-label">Counter 2 Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="counter2_label" value="{{ @$about->counter2_label }}" class="form-control form-control-sm shadow-none" id="counter2_label">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="badge_number" class="col-sm-3 col-form-label">Badge Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="badge_number" value="{{ @$about->badge_number }}" class="form-control form-control-sm shadow-none" id="badge_number">
                                            </div>
                                            <label for="badge_label" class="col-sm-3 col-form-label">Badge Label</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="badge_label" value="{{ @$about->badge_label }}" class="form-control form-control-sm shadow-none" id="badge_label">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit" class="btn btn-success shadow-none">Update</button>
                                    </div>
                                </div>
                            </form> 
                        
                         
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
            $('#mainThmb').attr('src',e.target.result).width(100)
                  .height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

</script>

<script>
    CKEDITOR.replace( 'editor' );
</script>

@endpush

