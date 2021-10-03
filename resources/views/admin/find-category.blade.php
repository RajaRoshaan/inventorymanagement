@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking search -->
    <div class="container">

        
        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Categories</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('category.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search category" name="text">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                      </form>
                </div>
            </div>
            @if(session('category_delete_status'))
                <div class="form-group">
                    <label for="" class="text-danger">{{ session('category_delete_status') }}</label>
                </div>
            @endif
            @if(session('category_edit_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('category_edit_status') }}</label>
                </div>
            @endif
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                <tbody>

                @if ($categories->count())
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form method="post" action="{{ route('category.show', $category->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </form>
                                <form method="post" action="{{ route('category.delete', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    No Catgeories
                @endif
                  
                </tbody>
            </table>

        </div>
    </div>
   
    
@endsection
