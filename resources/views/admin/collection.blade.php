@extends('layouts.admin')

@section('content')

    <admin-collection-component route="{{ route('admin.addCollection') }}"></admin-collection-component>

@endsection
