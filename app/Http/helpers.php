<?php

use Illuminate\Container\Container;

function _getFromListById($list, $key, $id_to_eval)
{
	$list = $list;
	$list_item = null;
		
	if ( ($list) )
	{
		foreach ($list as $keyItem => $valueItem)
		{
			if ( $valueItem->{ $key } == $id_to_eval ) {
				$list_item = $valueItem;
				break;
			}
		}
	}
    	
	return $list_item;
}

function _listTypeDocument()
{
    $list[] = (object) ['id_type_document' => 1, 'name' => 'Cédula' ];
    $list[] = (object) ['id_type_document' => 2, 'name' => 'NIT' ];
    $list[] = (object) ['id_type_document' => 3, 'name' => 'RUC' ];
    $list[] = (object) ['id_type_document' => 4, 'name' => 'Pasaporte' ];
    
    return (object) $list;
}

function _getTypeDocument($id_tipo_documento)
{
	$item = _getFromListById(_listTypeDocument(), 'id_type_document', $id_tipo_documento);
	
	return ($item ? $item->name : null);
}

?>