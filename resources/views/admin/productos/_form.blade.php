@csrf

<div class="mb-4">
    <label class="block mb-1">ID da Carta (card_id)</label>
    <input type="text" name="card_id" value="{{ old('card_id', $produto->card_id ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Nome</label>
    <input type="text" name="name" value="{{ old('name', $produto->name ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1">URL da Imagem</label>
    <input type="text" name="image_url" value="{{ old('image_url', $produto->image_url ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Preço (€)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $produto->price ?? '') }}" class="w-full border rounded px-3 py-2">
</div>

<div class="mb-4">
    <label class="block mb-1">Coleção</label>
    <select name="collection_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Selecionar --</option>
        @foreach($collections as $collection)
            <option value="{{ $collection->id }}" @selected(old('collection_id', $produto->collection_id ?? '') == $collection->id)>
                {{ $collection->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block mb-1">Raridade</label>
    <select name="rarity_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Selecionar --</option>
        @foreach($rarities as $rarity)
            <option value="{{ $rarity->id }}" @selected(old('rarity_id', $produto->rarity_id ?? '') == $rarity->id)>
                {{ $rarity->name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Salvar
</button>
