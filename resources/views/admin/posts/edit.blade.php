@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @if(session('message'))
                <div class="btn bg-gradient-secondary mt-3 w-100">{{ session('message') }}</div>
                @endif

                @if($errors->any())
                <div class="btn bg-gradient-primary mt-3 w-100">
                    @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif
                
                <h3 class="card-title">Edit Post</h3>
                <form action="{{ url('admin/update-post/' . $posts->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" id="">
                            <option value="">-- Select Category --</option>
                            @foreach ($category as $catitem)
                            <option value="{{ $catitem->id }}" {{ $posts->category_id == $catitem->id ? 'selected' : ''}}>{{ $catitem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Post Title</label>
                        <input type="text" name="title" value="{{ $posts->title }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="summernote" rows="5" class="form-control">{!! $posts->description !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>File Upload</label>
                        <input type="file" name="file_id" value="{{ $posts->file_id }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" {{ $posts->status == '1' ? 'checked' : '' }} name="status" />
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="btn btn-success">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection