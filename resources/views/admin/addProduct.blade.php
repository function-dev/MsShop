@extends('layouts.admin')

@section('content')

    <admin-add-product-component token="{{csrf_token()}}" productimage='@if(empty($path)){{1}}@else{{$path}}@endif'></admin-add-product-component>
@endsection
