<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\model_has_roles;
use DB;
use Redirect;
use Response;
use App\User;
use App\Subdependencia;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $usuarios = user::all();
        $usuarios = DB::table('users as u')
                    ->select('u.id', 'u.username', 'u.name')
                    ->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function index_contrasena(){
        return view('usuarios.edit_contrasena');
    }

    public function store(Request $request){
        $validData = $request->validate([
            'username'    => 'required|min:3',
            'name'        => 'required'
        ]);

        $usuario = new user();
        $usuario->username = $validData['username'];
        $usuario->name     = $validData['name'];
        $usuario->password = Hash::make('@mad');
        $usuario->email    = $request->email;
        $usuario->save();

        return redirect(route('usuarios'))->with('success', 'Usuario grabado con exito!');
    }

    public function edit($id){
        $registroId = Crypt::decrypt($id);
        $usuario         = user::findOrFail($registroId);
        $roles           = Role::where('id', '<>', 1)->get();
        $roles_asignados = model_has_roles::where('model_id', $registroId)
                           ->select('role_id')
                           ->get()
                           ->toArray();

        return view('usuarios.edit', compact('usuario', 'roles', 'roles_asignados'));
    }

    public function update(Request $request, $id){
        $registroId = Crypt::decrypt($id);
        $validData = $request->validate([
            'username'    => 'required',
            'name'        => 'required'
        ]);


        $usuario = user::findOrFail($registroId);
        $usuario->username = $validData['username'];
        $usuario->name     = $validData['name'];
        $usuario->email    = $request->email;
        $usuario->save();

        $roles = $request->callbacks;

        DB::table('model_has_roles')->where('model_id', $registroId)->delete();

        if (isset($roles)) {
            foreach ($roles as $key => $role) {

                $r = new model_has_roles();
                $r->role_id  = $role;
                $r->model_type = 'App\User';
                $r->model_id = $registroId;
                $r->save();
            }
        }

        return redirect(route('usuarios'))->with('success', 'Usuario grabado con exito!');
    }

    public function update_contrasena(Request $request){

        if (Hash::check($request->actual, Auth::user()->password)){
            if ($request->contrasena == $request->confirmar) {
                $usuario = user::findOrFail(Auth::user()->id);
                $usuario->password = Hash::make($request->contrasena);
                $usuario->save();

                return redirect(route('usuarios'))->with('success', 'Usuario modificado con exito!');
            }else{
                return redirect(route('usuarios'))->with('success', 'Error datos no concuerdan!');
            }   
        }else{
            return Redirect::back()->withErrors(['errors' => 'Contraseña actual no coincide con nuestros registros']);
        }
    }

    public function update_pass($usuario_id){
        $registroId = Crypt::decrypt($usuario_id);
        $usuario = user::findOrFail($registroId);
        $usuario->password = Hash::make('@mad');
        $usuario->save();
        return redirect(route('home'))->with('success', 'Usuario modificado con exito!');
    }

    public function profile(){
        $registro = User::findOrFail(Auth::user()->id);
        return view('usuarios.profile', compact('registro'));
    }

    public function profile_update(Request $request){
        $validData = $request->validate([
            'email'       => 'required',
            'name'        => 'required'
        ]);

        $registro = User::findOrFail(Auth::user()->id);
        $registro->name   = $validData['name'];
        $registro->email  = $validData['email'];

        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $name = time().'_'.$file->getClientOriginalName();
            $ext  = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $type = $file->getType();

            $path = 'profile_pictures';
            if(!file_exists($path)) {
                mkdir($path,0777);
            }

            \Storage::disk('public')->put($path.'/'.$name, File::get($file));
            $registro->profile_picture = $path.'/'.$name;
        }

        $registro->save();
        
        return redirect()->back()->with('success', 'your message,here');   
    }
}
