@extends('layouts.app', ['activePage' => 'imagenes'])

@section('title', 'Konecta | Usuarios')
@section('body-class', 'user-page')


@section('content')
		
	<div class="content">
		<div class="container-fluid">
					
			
					
				
			
				
			<div class="row mt-4">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">IMAGENES</h3>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end">
                                    <form class="d-flex" action="{{ route('imagenes.search') }}" method="POST">
                                        @csrf
                                        <input class="form-control me-2" 
                                                type="search" name="search" 
                                                placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                                    </form>
                                    &nbsp; &nbsp; 
                                    <div class="btn-group">
                                        <button type="button" 
                                                class="btn btn-success dropdown-toggle" 
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Categorías
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'science') }}">Science</a></li>
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'education') }}">Education</a></li>
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'people') }}">People</a></li>
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'feelings') }}">Feelings</a></li>
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'computer') }}">Computer</a></li>
                                            <li><a class="dropdown-item" 
                                                    href="{{ route('imagenes.category', 'buildings') }}">Buildings</a></li>
                                        </ul>
                                    </div>
                                    &nbsp; 
                                    <a href="{{ route('imagenes.index') }}" 
                                        class="btn btn-outline-danger">
                                        Quitar filtros
                                    </a>
                                </div>
                            </div>
						</div>
						<div class="card-body">
							<div class="row">
								
                                @foreach( $imagesArray as $keyImage => $valueImage )
                                    <div class="col-md-3 mt-2">
                                        <div class="card text-white">
                                            <img src="{{ $valueImage['previewURL'] }}" alt="Image" height="150px">
                                            <div class="card-img-overlay">
                                                <small>
                                                    <a href="{{ route('imagenes.detail', $valueImage['id']) }}" 
                                                    class="btn-sm btn-secondary btn mx-2">Detalle</a>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
							</div>
						</div>
					</div>
                    <br><br>
				</div>
			</div>
		</div>
	</div>
			
		
@endsection