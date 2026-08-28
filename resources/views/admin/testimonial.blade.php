@extends('layouts.master')
@section('title', 'Testimonial Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Testimonial</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if (@isset($testimonialData))
                                <i class="fas fa-edit"></i> Testimonial Update
                            @else
                                <i class="fab fa-bandcamp"></i> Testimonial Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$testimonialData) ? route('testimonial.update', $testimonialData->id) : route('testimonial.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ @$testimonialData->name }}" class="form-control form-control-sm shadow-none" id="name" required>
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                                <div class="col-sm-9">
                                    <input type="text" name="designation" value="{{ @$testimonialData->designation }}" class="form-control form-control-sm shadow-none" id="designation">
                                </div>

                                <label for="review" class="col-sm-3 col-form-label">Review</label>
                                <div class="col-sm-9">
                                    <textarea name="review" class="form-control form-control-sm shadow-none" id="review" rows="3" required>{{ @$testimonialData->review }}</textarea>
                                    @error('review') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="rating" class="col-sm-3 col-form-label">Rating</label>
                                <div class="col-sm-9">
                                    <select name="rating" class="form-control form-control-sm shadow-none">
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ (@$testimonialData->rating == $i) ? 'selected' : '' }}>{{ $i }} Star</option>
                                        @endfor
                                    </select>
                                </div>

                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control shadow-none" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                    <div>
                                        <img src="{{ (!empty(@$testimonialData)) ? asset(@$testimonialData->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$testimonialData) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>

            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Testimonial List</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonial as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" width="30" height="30" alt="">
                                            @else
                                                <span>---</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->rating }}</td>
                                        <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('testimonial.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('testimonial.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            $('#mainThmb').attr('src',e.target.result).width(100).height(100);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
@endpush
