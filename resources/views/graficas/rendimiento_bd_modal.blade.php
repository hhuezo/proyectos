<style>
    .upper-text {
        text-transform: uppercase;
    }
</style>
@if (isset($resultados))
    @foreach ($resultados as $resultado)
        <ul class="list-unstyled">
            <li class="card mb-2">
                <div class="card-body">
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <img class="avatar rounded-circle" src="{{ url('/') . '/images/logo.svg' }}" alt="">
                        <div class="flex-fill ms-3 text-truncate">
                            <h6 class="mb-0 upper-text"><span>{{ $categoria }}</span>
                            </h6>
                            <span class="text-muted">{{ date('d/m/Y', strtotime($resultado->fecha_ymd)) }}</span>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <h6 class="text-end upper-text"><strong>Tiempo:
                                    {{ $resultado->tiempo }}</strong></h6>
                        </div>

                    </div>
                    <div class="timeline-item-post">
                        <h6 class="upper-text">Tipo de reporte:
                            {{ $resultado->tipo_reporte }}</h6>
                        <p class="upper-text">UNIDAD: {{ $resultado->unidad }}</p>
                        <p class="upper-text">PROGRAMA: {{ $resultado->programa }}</p>
                    </div>

                </div>
            </li> <!-- .Card End -->
        </ul>
    @endforeach
@endif
