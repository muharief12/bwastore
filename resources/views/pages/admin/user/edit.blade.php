@extends('layouts.admin')

@section('title', 'User - Admin BWASTORE')
    
@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Update User</h2>
                <p class="dashboard-subtitle">
                    Let's updating user's data Now!
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update', $item->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $item->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>User Password</label>
                                                <input type="password" name="password" class="form-control">
                                                <small class="text-danger">*Please, make empty if you means not change the existing password</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>User Roles</label>
                                                <select name="roles" class="form-control" required>
                                                    {{-- <option value="{{ $item->roles }}" selected>Don't change</option> --}}
                                                    <option value="ADMIN" {{ $item->roles === "ADMIN" ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="USER" {{ $item->roles === "USER" ? 'selected' : '' }}>User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection