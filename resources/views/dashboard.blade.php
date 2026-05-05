@extends('layouts.master')
@section('title') Dashboard @endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') 3dWeldmesh @endslot
    @slot('title') Dashboard @endslot
@endcomponent


@endsection
