<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventory = Inventory::with('category')->get();
        $categories = Category::get();
        return view('admin.inventory', ['inventory' => $inventory, 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|numeric',
            'number_of_items' => 'required|numeric'

        ]);

        Inventory::create($request->all());
        return redirect('inventory')->with('inventory_insert_status' , 'inventory inserted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $inventory = Inventory::with('category')->find($id);
        $categories = Category::get();
        return view('admin.edit-inventory', ['inventory' => $inventory, 'categories' => $categories]);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $inventory = Inventory::find($request->get('id'));
        $inventory->update($request->all());
        return redirect('inventory')->with('inventory_edit_status' , 'Inventory edited');
    }

    /**
     * Search the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        $text = $request->get('text');
        $inventory = Inventory::with('category')->where('name', 'like', '%'.$text.'%')->get();
        return view('admin.find-inventory', ['inventory' => $inventory]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Inventory::find($id)->delete();
        return redirect('inventory')->with('inventory_delete_status' , 'Inventory deleted');
    }
}
