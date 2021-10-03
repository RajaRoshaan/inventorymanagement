<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use App\Models\Inventory;
use App\Rules\OfficeOrPerson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\PersonOrOffice;

class AllocataionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $allocation = Allocation::with('office', 'person', 'inventory')->get();
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
            'office_id' => ['Required_without:person_id', new OfficeOrPerson($request->get('office_id'), $request->get('person_id'))],
            'person_id' => ['Required_without:office_id', new PersonOrOffice($request->get('person_id'), $request->get('office_id'))],
            'inventory_id' => 'required|numeric'

        ]);

        $inventoryCheck = Inventory::find($request->get('inventory_id'));

        if($inventoryCheck->number_of_items > 0){

            $allocation = Allocation::create([
                'office_id' => $request->get('office_id'),
                'person_id' => $request->get('person_id'),
                'inventory_id' => $request->get('inventory_id'),
                'allocation_date' => Carbon::now(),
            ]);
    
            $allocation->inventory->decrement('number_of_items');
            return $allocation;
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
            'office_id' => ['Required_without:person_id', new OfficeOrPerson($request->get('office_id'), $request->get('person_id'))],
            'person_id' => ['Required_without:office_id', new PersonOrOffice($request->get('person_id'), $request->get('office_id'))],
            'inventory_id' => 'required|numeric'
        ]);

        
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
        $allocation = Allocation::find($id);
        $allocation->deallocated = 1;
        $allocation->inventory->increment('number_of_items');
        $allocation->update();
        return Allocation::destroy($id);
    }
}
