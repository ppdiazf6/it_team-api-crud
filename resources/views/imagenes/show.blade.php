@extends('layouts.app', ['activePage' => 'imagenes'])

@section('content')

    <div class="main-content mt-5">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Detalle Imagen</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{ route('imagenes.index') }}" class="btn btn-warning mx-1">Atrás</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $image['previewURL'] }}" 
                                class="img-fluid rounded-start" 
                                alt="Detalle">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                
                                <p class="card-text">
                                    <strong>Tags: </strong><span>{{ $image['tags'] }}</span>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        {{ $image['views'] }} Vistas
                                    </small>
                                    &nbsp; 
                                    <small class="text-muted mx-1">
                                        {{ $image['likes'] }} Me Gusta
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>

@endsection