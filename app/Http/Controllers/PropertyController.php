<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Region, Property
};

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        try{
            $query = Property::with('region');

            if ($request->title) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }

            if ($request->type) {
                $query->where('type', $request->type);
            }

            if ($request->location) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            if ($request->region) {
                $query->where('region_id', $request->region);
            }

            if ($request->minPrice) {
                $query->where('price', '>=', $request->minPrice);
            }

            if ($request->maxPrice) {
                $query->where('price', '<=', $request->maxPrice);
            }

            $data = $query->orderBy('price', 'ASC')->orderBy('created_at', 'ASC')->paginate(2);
        
            $regions = Region::all();
            return view('home', compact('data', 'regions'));
        }catch(\Throwable $th){
            dd($th);
        }
    }
    public function addview(Request $request)
    {
        $regions = Region::all();
        return view('add', compact('regions'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'type' => 'required|in:rent,sale',
                'price' => 'required|numeric',
                'location' => 'required|string|max:255',
                'region_id' => 'required|exists:regions,id',
                'status' => 'required|in:available,pending,sold,rented',
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', 
            ]);


            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('properties', 'public'); 
                $validated['featured_image'] = $imagePath;
            }

            Property::create($validated);

            return redirect()->route('index')->with('success', 'Property created successfully.');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'An error occurred: ' . $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        $regions = property::find($id)->delete();
        return redirect()->route('index')->with('success', 'Deleted Succesfully');
    }

    public function editView($id)
    {
        $property = Property::findOrFail($id);
        $regions = Region::all();

        return view('edit', compact('property', 'regions'));
    }
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'region' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $property->title = $request->title;
        $property->region_id = $request->region;
        $property->description = $request->description;
        $property->location = $request->location;
        $property->type = $request->type;
        $property->price = $request->price;
    
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('properties', 'public');
            $property->featured_image = $imagePath;
        }
    
        $property->save();
    
        return redirect()->route('index')->with('success', 'Property updated successfully.');
    }
    

}
