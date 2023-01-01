@extends('layouts.master')

@section('title', 'Settings')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
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
                    <h3>Settings</h3>
                    <!-- <a class="btn bg-gradient-primary mt-3 w-100" href="{{ url('admin/add-category') }}">Add Category</a> -->
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form action="{{ url('admin/settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Website Name</label>
                            <input type="text" name="website_name" @if($settings) value="{{ $settings->website_name }}" @endif class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label>Website Logo</label>
                            <input type="file" name="website_logo" class="form-control">
                            @if($settings)
                                <img class="m-3 rounded" src="{{ asset('uploads/settings/' . $settings->logo) }}" width="70px" height="70px" alt="">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Website Favicon</label>
                            <input type="file" name="website_favicon" class="form-control">
                            @if($settings)
                                <img class="m-3 rounded" src="{{ asset('uploads/settings/' . $settings->favicon) }}" width="70px" height="70px" alt="">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" id="summernote" rows="5" class="form-control">@if($settings) {{ $settings->description }} @endif</textarea>
                        </div>
                        <div class="mb-6">
                            <button type="submit" class="btn btn-success">Save Settings</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection