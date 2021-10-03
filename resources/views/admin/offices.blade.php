@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking navigation links -->
    <div class="container">

        <form method="post" action="{{ route('offices') }}">
            @csrf
            <h3>Add Office</h3>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}" placeholder="Enter Office name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Office</button>

            @if(session('office_insert_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('office_insert_status') }}</label>
                </div>
            @endif
        </form>

        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Offices</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('office.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search office" name="text">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                      </form>
                </div>
            </div>
            @if(session('office_delete_status'))
                <div class="form-group">
                    <label for="" class="text-danger">{{ session('office_delete_status') }}</label>
                </div>
            @endif
            @if(session('office_edit_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('office_edit_status') }}</label>
                </div>
            @endif
            @if ($offices->count())        
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                        </tr>
                        </thead>
                        <tbody>

                
                    @foreach ($offices as $office)
                        <tr>
                            <td>{{ $office->name }}</td>
                            <td>
                                <form method="post" action="{{ route('office.show', $office->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </form>
                                <form method="post" action="{{ route('office.delete', $office->id) }}">
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
                No Offices
            @endif
        </div>
    </div>
   
    
@endsection
