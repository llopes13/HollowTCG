<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rarity;
use Illuminate\Http\Request;
class AdminRarityController extends Controller
{
public function index()
{
$rarities = Rarity::all();
return view('admin.rarities.index', compact('rarities'));
}

public function create()
{
return view('admin.rarities.create');
}

public function store(Request $request)
{
$request->validate([
'name' => 'required|unique:rarities,name',
]);

Rarity::create($request->only('name'));

return redirect()->route('admin.rarities.index')->with('success', 'Raridade criada com sucesso!');
}

public function edit(Rarity $rarity)
{
return view('admin.rarities.edit', compact('rarity'));
}

public function update(Request $request, Rarity $rarity)
{
$request->validate([
'name' => 'required|unique:rarities,name,' . $rarity->id,
]);

$rarity->update($request->only('name'));

return redirect()->route('admin.rarities.index')->with('success', 'Raridade atualizada com sucesso!');
}

public function destroy(Rarity $rarity)
{
$rarity->delete();

return redirect()->route('admin.rarities.index')->with('success', 'Raridade excluída com sucesso!');
}
}
