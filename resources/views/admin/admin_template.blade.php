@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2" style="border-right: 2px solid black">
            <!-- Admin navigation links -->
            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-block">Categories</a>
            <a href="{{ route('inventory') }}" class="btn btn-outline-primary btn-block">Inventory</a>
            <a href="{{ route('attributes') }}" class="btn btn-outline-primary btn-block">Attributes</a>
            <a href="{{ route('departments') }}" class="btn btn-outline-primary btn-block">Departments</a>
            <a href="{{ route('offices') }}" class="btn btn-outline-primary btn-block">Offices</a>
            <a href="{{ route('persons') }}" class="btn btn-outline-primary btn-block">Persons</a>
            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-block">Allocations</a>
            <a href="{{ route('categories') }}" class="btn btn-outline-primary btn-block">Damaged Items</a>
        </div>

        <div class="col-10">
            <!-- Content displayed by clicking navigation links -->
            @yield('admin_content')
        </div>
    </div>
</div>
@endsection
