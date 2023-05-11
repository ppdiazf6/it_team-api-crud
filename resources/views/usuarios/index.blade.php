@extends('layouts.app', ['activePage' => 'usuarios'])

@section('title', 'ItTeam | Usuarios')
@section('body-class', 'user-page')


@section('content')
		
	<div class="content">
		<div class="container-fluid">
            <!-- $base_url = Request::url(); -->
            <input type="hidden" value="{{ Request::url() }}" name="base_url" id="base_url">
					
			@if ( session('success') )
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>
                        <b>{{ session('success') }}</b>
                    </span>
                </div>
            @endif
					
				
			<br>
				
			<div class="row mt-4">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">USUARIOS</h3>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end">
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-success mx-1">
                                        Registrar
                                    </a>
                                    <button type="button" 
                                            class="btn btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalFilter">
                                        Filtrar
                                    </button>
                                    &nbsp; 
                                    <a href="{{ route('usuarios.index') }}" 
                                        class="btn btn-outline-danger">
                                        Quitar filtros
                                    </a>
                                </div>
                            </div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="text-primary">
										<tr>
											<th>#</th>
                                            <th>Foto</th>
											<th>Nombre</th>
											<th>Apellidos</th>
											<th>Documento</th>
                                            <th>Edad</th>
                                            <th>Rol</th>
                                            <th>Tipo de Usuario</th>
											<th class="text-center">Opción</th>
										</tr>
									</thead>
									<tbody>
										@if ( count($usuarios) )
											@foreach( $usuarios as $keyStudent => $valueUsuario )
												<?php 
													$IdUsuario = $valueUsuario->id;
												?>
												<tr>
													<td>{{ $IdUsuario }}</td>
                                                    <td>
                                                        <img src="{{ asset($valueUsuario->foto) }}" alt="" width="80">
                                                    </td>
													<td>{{ $valueUsuario->nombre }}</td>
													<td>{{ $valueUsuario->apellido }}</td>
													<td>
                                                        <span class="d-inline-block" tabindex="0" 
                                                                data-bs-toggle="tooltip" 
                                                                data-bs-placement="top" 
                                                                title="{{ _getTypeDocument($valueUsuario->tipo_documento) }}">
                                                            {{ $valueUsuario->numero_documento }}
                                                        </span>
                                                    </td>
													<td>{{ $valueUsuario->edad }}</td>
                                                    <td>{{ $valueUsuario->rol->name }}</td>
                                                    <td>{{ $valueUsuario->tipo_usuario }}</td>
													<td class="text-center">
                                                        <div class="d-flex">
                                                            <a href="{{ route('usuarios.edit', $IdUsuario) }}" 
                                                                class="btn-sm btn-primary btn mx-2">
                                                                Editar
                                                            </a>
                                                            <form action="{{ route('usuarios.destroy', $IdUsuario) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn-sm btn-danger btn">Delete</button>
                                                            </form>
                                                        </div>
													</td>
												</tr>
											@endforeach
										@else
											<tr>
												<td colspan="6" class="text-center">¡No se encontraron registros!</td>
											</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFilterLabel">Buscar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="txt_nombre">Nombres</label>
                            <input id="txt_nombre" placeholder="Ejm. Pedro" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="txt_app">Apellidos</label>
                            <input id="txt_app" placeholder="Ejm. Diaz" type="text" class="form-control">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="slc_tipo_doc">Tipo de Documento</label>
                            <select class="form-control" id="slc_tipo_doc">
                                <option value="">[Elija Tipo de Documento]</option>
                                @if( count((array)_listTypeDocument()) )
                                    @foreach(_listTypeDocument() as $keyTypeDoc => $valueTypeDoc)
                                        <option value="{{ $valueTypeDoc->id_type_document }}">{{ $valueTypeDoc->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="txt_ndoc">Nro Documento</label>
                            <input id="txt_ndoc" placeholder="Ejm. 1234567890" type="text" max-length="10" class="form-control">
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label for="slc_rol" class="label-control">Rol</label>
                            <select class="form-control" id="slc_rol">
                                <option value="" selected disabled>[Elija Rol]</option>
                                @if( count($list_rols) )
                                    @foreach( $list_rols as $keyRol => $valueRol )
                                        <option value="{{ $valueRol->id }}">{{ $valueRol->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="txt_edad">Edad</label>
                            <input type="text" id="txt_edad" placeholder="Ejm. 30" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-filter-user">Filtrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
                
        $(document).ready(function(){
            
            //	FILTRAR USUARIOS 
            var modal_filter_users = '#modalFilter';
            
            ;(function($){
                var $filter_user = $(modal_filter_users);
                    
                var $btnFilter = $filter_user.find('#btn-filter-user');
                    
                $btnFilter.on('click', function(e){
                    var fname = $('#txt_nombre').val(),
                        lname = $('#txt_app').val(),
                        tdoc = $('#slc_tipo_doc').val(),
                        ndoc = $('#txt_ndoc').val(),
                        rol = $('#slc_rol').val(),
                        age = $('#txt_edad').val();
                        
                    //  url del proyecto...
                    // var base_url = 'http://localhost/pedro/pruebas/red-social-crud-it_team/public';
                    // var base_url = 'http://127.0.0.1:8000';
                    var base_url = $('#base_url').val(); //'?php echo base_url; ?>'
                    console.log(base_url);

                    var uri_suggestion = base_url + '?f_name='+fname+'&l_name='+lname+'&tdoc='+tdoc+'&ndoc='+ndoc+'&r='+rol+'&e='+age;
                        
                    window.location = uri_suggestion;
                });

            })(jQuery);
        });
    </script>
    <!-- End Scripts -->
			
		
@endsection