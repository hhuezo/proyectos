<div>
    <h5 class="mt-3"><strong>Lista de mensajes</strong></h5>
    @foreach($mensajes as $mensaje)
        <li>{{ $mensaje["usuario"] }} - {{ $mensaje["mensaje"] }}</li> 
    @endforeach


    <script>
        //alert('uno');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        //alert('dos');
        var pusher = new Pusher('edf816551caf0a10582b', {                                 
        cluster: 'us2'
        });
        //alert('tres');
        var channel = pusher.subscribe('chat-channel');
        channel.bind('chat-event', function(data) {
        //alert('cuatro');
        alert(JSON.stringify(data));
        });
        //alert('cinco');
    </script>


</div>
