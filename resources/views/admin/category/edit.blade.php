@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                <h3 class="card-title">Edit Category</h3>
                <form action="{{ url('admin/update-category/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" value="{{ $category->name }}"class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="summernote" rows="5" class="form-control">{{ $category->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Cover/Banner</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" {{ $category->status == '1' ? 'checked' : '' }} name="status" />
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="btn btn-success">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection