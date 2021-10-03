@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking search -->
    <div class="container">

        
        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Inventory</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('inventory.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search inventory" name="text">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                      </form>
                </div>
            </div>
            @if(session('inventory_delete_status'))
                <div class="form-group">
                    <label for="" class="text-danger">{{ session('inventory_delete_status') }}</label>
                </div>
            @endif
            @if(session('inventory_edit_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('inventory_edit_status') }}</label>
                </div>
            @endif
            @if ($inventory->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col"># of items</th>
                        </tr>
                        </thead>
                        <tbody>

                
                    @foreach ($inventory as $singleInventory)
                        <tr>
                            <td>{{ $singleInventory->name }}</td>
                            <td>{{ $singleInventory->category->name }}</td>
                            <td>{{ $singleInventory->number_of_items }}</td>
                            
                            <td>
                                <form method="post" action="{{ route('inventory.show', $singleInventory->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Update</button>
                                </form>
                                <form method="post" action="{{ route('inventory.delete', $singleInventory->id) }}">
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
                    No Inventory
            @endif

        </div>
    </div>
   
    
@endsection
