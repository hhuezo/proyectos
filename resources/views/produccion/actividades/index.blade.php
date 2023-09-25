@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')




    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>


    <livewire:actividades />




    @livewireScripts


@endsection
