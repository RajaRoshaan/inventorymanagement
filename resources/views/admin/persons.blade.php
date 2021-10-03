@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking navigation links -->
    <div class="container">

        <form method="post" action="{{ route('persons') }}">
            @csrf
            <h3>Add Persons</h3>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}" placeholder="Enter persons name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name = "email" class="form-control @error('email') border-danger @enderror" value="{{ old('email') }}" placeholder="Enter persons email">
                @error('email')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="text" name = "cnic" class="form-control @error('cnic') border-danger @enderror" value="{{ old('cnic') }}" placeholder="Enter cnic">
                @error('cnic')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>

            <div class="form-group">
                <label for="department">Department</label>

                <select name="department_id" class="form-select form-control @error('department_id') border-danger @enderror" value="{{ old('department_id') }}" @if (!$departments->count()) disabled @endif >
                    @if ($departments->count())
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        
                    @else
                        <option value="null" >No Departments</option>
                    @endif
                </select>
                @error('department_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>
           

            
            <button type="submit" class="btn btn-primary">Add persons</button>

            @if(session('person_insert_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('person_insert_status') }}</label>
                </div>
            @endif
        </form>

        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Person</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('person.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search person" name="text">
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
