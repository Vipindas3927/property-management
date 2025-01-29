@extends('layout.app')

@section('title', 'Add Property')

@section('content')
@if ($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Add New Property</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Type</label>
                        <select class="form-select" id="type" name="type" >
                            <option value="rent">Rent</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">Price</label>
                        <input type="number" class="form-control" id="price" name="price" >
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label fw-bold">Location</label>
                        <input type="text" class="form-control" id="location" name="location" >
                    </div>
                    <div class="mb-3">
                        <label for="region_id" class="form-label fw-bold">Region</label>
                        <select class="form-select" id="region_id" name="region_id" >
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select class="form-select" id="status" name="status" >
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                            <option value="rented">Rented</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="featured_image" class="form-label fw-bold">Featured Image</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Add Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
