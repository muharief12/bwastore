@extends('layouts.dashboard')

@section('title', 'Dashboard - Product Detail Page')
    
@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Shirup Marzan</h2>
            <p class="dashboard-subtitle">
                Product Details
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('dashboard-products-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            aria-describedby="name"
                                            name="name"
                                            value="{{ $product->name }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="price">Price</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="price"
                                            aria-describedby="price"
                                            name="price"
                                            value="{{ $product->price }}"
                                        />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categories_id">Category</label>
                                        <select name="categories_id" class="form-control">
                                            <option value="{{ $product->categories_id }}">No Change - {{ $product->category->name }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea
                                                name="description"
                                                id="editor"
                                                cols="30"
                                                rows="4"
                                                class="form-control"
                                            >
                                                {!! $product->description !!}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button
                                        type="submit"
                                        class="btn btn-success btn-block px-5"
                                        >
                                        Update Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        @forelse ($product->galleries as $gallery)
                            <div class="col-md-4">
                                <div class="gallery-container">
                                    <img
                                    {{-- src="/images/product-card-1.png" --}}
                                    src="{{ Storage::url($gallery->photos ?? '') }}"
                                    alt=""
                                    class="w-100"
                                    />
                                    <a class="delete-gallery" href="{{ route('dashboard-products-gallery-delete', $gallery->id) }}">
                                        <img src="/images/icon-delete.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p style="color: #ff7158" class="cart-empty text-center">The Product of <b>{{ $product->name }}</b> haven't photo galleries</p>
                            </div>
                        @endforelse
                        {{-- <div class="col-md-4">
                            <div class="gallery-container">
                                <img
                                src="/images/product-card-2.png"
                                alt=""
                                class="w-100"
                                />
                                <a class="delete-gallery" href="#">
                                <img src="/images/icon-delete.svg" alt="" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="gallery-container">
                                <img
                                src="/images/product-card-3.png"
                                alt=""
                                class="w-100"
                                />
                                <a class="delete-gallery" href="#">
                                <img src="/images/icon-delete.svg" alt="" />
                                </a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col mt-3">
                            <form action="{{ route('dashboard-products-gallery-upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="products_id" value="{{ $product->id}}">
                                <input
                                    type="file"
                                    name="photos"
                                    id="file"
                                    style="display: none;"
                                    onchange="form.submit()"
                                />
                                <button
                                type="button"
                                    class="btn btn-secondary btn-block"
                                    onclick="thisFileUpload();"
                                >
                                    Add Photo
                                </button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        function thisFileUpload() {
        document.getElementById("file").click();
        }
    </script>
    <script>
        CKEDITOR.replace("editor");
    </script>
@endpush