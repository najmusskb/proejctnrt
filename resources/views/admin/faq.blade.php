@extends('layouts.master')
@section('title', 'FAQ Page')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > FAQ</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if (@isset($faqData))
                                <i class="fas fa-edit"></i> FAQ Update
                            @else
                                <i class="fab fa-bandcamp"></i> FAQ Entry
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$faqData) ? route('faq.update', $faqData->id) : route('faq.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="question" class="col-sm-3 col-form-label">Question</label>
                                <div class="col-sm-9">
                                    <input type="text" name="question" value="{{ @$faqData->question }}" class="form-control form-control-sm shadow-none" id="question" required>
                                    @error('question') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="answer" class="col-sm-3 col-form-label">Answer</label>
                                <div class="col-sm-9">
                                    <textarea name="answer" class="form-control form-control-sm shadow-none" id="editor" rows="4" required>{{ @$faqData->answer }}</textarea>
                                    @error('answer') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="order" class="col-sm-3 col-form-label">Order</label>
                                <div class="col-sm-9">
                                    <input type="number" name="order" value="{{ @$faqData->order ?? 0 }}" class="form-control form-control-sm shadow-none" id="order">
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$faqData) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>

            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> FAQ List</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Question</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faq as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($item->question, 50) }}</td>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('faq.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
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
    CKEDITOR.replace( 'editor' );
</script>
@endpush
