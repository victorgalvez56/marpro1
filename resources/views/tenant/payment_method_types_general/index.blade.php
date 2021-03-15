@extends('tenant.layouts.app')

@section('content')

    <tenant-payment-method-types-general-index :type="{{ json_encode($type) }}" ></tenant-payment-method-types-general-index>

@endsection
