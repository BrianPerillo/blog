<div>

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" wire:model="nombre">
        <small>{{$nombre}}</small>
    </div>

    <div class="form-group">
        <label for="nombre">Mensaje</label>
        <input type="text" class="form-control" id="mensaje" wire:model="mensaje">
        <small>{{$mensaje}}</small>
    </div>

    <button class="btn btn-primary" wire:click="enviarMensaje">Enviar Mensaje</button>

    <!-- Mensaje de alerta - Por defeto no es visible, se mostrará al recibir el evento mensajeEnviado -->
    <div style="position:absolute;" class="alert alert-success collapse" role="alert" id="avisoSuccess">
        Se ha enviado el mensaje
    </div>



    <script>
        //Como el componente emite un evento aal enviar un mensaje, lo recibimos con JS:
        window.livewire.on('mensajeEnviado', function(){ //Esto significa cuando esta ventana reciba el evento 'mensajeEnviado':

            //Mostramos el aviso con animación fadein
            $("#avisoSuccess").fadeIn("slow");

            //Ocultamos el aviso a los 3 segundos
            setTimeout(function(){$("#avisoSuccess").fadeOut("slow");}, 3000);
        });
    </script>
    
</div>
