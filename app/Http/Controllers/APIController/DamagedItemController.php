<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\DamagedItem;
use App\Models\Inventory;
use Illuminate\Http\Request;

class DamagedItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DamagedItem::with('inventory', 'allocation')->where('repaired', '<>', 1)->orWhereNull('repaired')->get();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function damaged_including_repaired()
    {
        //
        return DamagedItem::with('inventory', 'allocation')->get();

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
            'inventory_id' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
            'allocation_id' => 'numeric'
        ]);

        $inventoryCheck = Inventory::find($request->get('inventory_id'));

        if($inventoryCheck->number_of_items > 0){

            $damaged = DamagedItem::create([
                'inventory_id' => $request->get('inventory_id'),
                'description' => $request->get('description'),
                'status' => $request->get('status'),
                'allocation_id' => $request->get('allocation_id'),
            ]);
    
            $damaged->inventory->decrement('number_of_items');
            return $damaged;
        }else{
            return response([
                'message' => 'Item out of stock'
            ], 201);
        }
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
        return DamagedItem::with('inventory', 'allocation')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'inventory_id' => 'required|numeric',
            'description' => 'required',
            'status' => 'required',
            'allocation_id' => 'numeric'
        ]);

        $damaged = DamagedItem::find($id);
        $damaged->inventory_id = $request->get('inventory_id');
        $damaged->description = $request->get('description');
        $damaged->status = $request->get('status');
        $damaged->allocation_id = $request->get('allocation_id');
        $damaged->update();
        return $damaged;
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
        $damaged = DamagedItem::find($id);
        $damaged->repaired = 1;
        $damaged->inventory->increment('number_of_items');
        return $damaged->update();
    }
}
