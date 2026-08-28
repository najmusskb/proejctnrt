@extends('layouts.master')
@section('title', 'Category Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Category</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if (@isset($categoryData))
                            <i class="fas fa-edit"></i> Category Update
                            @else
                            <i class="fab fa-bandcamp"></i> Category Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form id="form" method="post" action="{{ (@$categoryData) ? route('category.update', $categoryData->id) :route('category.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ (@$categoryData) ? @$categoryData->name : old('name') }}" class="form-control shadow-none form-control-sm">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="section" class="col-sm-3 col-form-label">Section</label>
                                <div class="col-sm-9">
                                    <select name="section" class="form-control shadow-none form-control-sm" id="section">
                                        <option value="furniture" {{ @$categoryData->section == 'furniture' ? 'selected' : '' }}>Buy and Sell Used Furniture in Doha, Qatar</option>
                                        <option value="relocation" {{ @$categoryData->section == 'relocation' ? 'selected' : '' }}>Professional Relocation Solutions</option>
                                    </select>
                                </div>

                                <label for="description" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control shadow-none form-control-sm" id="editor" rows="4" placeholder="Short description about this category">{{ (@$categoryData) ? @$categoryData->description : old('description') }}</textarea>
                                </div>

                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control shadow-none" id="image" accept=".jpg,.jpeg,.png,.gif,.webp" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                    
                                    <div class="">
                                        <img src="{{ (!empty(@$categoryData)) ? asset(@$categoryData->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                    </div>
                                </div>

                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$categoryData) ? 'Update change' : 'Save change' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Category List</div>
                        <div class="float-right">
                          
                        </div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->image) }}" width="30" height="30" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ ($item->section == 'relocation') ? 'Professional Relocation Solutions' : 'Buy and Sell Used Furniture in Doha, Qatar' }}</td>
                                        <td class="text-start" style="max-width:220px">{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-edit edit-category"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('category.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete shadow-none"><i class="fa fa-trash"></i></a>
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
        var reader    = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush

