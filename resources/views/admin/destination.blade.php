@extends('layouts.master')
@section('title', 'Destinations')
@section('main-content')
<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading"><i class="fas fa-home"></i> <a href="">Home</a> > Destinations</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header">
                        <div class="table-head">
                            @if(@isset($destinationData))
                                <i class="fas fa-edit"></i> Edit Destination
                            @else
                                <i class="fas fa-map-marker-alt"></i> Add Destination
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"
                            action="{{ (@$destinationData) ? route('destination.update', $destinationData->id) : route('destination.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"
                                        value="{{ (@$destinationData->name) ? @$destinationData->name : old('name') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. The Colosseum">
                                    @error('name') <span style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control form-control-sm shadow-none" rows="3"
                                        placeholder="Short description shown on hover...">{{ (@$destinationData->description) ? @$destinationData->description : old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Image <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control form-control-sm shadow-none"
                                        id="destImage" onchange="previewImg(this, 'destThumb')">
                                    @error('image') <span style="color:red">{{ $message }}</span> @enderror
                                    <img src="{{ (!empty(@$destinationData)) ? asset(@$destinationData->image) : asset('images/no.png') }}"
                                        id="destThumb" style="width:80px;height:80px;border:1px solid #ccc;padding:2px;margin-top:5px" alt="">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Link</label>
                                <div class="col-sm-9">
                                    <input type="text" name="link"
                                        value="{{ (@$destinationData->link) ? @$destinationData->link : '#tours' }}"
                                        class="form-control form-control-sm shadow-none" placeholder="#tours">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Sort Order</label>
                                <div class="col-sm-9">
                                    <input type="number" name="sort_order"
                                        value="{{ (@$destinationData->sort_order) ? @$destinationData->sort_order : 0 }}"
                                        class="form-control form-control-sm shadow-none">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Active</label>
                                <div class="col-sm-9">
                                    <select name="is_active" class="form-control form-control-sm shadow-none">
                                        <option value="1" {{ (@$destinationData->is_active == 1) ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ (@$destinationData->is_active == 0) ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="text-end">
                                <button type="reset" class="btn btn-danger btn-sm shadow-none">Reset</button>
                                <button type="submit" class="btn btn-success btn-sm shadow-none">
                                    {{ (@$destinationData) ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Destination List</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Sort</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($destinations as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->image) }}" width="40" height="40" style="object-fit:cover;border-radius:6px" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->sort_order }}</td>
                                        <td>
                                            @if($item->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('destination.edit', $item->id) }}" class="btn btn-edit btn-sm shadow-none"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('destination.delete') }}" id="delete" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" class="btn btn-delete btn-sm shadow-none"><i class="fa fa-trash"></i></a>
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
function previewImg(input, thumbId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById(thumbId).src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
