@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Property</h2>
    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $property->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Region</label>
            <select class="form-control" name="region">
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ $property->region_id == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description">{{ $property->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{ $property->location }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-control" name="type">
                <option value="rent" {{ $property->type == 'rent' ? 'selected' : '' }}>Rent</option>
                <option value="sale" {{ $property->type == 'sale' ? 'selected' : '' }}>Sale</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="{{ $property->price }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" class="form-control" name="featured_image">
            @if($property->featured_image)
                <img src="{{ asset('storage/' . $property->featured_image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Property</button>
    </form>
</div>
@endsection
