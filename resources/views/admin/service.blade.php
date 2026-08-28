@extends('layouts.master')
@section('title', 'Service Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Service</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if (@isset($serviceData))
                                <i class="fas fa-edit"></i> Service Update
                            @else
                                <i class="fab fa-bandcamp"></i> Service Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$serviceData) ? route('service.update', $serviceData->id) : route('service.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ @$serviceData->name }}" class="form-control form-control-sm shadow-none" id="name" required>
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="icon" class="col-sm-3 col-form-label">Icon Class</label>
                                <div class="col-sm-9">
                                    <input type="text" name="icon" value="{{ @$serviceData->icon }}" class="form-control form-control-sm shadow-none" id="icon" placeholder="e.g. fas fa-truck">
                                </div>

                                <label for="short_description" class="col-sm-3 col-form-label">Short Desc</label>
                                <div class="col-sm-9">
                                    <textarea name="short_description" class="form-control form-control-sm shadow-none" id="short_description" rows="2">{{ @$serviceData->short_description }}</textarea>
                                </div>

                                <label for="description" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control form-control-sm shadow-none" id="editor" rows="3">{{ @$serviceData->description }}</textarea>
                                </div>

                                <label for="type" class="col-sm-3 col-form-label">Section</label>
                                <div class="col-sm-9">
                                    <select name="type" class="form-control form-control-sm shadow-none" id="type">
                                        <option value="furniture" {{ @$serviceData->type == 'furniture' ? 'selected' : '' }}>Furniture (Buy & Sell)</option>
                                        <option value="relocation" {{ @$serviceData->type == 'relocation' ? 'selected' : '' }}>Relocation</option>
                                    </select>
                                </div>

                                <label for="order" class="col-sm-3 col-form-label">Order</label>
                                <div class="col-sm-9">
                                    <input type="number" name="order" value="{{ @$serviceData->order ?? 0 }}" class="form-control form-control-sm shadow-none" id="order">
                                </div>

                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control shadow-none" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                    <div>
                                        <img src="{{ (!empty(@$serviceData)) ? asset(@$serviceData->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$serviceData) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>

            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Service List</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Order</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $item)
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
                                        <td>{{ $item->order }}</td>
                                        <td>{{ ucfirst($item->type ?? 'furniture') }}</td>
                                        <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('service.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('service.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
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
