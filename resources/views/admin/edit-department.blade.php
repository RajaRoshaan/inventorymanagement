@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking update -->
    <div class="container">

        <form method="post" action="{{ route('department.update') }}">
            @csrf
            @method('PUT')
            <h3>Update Department</h3>
            <input type="hidden" name="id" value="{{ $department->id }}">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ $department->name }}" placeholder="Enter department name">
              @error('name')
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
