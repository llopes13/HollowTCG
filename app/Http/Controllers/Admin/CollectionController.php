<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
public function index()
{
$collections = Collection::all(); // lista todas
return view('admin.collections.index', compact('collections'));
}

public function create()
{
return view('admin.collections.create'); // form de nova
}

public function store(Request $request)
{
$request->validate([
'id' => 'required|unique:collections,id',
'name' => 'required|string|max:255',
]);

Collection::create($request->all()); // salva

return redirect()->route('admin.collections.index')->with('success', 'Categoria criada com sucesso!');
}

public function edit(Collection $collection)
{
return view('admin.collections.edit', compact('collection')); // form de edição
}

public function update(Request $request, Collection $collection)
{
$request->validate([
'name' => 'required|string|max:255',
]);

$collection->update($request->only('name'));

return redirect()->route('admin.collections.index')->with('success', 'Categoria atualizada!');
}

public function destroy(Collection $collection)
{
$collection->delete();

return redirect()->route('admin.collections.index')->with('success', 'Categoria excluída!');
}
}
