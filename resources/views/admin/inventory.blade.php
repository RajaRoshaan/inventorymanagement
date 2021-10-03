@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking navigation links -->
    <div class="container">

        <form method="post" action="{{ route('inventory') }}">
            @csrf
            <h3>Add Inventory</h3>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}" placeholder="Enter inventory name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>

                <select name="category_id" class="form-select form-control @error('category_id') border-danger @enderror" value="{{ old('category_id') }}" @if (!$categories->count()) disabled @endif >
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        
                    @else
                        <option value="null" >No categories</option>
                    @endif
                </select>
                @error('category_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>
           

            <div class="form-group">
                <label for="name">No of items</label>
                <input type="text" name = "number_of_items" id="number_of_items" class="form-control @error('number_of_items') border-danger @enderror" value="{{ old('number_of_items') }}" placeholder="Enter no of items">
                @error('number_of_items')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            <button type="submit" class="btn btn-primary">Add inventory</button>

            @if(session('inventory_insert_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('inventory_insert_status') }}</label>
                </div>
            @endif
        </form>

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
