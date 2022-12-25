@extends('layouts.master')
@section('title', 'Edit User')

@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                <h3 class="card-title">Edit User</h3>
                    
                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Created At</label>
                        <input type="text" name="image" class="form-control" value="{{ $user->created_at }}"disabled readonly>
                    </div>

                    <form action="{{ url('admin/update-user/' . $user->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                        <div class="mb-3">
                            <label>Role As</label>
                            <select name="role_as" class="form-control">
                                <option value="1" {{ $user->role_as == '1' ? 'selected' : '' }} >Admin</option>
                                <option value="0" {{ $user->role_as == '0' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    <div class="mb-6">
                        <button type="submit" class="btn btn-success">Update User Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection