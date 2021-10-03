@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking search -->
    <div class="container">

        
        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Attributes</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('attribute.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search inventory" name="text">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                      </form>
                </div>
            </div>
            @if(session('attribute_delete_status'))
                <div class="form-group">
                    <label for="" class="text-danger">{{ session('attribute_delete_status') }}</label>
                </div>
            @endif
            @if(session('attribute_edit_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('attribute_edit_status') }}</label>
                </div>
            @endif
            @if ($attributes->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Inventory</th>
                            <th scope="col">Value</th>
                        </tr>
                        </thead>
                        <tbody>

                
                    @foreach ($attributes as $attribute)
                        <tr>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->inventory->name }}</td>
                            <td>{{ $attribute->value }}</td>
                            
                            <td>
                                <form method="post" action="{{ route('attribute.show', $attribute->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </form>
                                <form method="post" action="{{ route('attribute.delete', $attribute->id) }}">
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
                    No Attributes
            @endif

        </div>
    </div>
   
    
@endsection
