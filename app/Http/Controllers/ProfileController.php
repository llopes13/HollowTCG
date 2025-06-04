<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
public function index()
{
$user = Auth::user();
$orders = $user->orders()->with('orderItems')->latest()->get();

return view('profile.index', compact('user', 'orders'));
}

public function update(Request $request)
{
$user = Auth::user();

$request->validate([
'name' => 'required|string|max:255',
'email' => 'required|email|max:255',
// Adicione mais validações conforme necessário
]);

$user->update($request->only('name', 'email'));

return redirect()->route('perfil.index')->with('success', 'Dados atualizados com sucesso!');
}
}
