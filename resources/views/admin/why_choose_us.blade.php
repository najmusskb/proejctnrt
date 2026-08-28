@extends('layouts.master')
@section('title', 'Why Choose Us Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Why Choose Us</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if (@isset($whyData))
                                <i class="fas fa-edit"></i> Item Update
                            @else
                                <i class="fab fa-bandcamp"></i> Item Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$whyData) ? route('why_choose_us.update', $whyData->id) : route('why_choose_us.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" value="{{ @$whyData->title }}" class="form-control form-control-sm shadow-none" id="title" required>
                                    @error('title') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="icon" class="col-sm-3 col-form-label">Icon Class</label>
                                <div class="col-sm-9">
                                    <input type="text" name="icon" value="{{ @$whyData->icon }}" class="form-control form-control-sm shadow-none" id="icon" placeholder="e.g. fas fa-search-dollar">
                                </div>

                                <label for="description" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control form-control-sm shadow-none" id="editor" rows="4" required>{{ @$whyData->description }}</textarea>
                                    @error('description') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="image" class="col-sm-3 col-form-label">Section Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control shadow-none" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                    <div class="mt-2">
                                        <img src="{{ (!empty(@$whyData->image)) ? asset(@$whyData->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #999; padding: 2px;" alt="">
                                    </div>
                                    <small class="text-muted">This image shows at the top of the Why Choose Us section on the homepage.</small>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$whyData) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>

            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Why Choose Us List</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($why_choose_us as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" width="40" height="40" style="object-fit:cover;border-radius:4px" alt="">
                                            @else
                                                <span>---</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->icon ? $item->icon : '---' }}</td>
                                        <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('why_choose_us.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('why_choose_us.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
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
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush
