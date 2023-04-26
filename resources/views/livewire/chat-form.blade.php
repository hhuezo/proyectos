<div>
    
    <div class="form-group">
        <label for="usuario">Nombre</label>
        <input type="text" class="form-control" id="usuario" wire:model="usuario" >
        @error("usuario") <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="mensaje">Mensaje</label>
        <input type="text" class="form-control" id="mensaje" wire:model="mensaje" >
        @error("mensaje") <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary" wire:click="enviarMensaje">Enviar Mensaje</button>

    <!-- Mensajes de Alerta -->
    <div style="position: absolute;" class="alert alert-success collapse" role="alert" id="avisoSuccess">
        Se ha enviado
    </div>

    <script>

        window.livewire.on('mensajeEnviado', function(){

            $("#avisoSuccess").fadeIn("slow");

            setTimeout(() => {
                $("#avisoSuccess").fadeOut("slow");
            }, 3000);        

        });

    </script>

</div>
