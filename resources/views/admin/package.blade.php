@extends('layouts.master')
@section('title', 'Packages')
@section('main-content')
<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading"><i class="fas fa-home"></i> <a href="">Home</a> > Rome Packages</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header">
                        <div class="table-head">
                            @if(@isset($packageData))
                                <i class="fas fa-edit"></i> Edit Package
                            @else
                                <i class="fas fa-box"></i> Add Package
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"
                            action="{{ (@$packageData) ? route('package.update', $packageData->id) : route('package.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name"
                                        value="{{ (@$packageData->name) ? @$packageData->name : old('name') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. Ancient Rome Full Day">
                                    @error('name') <span style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Subtitle</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subtitle"
                                        value="{{ (@$packageData->subtitle) ? @$packageData->subtitle : old('subtitle') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. Colosseum, Roman Forum & Palatine Hill">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Badge Label</label>
                                <div class="col-sm-9">
                                    <input type="text" name="badge_label"
                                        value="{{ (@$packageData->badge_label) ? @$packageData->badge_label : old('badge_label') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. FULL DAY, HALF DAY, EVENING">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Badge Icon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="badge_icon"
                                        value="{{ (@$packageData->badge_icon) ? @$packageData->badge_icon : old('badge_icon') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. 🏛️ Ancient Rome">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Price (€)</label>
                                <div class="col-sm-9">
                                    <input type="number" name="price" step="0.01"
                                        value="{{ (@$packageData->price) ? @$packageData->price : old('price') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="e.g. 89">
                                    @error('price') <span style="color:red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Highlights</label>
                                <div class="col-sm-9">
                                    <input type="text" name="highlights"
                                        value="{{ (@$packageData) ? implode(', ', (array)@$packageData->highlights) : old('highlights') }}"
                                        class="form-control form-control-sm shadow-none" placeholder="Comma-separated: Colosseum, Roman Forum, Skip-the-line">
                                    <small class="text-muted">Separate tags with comma</small>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Image <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control form-control-sm shadow-none"
                                        id="pkgImage" onchange="previewImg(this, 'pkgThumb')">
                                    @error('image') <span style="color:red">{{ $message }}</span> @enderror
                                    <img src="{{ (!empty(@$packageData)) ? asset(@$packageData->image) : asset('images/no.png') }}"
                                        id="pkgThumb" style="width:80px;height:80px;border:1px solid #ccc;padding:2px;margin-top:5px;object-fit:cover" alt="">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Sort Order</label>
                                <div class="col-sm-9">
                                    <input type="number" name="sort_order"
                                        value="{{ (@$packageData->sort_order) ? @$packageData->sort_order : 0 }}"
                                        class="form-control form-control-sm shadow-none">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-sm-3 col-form-label">Active</label>
                                <div class="col-sm-9">
                                    <select name="is_active" class="form-control form-control-sm shadow-none">
                                        <option value="1" {{ (@$packageData->is_active == 1) ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ (@$packageData->is_active == 0) ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="text-end">
                                <button type="reset" class="btn btn-danger btn-sm shadow-none">Reset</button>
                                <button type="submit" class="btn btn-success btn-sm shadow-none">
                                    {{ (@$packageData) ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Package List</div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->image) }}" width="50" height="40" style="object-fit:cover;border-radius:6px" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>€{{ number_format($item->price, 0) }}</td>
                                        <td>
                                            @if($item->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('package.edit', $item->id) }}" class="btn btn-edit btn-sm shadow-none"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('package.delete') }}" id="delete" data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" class="btn btn-delete btn-sm shadow-none"><i class="fa fa-trash"></i></a>
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
