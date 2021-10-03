@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking update -->
    <div class="container">

        <form method="post" action="{{ route('inventory.update') }}">
            @csrf
            @method('PUT')
            <h3>Update Inventory</h3>
            <input type="hidden" name="id" value="{{ $inventory->id }}">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name = "name" id="name" class="form-control @error('name') border-danger @enderror" value="{{ $inventory->name }}" placeholder="Enter category name">
              @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>

                <select name="category_id" class="form-select form-control @error('category_id') border-danger @enderror" value="{{ $inventory->category_id }}" @if (!$categories->count()) disabled @endif >
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id === $inventory->category_id) selected @endif>{{ $category->name }}</option>
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
                <input type="text" name = "number_of_items" id="number_of_items" class="form-control @error('number_of_items') border-danger @enderror" value="{{ $inventory->number_of_items }}" placeholder="Enter no of items">
                @error('number_of_items')
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
