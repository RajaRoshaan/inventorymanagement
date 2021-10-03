@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking update -->
    <div class="container">

        <form method="post" action="{{ route('person.update') }}">
            @csrf
            @method('PUT')
            <h3>Update Person</h3>
            <input type="hidden" name="id" value="{{ $person->id }}">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ $person->name }}" placeholder="Enter category name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name = "email" class="form-control @error('email') border-danger @enderror" value="{{ $person->email }}" placeholder="Enter persons email">
                @error('email')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cnic">CNIC</label>
                <input type="text" name = "cnic" class="form-control @error('cnic') border-danger @enderror" value="{{ $person->cnic }}" placeholder="Enter cnic">
                @error('cnic')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>

            <div class="form-group">
                <label for="department">Department</label>

                <select name="department_id" class="form-select form-control @error('department_id') border-danger @enderror" value="{{ $person->department_id }}" @if (!$departments->count()) disabled @endif >
                    @if ($departments->count())
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @if($department->id === $person->department_id) selected @endif>{{ $department->name }}</option>
                        @endforeach
                        
                    @else
                        <option value="null" >No departments</option>
                    @endif
                </select>
                @error('category_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>
           

            <button type="submit" class="btn btn-primary">Update</button>

            @if(session('update_insert_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('update_insert_status') }}</label>
                </div>
            @endif
        </form>

        
    </div>
   
    
@endsection
