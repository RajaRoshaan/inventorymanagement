<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $persons = Person::with('department')->get();
        $departments = Department::get();
        return view('admin.persons', ['persons' => $persons, 'departments' => $departments ]);
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
            'email' => 'required|email',
            'cnic' => 'required|min:13|max:13',
            'department_id' => 'required'
        ]);

        Person::create($request->all());
        return redirect('persons')->with('person_insert_status' , 'Person inserted');
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
        $person = Person::with('department')->find($id);
        $departments = Department::get();
        return view('admin.edit-person', ['person' => $person, 'departments' => $departments]);
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
     * Search the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        $text = $request->get('text');
        $persons = Person::with('department')->where('name', 'like', '%'.$text.'%')->get();
        return view('admin.find-person', ['persons' => $persons]);

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
        $person = Person::find($request->get('id'));
        $person->update($request->all());
        return redirect('persons')->with('person_edit_status' , 'Person edited');
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
        Person::find($id)->delete();
        return redirect('persons')->with('person_delete_status' , 'Person deleted');
    }
}
