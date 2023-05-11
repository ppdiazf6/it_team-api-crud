@extends('layouts.app', ['activePage' => 'usuarios'])

@section('body-class', 'user-page')

@section('content')
		
	<div class="main-content mt-5">
				
		@if ( $errors->any() )
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
			
		<div class="card">
					
			<div class="card-header">
				<h4	 class="title text-center">Registrar Usuario</h4>
			</div>
			<div class="card-body">	
				<form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
							
					@csrf
					
					<div class="row mt-4">
						<div class="col-sm-2">
							<label for="slc_rol" class="label-control">Rol</label>
							<select class="form-control" name="rol" id="slc_rol" required>
								<option value="" selected disabled>[Elija Rol]</option>
								@if( count($list_rols) )
									@foreach( $list_rols as $keyRol => $valueRol )
										<option value="{{ $valueRol->id }}">{{ $valueRol->name }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="col-sm-4">
							<label for="slc_tipo_doc" class="label-control">Tipo de Documento</label>
							<select class="form-control" name="tipo_documento" id="slc_tipo_doc" required>
								<option value="" selected disabled>[Elija Tipo de Documento]</option>
								@if( count((array)_listTypeDocument()) )
                                    @foreach(_listTypeDocument() as $keyTypeDoc => $valueTypeDoc)
                                        <option value="{{ $valueTypeDoc->id_type_document }}">{{ $valueTypeDoc->name }}</option>
                                    @endforeach
                                @endif
							</select>
						</div>
						<div class="col-sm-4">
							<label>Tipo de Usuario</label>
							<input type="text" name="tipo_usuario" class="form-control" placeholder="" required>
						</div>
						<div class="col-sm-4">
							<label for="txt_documento" class="label-control">Número de Documento</label>
							<input class="form-control" type="text" name="documento" id="txt_documento" placeholder="" required
									value="{{ old('documento') }}">
						</div>
						<div class="col-sm-2">
							<label for="txt_edad" class="label-control">Edad</label>
							<input class="form-control" type="text" name="edad" id="txt_edad" placeholder="Ejm. 27" required
									value="{{ old('edad') }}">
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-sm-6">
							<label class="label-control">Nombre</label>
							<input class="form-control" type="text" name="nombre" id="txt_nombre" placeholder="Ejm. Pedro" 
									value="{{ old('nombre') }}" required>
						</div>
						<div class="col-sm-6">
							<label class="label-control">Apellido</label>
							<input class="form-control" type="text" name="apellido" id="txt_apellido" placeholder="Ejm. Diaz" 
									value="{{ old('apellido') }}" required>
						</div>
					</div>
					<div class="row mt-4">
						<div class="form-group">
							<label for="img_foto" class="form-label">Foto</label>
							<input type="file" name="image" id="img_foto"
									accept="image/x-png,image/jpeg" 
									class="form-control">
						</div>
					</div>
					<div class="form-group mt-5 text-center">
						<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
						<button type="submit" class="btn btn-success">
							Guardar
						</button>
					</div>
						
				</form>
			</div>
		</div>
		
		
	</div>
			
		
@endsection