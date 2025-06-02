<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
public function index()
{
$usuarios = User::all();
return view('admin.usuarios.index', compact('usuarios'));
}

public function edit($id)
{
$usuario = User::findOrFail($id);
return view('admin.usuarios.edit', compact('usuario'));
}

public function update(Request $request, $id)
{
$usuario = User::findOrFail($id);
$usuario->update($request->only(['name', 'email', 'role'])); // Atualiza nome, email e role
return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado!');
}

public function destroy($id)
{
$usuario = User::findOrFail($id);
$usuario->delete();
return redirect()->route('admin.usuarios.index')->with('success', 'Usuário excluído!');
}
}
