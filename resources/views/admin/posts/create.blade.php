@extends('layouts.master')

@section('title', 'Add Post')

@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                <h3 class="card-title">Add Post</h3>
                <form action="{{ url('admin/add-post') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" id="">
                            @foreach ($category as $catitem)
                            <option value="{{ $catitem->id }}">{{ $catitem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Post Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="summernote" rows="5" class="form-control"></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label>File Upload</label>
                        <input type="file" name="file_id" class="form-control">
                    </div> -->
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" />
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="btn btn-success">Save Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection