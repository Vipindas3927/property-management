<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{
    Region, Property
};

class PropertyList extends Component
{
    public $title, $type, $location, $region, $minPrice, $maxPrice;
    public $properties;

    public function mount()
    {
        $this->properties = collect(); 
    }

    public function search()
    {
        $query = Property::query();

        if ($this->title) {
            $query->where('title', 'like', '%' . $this->title . '%');
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->location) {
            $query->where('location', 'like', '%' . $this->location . '%');
        }

        if ($this->region) {
            $query->where('region_id', $this->region);
        }

        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        $this->properties = $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.property-list', [
            'properties' => $this->properties,
        ]);
    }
}
