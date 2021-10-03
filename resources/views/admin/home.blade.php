@extends('admin.admin_template')

@section('admin_content')
    <!-- Content displayed by clicking navigation links -->
    <h3>Logged in as {{ Auth()->user()->name }}</h3>
    
@endsection
