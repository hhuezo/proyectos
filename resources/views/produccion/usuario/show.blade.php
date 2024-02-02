@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <!-- Body: Body -->
    <div class="card mb-3">
        <div class="body d-flex py-3">
            <div class="container-xxl">


                <div class="row align-item-center">
                    <div class="col-md-12">

                        <div class="border-0 mb-4">
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h4 class="fw-bold mb-0">Modificar Perfil</h4>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="{{ url('/home') }}">
                                        {{-- data-bs-toggle="modal" data-bs-target="#tickadd" --}}
                                        <button type="button" class="btn btn-dark btn-set-task w-sm-100"><i
                                                class="icofont-arrow-left me-2 fs-6"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div> <!-- Row end  -->



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form id="basic-form" method="POST" action="{{ url('usuario/perfil') }}"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="p-6 space-y-4">
                                    <div class="input-area">
                                        <label for="name" class="form-label">Nombre</label>

                                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                                            required class="form-control">

                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" required name="user_name"
                                                id="user_name" value="{{ $user->user_name }}" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Correo</label>
                                            <input type="text" class="form-control" required name="email"
                                                id="email" value="{{ $user->email }}" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">
                                            <label for="name" class="form-label">Clave</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="input-area">

                                            <label for="largeInput" class="form-label">Imagen Perfil</label>
                                            <input type="file" name="fileInput"
                                                value="{{ old('fileInput') }}" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="p-6 space-y-4">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="form-label col-md-3" align="right"></label>
                                                <div class="col-12" align="right">
                                                    <button type="submit"
                                                        class="btn btn-primary float-right">Aceptar</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                            </form>




                            &nbsp;&nbsp;



                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    <script type="text/javascript">
        // Configura Dropzone para el campo de entrada 'avatar'
        const avatarDropzone = new Dropzone('#avatar', {
            url: "{{ route('dropzone.store') }}", // Ruta de carga de avatar en Laravel
            paramName: 'avatar', // Nombre del campo que Laravel espera
            maxFilesize: 2, // Tamaño máximo de archivo en MB
            acceptedFiles: 'image/*', // Permitir cualquier tipo de archivo
            addRemoveLinks: true, // Mostrar el botón para quitar el archivo
            dictRemoveFile: "<br><button class='btn btn-danger'>Remover</button>", // Texto del botón para quitar el archivo
            dictDefaultMessage: "Arrastra aquí o haz clic para subir tu logo", // Cambia el título por defecto
            maxFile: 1,
        });

        document.getElementById('avatar').addEventListener('click', function() {
            // Simula un clic en el input para abrir el selector de archivos
            // document.getElementById('fileInput').click();
            //   console.log(document.getElementById('avatar'));
        });


        document.getElementById('fileInput').addEventListener('change', function() {
            // Puedes realizar acciones adicionales aquí, como mostrar información sobre los archivos seleccionados
            console.log('Archivos seleccionados:', this.files);
        });

        avatarDropzone.on('addedfile', function(file) {
            // Muestra información sobre el archivo en la consola
            console.log('Archivo agregado:', file);

            // Crea un objeto DataTransfer y agrega el archivo
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Asigna el objeto DataTransfer al input oculto
            var fileInput = document.getElementById('fileInput');
            fileInput.files = dataTransfer.files;

        });

        avatarDropzone.on('removedfile', function(file) {
            // Muestra información sobre el archivo en la consola
            console.log('Archivo eliminado:', file);
            document.getElementById('fileInput').value = null;


        });



        document.getElementById('avatar').addEventListener('dragover', function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado de arrastrar y soltar
            this.style.backgroundColor = '#f0f0f0'; // Cambia el fondo para indicar que se puede soltar
        });

        document.getElementById('avatar').addEventListener('dragleave', function() {
            this.style.backgroundColor = ''; // Restaura el fondo al salir del área de soltar
        });


        document.getElementById('avatar').addEventListener('drop', function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado de arrastrar y soltar
            this.style.backgroundColor = ''; // Restaura el fondo

            var files = e.dataTransfer.files; // Obtiene los archivos arrastrados
            if (files.length > 0) {
                // Asigna los archivos seleccionados al input oculto
                document.getElementById('fileInput').files = files;
            }
        });
    </script>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
