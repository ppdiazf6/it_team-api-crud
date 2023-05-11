<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'Usuarios';
        
    //  Funcion para buscar usuarios segun filtros  
    public function scopeListUsers($builder, $filter_params)
    {
        if ( $filter_params )
		{
			if ( array_key_exists('f_name', $filter_params) )
			{
				$builder->where('nombre', 'LIKE', '%'.$filter_params['f_name'].'%');
			}
			if ( array_key_exists('l_name', $filter_params) )
			{
				$builder->where('apellido', 'LIKE', '%'.$filter_params['l_name'].'%');
			}
			if ( array_key_exists('tdoc', $filter_params) )
			{
				$builder->where('tipo_documento', '=', $filter_params['tdoc']);
			}
            if ( array_key_exists('ndoc', $filter_params) )
			{
				$builder->where('numero_documento', 'LIKE', $filter_params['ndoc']);
			}
            if ( array_key_exists('r', $filter_params) )
			{
				$builder->where('role_id', '=', $filter_params['r']);
			}
            if ( array_key_exists('e', $filter_params) )
			{
				$builder->where('edad', '=', $filter_params['e']);
			}
		}
						
        	
        return $builder->get();
	}
		
	
    //  RELATIONS
    public function rol()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
