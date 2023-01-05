@extends('layouts.master')

@section('title', 'Users')

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
                    <h3>Users</h3>
                    <!-- <a class="btn bg-gradient-primary mt-3 w-100" href="{{ url('admin/add-category') }}">Add Category</a> -->
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="m-4 table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated At</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <h6 class="mb-0 text-sm">{{ $item->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm {{ $item->role_as == 1 ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">{{ $item->role_as == 1 ? 'Admin' : 'User' }}</span>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-xs font-weight-bold mb-0">{{ $item->created_at }}</p>
                                    </td>
                                    <td>
                                        <p class="align-middle text-center text-xs font-weight-bold mb-0">{{ $item->updated_at }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ url('admin/users/' . $item->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
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

@endsection