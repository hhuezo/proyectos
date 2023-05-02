@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')


    <livewire:usuarios-coordinador />



    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>

    <script src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables.bootstrap4.min.js') }}"></script>



    @livewireScripts

@endsection
