<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Inventory;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $attributes = Attribute::with('inventory')->get();
        $inventory = Inventory::get();
        return view('admin.attributes', ['attributes' => $attributes, 'inventory' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'inventory_id' => 'required|numeric',
            'value' => 'required'

        ]);

        Attribute::create($request->all());
        return redirect('attributes')->with('attribute_insert_status' , 'attribute inserted');
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
        $attribute = Attribute::with('inventory')->find($id);
        $inventory = Inventory::get();
        return view('admin.edit-attribute', ['inventory' => $inventory, 'attribute' => $attribute]);
    }

    /**
     * Search the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $text = $request->get('text');
        $attributes = Attribute::with('inventory')->where('name', 'like', '%'.$text.'%')->get();
        return view('admin.find-attribute', ['attributes' => $attributes]);
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
        
        $attribute = Attribute::find($request->get('id'));
        $attribute->update($request->all());
        return redirect('attributes')->with('attribute_edit_status' , 'Attribute edited');
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
        Attribute::find($id)->delete();
        return redirect('attributes')->with('attribute_delete_status' , 'Attribute deleted');
    }
}
