@extends('layouts.app', ['activePage' => 'usuarios'])

@section('content')

    <div class="main-content mt-5">
        @if( $errors->any() )
            @foreach( $errors as $error )
                <div class="alert lert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Edita Usuario</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <div>
                                <img src="{{ asset($user->foto) }}" alt="" style="width:150px">
                            </div>
                            <label for="" class="form-label">Foto</label>
                            <input type="file" name="image" id="" 
                                    accept="image/x-png,image/jpeg" 
                                    class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-2">
                            <label for="slc_rol" class="label-control">Rol</label>
                            <select name="rol" id="slc_rol" class="form-control" required>
                                <option value="">[Elija Rol]</option>
                                @foreach( $list_rols as $rol )
                                    <option {{ $rol->id == $user->role_id ? 'selected' : '' }} 
                                        value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Tipo de Usuario</label>
                            <input type="text" name="tipo_usuario" class="form-control" value="{{ $user->tipo_usuario }}" required>
                        </div>
                        <div class="col-sm-4">
						    <label for="slc_tipo_doc" class="label-control">Tipo de Documento</label>
							<select class="form-control" name="tipo_documento" id="slc_tipo_doc" required>
								<option value="" selected disabled>[Elija Tipo de Documento]</option>
                                
                                @if( count((array)_listTypeDocument()) )
                                    @foreach(_listTypeDocument() as $keyTypeDoc => $valueTypeDoc)
                                        @php
                                            $TypeDoc = $user->tipo_documento;
                                            $IdTypeD = $valueTypeDoc->id_type_document;
                                            $selected = ($TypeDoc == $IdTypeD ? 'selected' : '');
                                        @endphp
                                        <option value="{{ $IdTypeD }}" {{ $selected }}>{{ $valueTypeDoc->name }}</option>
                                    @endforeach
                                @endif
							</select>
						</div>
                        <div class="col-sm-4">
                            <label for="txt_documento" class="label-control">Número de Documento</label>
                            <input class="form-control" type="text" name="documento" id="txt_documento" required
                                    value="{{ $user->numero_documento }}">
                        </div>
                        <div class="col-sm-2">
                            <label for="txt_edad" class="label-control">Edad</label>
                            <input class="form-control" type="text" name="edad" id="txt_edad" value="{{ $user->edad }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="" value="{{ $user->nombre }}" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="form-label">Apellidos</label>
                            <input type="text" name="apellido" id="" value="{{ $user->apellido }}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group mt-3 mb-5 text-center">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

@endsection