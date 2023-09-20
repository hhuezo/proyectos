@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')




    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/task.js') }}"></script>

    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>

    <livewire:actividades />




    @livewireScripts


@endsection
