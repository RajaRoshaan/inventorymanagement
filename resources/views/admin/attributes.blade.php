@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking navigation links -->
    <div class="container">

        <form method="post" action="{{ route('attributes') }}">
            @csrf
            <h3>Add Attributes</h3>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}" placeholder="Enter attribute name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="category">Inventory</label>

                <select name="inventory_id" class="form-select form-control @error('inventory_id') border-danger @enderror" value="{{ old('category_id') }}" @if (!$inventory->count()) disabled @endif >
                    @if ($inventory->count())
                        @foreach ($inventory as $singleInventory)
                            <option value="{{ $singleInventory->id }}">{{ $singleInventory->name }}</option>
                        @endforeach
                        
                    @else
                        <option value="null" >No Inventory</option>
                    @endif
                </select>
                @error('inventory_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>
           

            <div class="form-group">
                <label for="name">Value</label>
                <input type="text" name = "value" id="number_of_items" class="form-control @error('value') border-danger @enderror" value="{{ old('value') }}" placeholder="Enter value">
                @error('value')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            <button type="submit" class="btn btn-primary">Add attribute</button>

            @if(session('attribute_insert_status'))
                <div class="form-group">
                    <label for="" class="text-success">{{ session('attribute_insert_status') }}</label>
                </div>
            @endif
        </form>

        <div class="container mt-4">

            <div class="row">
                <div class="col-8">
                    <h3>Attributes</h3>
                </div>
                <div class="col-4">
                    <form class="form-inline" method="POST" action="{{ route('attribute.find') }}">
                        @csrf
                        <div class="form-group mb-2">
                          <input type="text" placeholder="Search attributes" name="text">
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

