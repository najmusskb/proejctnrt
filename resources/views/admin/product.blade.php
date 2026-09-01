@extends('layouts.master')
@section('title', 'Products Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Product">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Products (Tours)</span>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if(@isset($productData))
                                <i class="fas fa-edit"></i> Product Update
                            @else
                                <i class="fab fa-bandcamp"></i> Product Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$productData) ? route('product.update', $productData->id) : route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ @$productData->name }}" class="form-control form-control-sm shadow-none" id="name" required>
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="category_id" class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control form-control-sm shadow-none">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ @$productData->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="destination_id" class="col-sm-3 col-form-label">Destination</label>
                                <div class="col-sm-9">
                                    <select name="destination_id" class="form-control form-control-sm shadow-none">
                                        <option value="">-- Select Destination --</option>
                                        @foreach($destinations as $dest)
                                            <option value="{{ $dest->id }}" {{ @$productData->destination_id == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="price" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-3">
                                    <input type="number" step="0.01" name="price" value="{{ @$productData->price }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="old_price" class="col-sm-3 col-form-label">Old Price</label>
                                <div class="col-sm-3">
                                    <input type="number" step="0.01" name="old_price" value="{{ @$productData->old_price }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="duration" class="col-sm-3 col-form-label">Duration</label>
                                <div class="col-sm-3">
                                    <input type="text" name="duration" value="{{ @$productData->duration }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="group_size" class="col-sm-3 col-form-label">Group Size</label>
                                <div class="col-sm-3">
                                    <input type="text" name="group_size" value="{{ @$productData->group_size }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="badge_type" class="col-sm-3 col-form-label">Badge</label>
                                <div class="col-sm-9">
                                    <input type="text" name="badge_type" value="{{ @$productData->badge_type }}" class="form-control form-control-sm shadow-none" placeholder="e.g. Bestseller">
                                </div>

                                <label for="rating" class="col-sm-3 col-form-label">Rating</label>
                                <div class="col-sm-3">
                                    <input type="number" step="0.1" name="rating" value="{{ @$productData->rating }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="reviews_count" class="col-sm-3 col-form-label">Reviews</label>
                                <div class="col-sm-3">
                                    <input type="number" name="reviews_count" value="{{ @$productData->reviews_count }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="free_cancellation" class="col-sm-3 col-form-label">Free Cancel</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="free_cancellation" value="1" {{ (!isset($productData) || @$productData->free_cancellation) ? 'checked' : '' }}>
                                </div>

                                <label for="short_description" class="col-sm-3 col-form-label">Short Desc.</label>
                                <div class="col-sm-9">
                                    <textarea name="short_description" class="form-control form-control-sm shadow-none" rows="3">{{ @$productData->short_description }}</textarea>
                                </div>

                                <label for="description" class="col-sm-3 col-form-label">Full Desc.</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control form-control-sm shadow-none" id="editor" rows="5">{{ @$productData->description }}</textarea>
                                </div>

                                <label for="included" class="col-sm-3 col-form-label">Included (1 per line)</label>
                                <div class="col-sm-9">
                                    <textarea name="included" class="form-control form-control-sm shadow-none" rows="3">{{ @$productData->included ? implode("\n", json_decode(@$productData->included, true)) : '' }}</textarea>
                                </div>

                                <label for="excluded" class="col-sm-3 col-form-label">Excluded (1 per line)</label>
                                <div class="col-sm-9">
                                    <textarea name="excluded" class="form-control form-control-sm shadow-none" rows="3">{{ @$productData->excluded ? implode("\n", json_decode(@$productData->excluded, true)) : '' }}</textarea>
                                </div>

                                <label for="itinerary" class="col-sm-3 col-form-label">Itinerary (1 per line)</label>
                                <div class="col-sm-9">
                                    <textarea name="itinerary" class="form-control form-control-sm shadow-none" rows="3">{{ @$productData->itinerary ? implode("\n", json_decode(@$productData->itinerary, true)) : '' }}</textarea>
                                </div>

                                <label for="map_iframe" class="col-sm-3 col-form-label">Map Iframe URL</label>
                                <div class="col-sm-9">
                                    <textarea name="map_iframe" class="form-control form-control-sm shadow-none" rows="2" placeholder='e.g., https://www.google.com/maps?q=Colosseum,Rome&output=embed'>{{ @$productData->map_iframe }}</textarea>
                                </div>

                                <label for="meeting_point" class="col-sm-3 col-form-label">Meeting Point Instructions</label>
                                <div class="col-sm-9">
                                    <textarea name="meeting_point" class="form-control form-control-sm shadow-none" rows="2">{{ @$productData->meeting_point }}</textarea>
                                </div>

                                <label for="cancellation_policy" class="col-sm-3 col-form-label">Cancellation Policy (1 per line)</label>
                                <div class="col-sm-9">
                                    <textarea name="cancellation_policy" class="form-control form-control-sm shadow-none" rows="3">{{ @$productData->cancellation_policy ? implode("\n", json_decode(@$productData->cancellation_policy, true)) : '' }}</textarea>
                                </div>

                                <label class="col-sm-3 col-form-label">FAQs</label>
                                <div class="col-sm-9">
                                    <div id="faq-container">
                                        @php
                                            $faqs = @$productData->faqs ? json_decode(@$productData->faqs, true) : [];
                                        @endphp
                                        @if(count($faqs) > 0)
                                            @foreach($faqs as $i => $faq)
                                            <div class="faq-item border p-2 mb-2 bg-light">
                                                <input type="text" name="faqs_q[]" value="{{ $faq['q'] }}" class="form-control form-control-sm shadow-none mb-1" placeholder="Question">
                                                <textarea name="faqs_a[]" class="form-control form-control-sm shadow-none mb-1" rows="2" placeholder="Answer">{{ $faq['a'] }}</textarea>
                                                <button type="button" class="btn btn-sm btn-danger remove-faq">Remove FAQ</button>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary mt-1" id="add-faq">Add FAQ</button>
                                </div>

                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-3">
                                    <select name="status" class="form-control form-control-sm shadow-none">
                                        <option value="1" {{ @$productData->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ isset($productData) && $productData->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <label for="sort_order" class="col-sm-3 col-form-label">Sort Order</label>
                                <div class="col-sm-3">
                                    <input type="number" name="sort_order" value="{{ @$productData->sort_order ?? 0 }}" class="form-control form-control-sm shadow-none">
                                </div>

                                <label for="image" class="col-sm-3 col-form-label">Primary Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control shadow-none" id="image" onchange="mainThambUrl(this)">
                                    @error('image') <span style="color: red">{{$message}}</span> @enderror
                                    <div class="mt-2">
                                        <img src="{{ (!empty(@$productData) && @$productData->image) ? asset(@$productData->image) : asset('images/no.png') }}" id="mainThmb" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" alt="">
                                    </div>
                                </div>
                                
                                <label for="gallery_images" class="col-sm-3 col-form-label mt-3">Gallery Images</label>
                                <div class="col-sm-9 mt-3">
                                    <input type="file" name="gallery_images[]" class="form-control shadow-none" id="gallery_images" multiple onchange="previewGalleryImages(this)">
                                    @error('gallery_images') <span style="color: red">{{$message}}</span> @enderror
                                    
                                    <!-- Container for new image previews -->
                                    <div id="gallery_preview_container" class="mt-3 d-flex flex-wrap" style="gap: 10px;"></div>
                                    
                                    @if(isset($productData) && $productData->images->count() > 0)
                                    <div class="mt-3">
                                        <strong>Existing Images:</strong>
                                        <div class="mt-2 d-flex flex-wrap" style="gap: 10px;">
                                            @foreach($productData->images as $img)
                                            <div class="position-relative" id="pimg_{{ $img->id }}">
                                                <img src="{{ asset($img->image) }}" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px; object-fit: cover;" alt="">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 2px; right: 2px; padding: 0px 5px;" onclick="deleteProductImage({{ $img->id }})"><i class="fas fa-times"></i></button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$productData)? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>

            <div class="col-lg-6">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Product List</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset($item->image ?? 'images/no.png') }}" width="40" height="40" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('product.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
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
    
    let selectedFiles = [];

    function previewGalleryImages(input) {
        let previewContainer = document.getElementById('gallery_preview_container');
        
        // Add new files to our selectedFiles array
        if (input.files) {
            for (let i = 0; i < input.files.length; i++) {
                selectedFiles.push(input.files[i]);
            }
        }
        
        renderGalleryPreviews();
    }

    function renderGalleryPreviews() {
        let previewContainer = document.getElementById('gallery_preview_container');
        previewContainer.innerHTML = ''; // Clear existing previews
        
        // Update the actual file input using DataTransfer
        let dataTransfer = new DataTransfer();
        
        selectedFiles.forEach((file, index) => {
            dataTransfer.items.add(file);
            
            let reader = new FileReader();
            reader.onload = function(e) {
                let div = document.createElement('div');
                div.className = 'position-relative';
                
                let img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.border = '1px solid #999';
                img.style.padding = '2px';
                img.style.objectFit = 'cover';
                
                let btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-sm btn-danger position-absolute';
                btn.style.top = '2px';
                btn.style.right = '2px';
                btn.style.padding = '0px 5px';
                btn.innerHTML = '<i class="fas fa-times"></i>';
                btn.onclick = function() {
                    removeGalleryImage(index);
                };
                
                div.appendChild(img);
                div.appendChild(btn);
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        
        document.getElementById('gallery_images').files = dataTransfer.files;
    }

    function removeGalleryImage(index) {
        selectedFiles.splice(index, 1);
        renderGalleryPreviews();
    }

    
    function deleteProductImage(id) {
        if(confirm('Are you sure you want to delete this gallery image?')) {
            $.ajax({
                url: "{{ route('product.image.delete') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if(response.success) {
                        $('#pimg_' + id).remove();
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        $('#add-faq').click(function() {
            var html = '<div class="faq-item border p-2 mb-2 bg-light">' +
                       '<input type="text" name="faqs_q[]" class="form-control form-control-sm shadow-none mb-1" placeholder="Question">' +
                       '<textarea name="faqs_a[]" class="form-control form-control-sm shadow-none mb-1" rows="2" placeholder="Answer"></textarea>' +
                       '<button type="button" class="btn btn-sm btn-danger remove-faq">Remove FAQ</button>' +
                       '</div>';
            $('#faq-container').append(html);
        });

        $(document).on('click', '.remove-faq', function() {
            $(this).closest('.faq-item').remove();
        });
    });
</script>
@endpush
