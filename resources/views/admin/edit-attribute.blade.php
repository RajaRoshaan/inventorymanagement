@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking update -->
    <div class="container">

        <form method="post" action="{{ route('attribute.update') }}">
            @csrf
            @method('PUT')
            <h3>Update Attribute</h3>
            <input type="hidden" name="id" value="{{ $attribute->id }}">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ $attribute->name }}" placeholder="Enter attribute name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="inventory">Inventory</label>

                <select name="inventory_id" class="form-select form-control @error('inventory_id') border-danger @enderror" value="{{ $attribute->inventory_id }}" @if (!$attribute->count()) disabled @endif >
                    @if ($inventory->count())
                        @foreach ($inventory as $singleInventory)
                            <option value="{{ $singleInventory->id }}" @if($singleInventory->id === $attribute->inventory_id) selected @endif>{{ $singleInventory->name }}</option>
                        @endforeach
                        
                    @else
                        <option value="null" >No inventory</option>
                    @endif
                </select>
                @error('inventory_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>
           

            <div class="form-group">
                <label for="value">Value</label>
                <input type="text" name = "value" class="form-control @error('value') border-danger @enderror" value="{{ $attribute->value }}" placeholder="Enter value">
                @error('value')
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
