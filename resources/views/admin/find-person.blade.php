@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking search -->
    <div class="container">

        
        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Persons</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('person.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search Persons" name="text">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                      </form>
                </div>
            </div>
            @if(session('person_delete_status'))
                <div class="form-group">
                    <label for="" class="text-danger">{{ session('person_delete_status') }}</label>
                </div>
            @endif
            @if(session('person_edit_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('person_edit_status') }}</label>
                </div>
            @endif
            @if ($persons->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">CNIC</th>
                            <th scope="col">Department</th>
                        </tr>
                        </thead>
                        <tbody>

                
                    @foreach ($persons as $person)
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->email }}</td>
                            <td>{{ $person->cnic }}</td>
                            <td>{{ $person->department->name }}</td>
                            <td>
                                <form method="post" action="{{ route('person.show', $person->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </form>
                                <form method="post" action="{{ route('person.delete', $person->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                             
                </tbody>
            </table>
            @else
                    No Persons
            @endif

        </div>
    </div>
   
    
@endsection
