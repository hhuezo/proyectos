@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<livewire:proyecto-show />




<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/page/task.js') }}"></script>

@livewireScripts

@endsection