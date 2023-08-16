@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<style>
.colored-toast.swal2-icon-success {
    background-color: #85cc5c !important;
}

.colored-toast.swal2-icon-error {
    background-color: #e22f2f !important;
}

.swal2-title {
    color: #FFFFFF;
}
</style>


<style>
    .dd-handle:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    .contenedor {
        style="width: 90px;
    height: 240px;
    position: absolute;
    right: 0px;
    bottom: 0px;"
    }

    .botonF1 {
        width: 60px;
        height: 60px;
        border-radius: 100%;
        background: #484c7f;
        right: 0;
        bottom: 0;
        position: absolute;
        margin-right: 16px;
        margin-bottom: 16px;
        border: none;
        outline: none;
        color: #FFF;
        font-size: 36px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: .3s;
    }
</style>

<livewire:proyectos />




<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/nestable.bundle.js') }}"></script>
<script src="{{ asset('js/page/task.js') }}"></script>

@livewireScripts

@endsection