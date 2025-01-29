<div class="container">
    <form wire:submit.prevent="search">
        <div class="row mb-3">
            <div class="col">
                <input type="text" class="form-control" placeholder="Title" wire:model="title">
            </div>
            <div class="col">
                <select class="form-control" wire:model="type">
                    <option value="">Type</option>
                    <option value="rent">Rent</option>
                    <option value="sale">Sale</option>
                </select>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Location" wire:model="location">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Region" wire:model="region">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Min Price" wire:model="minPrice">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Max Price" wire:model="maxPrice">
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
                    <th>Image</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td><img src="{{ $property->image_url }}" alt="Property Image" width="50"></td>
                        <td>{{ Str::limit($property->description, 50) }}</td>
                        <td>{{ $property->location }}</td>
                        <td>{{ ucfirst($property->type) }}</td>
                        <td>{{ number_format($property->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $properties->links() }} 
    </div>

</div>
