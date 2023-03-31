<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use File;

use App\Models\Role;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_filters = [];
            
        $filter_fname = NULL;
        $filter_lname = NULL;
        $filter_tdoc = NULL;
        $filter_ndoc = NULL;
        $filter_role = NULL;
        $filter_age = NULL;
            
        $filter_params = [];
                
        
        // Get params
        $get_fname = $request->get('f_name');
        $get_lname = $request->get('l_name');
        $get_tdoc = $request->get('tdoc');
        $get_ndoc  = $request->get('ndoc');
        $get_role = $request->get('r');
        $get_age = $request->get('e');
        
            
        //  Expresión Regular 
        $ERtextos = '/^[a-zá-úA-ZÁ-Ú0-9\s]+$/';
            
        if ($get_fname && ! is_array($get_fname) && preg_match($ERtextos, $get_fname))
        {
            $user_filters['f_name'] = $filter_fname = $get_fname;
            $filter_params[] = 'f_name='.$filter_fname;
        }
        if ($get_lname && ! is_array($get_lname) && preg_match($ERtextos, $get_lname))
        {
            $user_filters['l_name'] = $filter_lname = $get_lname;
            $filter_params[] = 'l_name='.$filter_lname;
        }
        if ($get_tdoc && ! is_array($get_tdoc) && preg_match('/^[0-9\s]+$/', $get_tdoc))
        {
            $user_filters['tdoc'] = $filter_tdoc = $get_tdoc;
            $filter_params[] = 'tdoc='.$filter_tdoc;
        }
        if ($get_ndoc && ! is_array($get_ndoc) && preg_match('/^[0-9\s]+$/', $get_ndoc))
        {
            $user_filters['ndoc'] = $filter_ndoc = $get_ndoc;
            $filter_params[] = 'ndoc='.$filter_ndoc;
        }
        if ($get_role && ! is_array($get_role) && preg_match('/^[0-9\s]+$/', $get_role))
        {
            $user_filters['r'] = $filter_role = $get_role;
            $filter_params[] = 'r='.$filter_role;
        }
        if ($get_age && ! is_array($get_age) && preg_match('/^[0-9\s]+$/', $get_age))
        {
            $user_filters['e'] = $filter_age = $get_age;
            $filter_params[] = 'e='.$filter_age;
        }
            
            
        //  Lista Usuarios 
        $usuarios = Usuario::ListUsers($user_filters);
            
        
        //  Datos 
        
        $list_rols = Role::orderBy('name', 'asc')->get();
        
        //  Retorna la vista con los datos
        return view('usuarios.index', compact('usuarios', 'list_rols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_rols = Role::orderBy('name', 'asc')->get();
        $list_type_doc = [];
        
        return view('usuarios.create', compact('list_rols', 'list_type_doc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'edad' => 'required|max:2',
            'tipo_documento' => 'required|integer',
            'documento' => 'required',
            'rol' => 'required',
            'image' => 'required|max:2028|mimes:png,jpg,gif',
        ]);
        
        
        //  Guarda la imagen
        $fileName = time().'_'.$request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $fileName); 
            
        //  Guarda en la BDx 
        $user = new Usuario();
            $user->nombre = $request->nombre;
            $user->apellido = $request->apellido;
            $user->edad = $request->edad;
            $user->tipo_documento = $request->tipo_documento;
            $user->numero_documento = $request->documento;
            $user->role_id = $request->rol;
            $user->foto = 'storage/'.$filePath;
        $user->save();

        
        //
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Post::findOrFail($id);
        
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_rols = Role::orderBy('name', 'asc')->get();
        $user = Usuario::find($id);
        
        //  Retorna datos a la vista
        return view('usuarios.edit', compact('list_rols', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'edad' => 'required|max:2',
            'tipo_documento' => 'required|integer',
            'documento' => 'required',
            'rol' => 'required',
        ]);
        
        
        $usuario = Usuario::findOrFail($id);
        
        if ( $request->hasFile('image') ) {
            $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);
                
            $fileName = time().'_'.$request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $fileName);
                
                File::delete(public_path($usuario->foto));
                
            $usuario->foto = 'storage/'.$filePath;
        }
            
            #
        
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->edad = $request->edad;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->numero_documento = $request->documento;
        $usuario->role_id = $request->rol;
        
        $usuario->save();

        return redirect()->back(); //route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Usuario::findOrFail($id);
        $user->delete();
        //
        
        return redirect()->route('usuarios.index');
    }
}
