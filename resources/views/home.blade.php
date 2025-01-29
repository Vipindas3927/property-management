@extends('layout.app')

@section('title', 'Properties')

@section('content')
<div class="p-2" style="padding:2px;">
    <div class="form-group">
        <a class="btn-success btn p-" href="{{route('addView')}}" >Add</a>
    </div>
<br><br>
    <div class="container">
    <form method="get" action="{{ route('index') }}">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ request('title') }}">
            </div>
            <div class="col">
                <select class="form-control" name="type">
                    <option value="">Type</option>
                    <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                    <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>Sale</option>
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Location" name="location" value="{{ request('location') }}">
            </div>
            <div class="col">
                <select class="form-select" id="region_id" name="region">
                    <option value="">All</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Min Price" name="minPrice" value="{{ request('minPrice') }}">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Max Price" name="maxPrice" value="{{ request('maxPrice') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>


        <div class="responsible-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Region</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $property)
                        <tr>
                            <td>
                            <a href="{{ route('edit', $property->id) }}">{{ $property->title }}</a>
                            </td>
                            <td>{{ $property->region->name??'na' }}</td>
                            <td><img src="{{ asset('storage/' . $property->featured_image) }}" alt="Property Image" width="50"></td>
                            <td>{{ Str::limit($property->description, 50) }}</td>
                            <td>{{ $property->location }}</td>
                            <td>{{ ucfirst($property->type) }}</td>
                            <td>{{ number_format($property->price, 2) }}</td>
                            <td><a class="btn-danger btn" href="{{ route('delete', $property->id) }}">Delete</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $data->links() }} 
        </div>

    </div>
</div>
@endsection
