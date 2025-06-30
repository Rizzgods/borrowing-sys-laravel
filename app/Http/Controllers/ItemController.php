<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\items;

class ItemController extends Controller
{
    public function index(){
        $items = items::all();
        return view('items.index', ['items' => $items]);    
    }
    public function create(){
        return view('items.create');
    }
    public function edit(items $item){
        return view('items.edit', ['item' => $item]);
    }
    public function update(items $item, Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'required|integer',
                'is_available' => 'required|boolean',
            ]);

            $item->update($data);
            return redirect()->route('items.index')->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('items.edit', ['item' => $item->id])
                ->withErrors(['error' => 'Failed to update item: ' . $e->getMessage()]);
        }
    }
    public function delete(items $item){
        $item->delete();


        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
    public function store(Request $request){

        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'required|integer',
                'is_available' => 'required|boolean',
    
            ]);
    
            $newItem  = items::create($data);
            return  redirect()->route('items.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($e->validator->errors()->has('duplicate')) {
                return redirect()->route('items.create')
                    ->withErrors(['error' => 'An item with this name already exists.']);
            }
            return redirect()->route('items.create')
                ->withErrors(['error' => 'Please fill in all required fields.']);
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for duplicate entry error (MySQL error code 1062)
            if ($e->getCode() === '23000') {
                return redirect()->route('items.create')
                    ->withErrors(['error' => 'This item already exists.']);
            }
            return redirect()->route('items.create')
                ->withErrors(['error' => 'Error saving to database. Please try again.']);
    
        } catch (\Exception $e) {
            return redirect()->route('items.create')
                ->withErrors(['error' => 'An unexpected error occurred.']);
        }
    }

}
