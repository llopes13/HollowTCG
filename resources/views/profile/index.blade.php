@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-[#D4C2FC] mb-6">Meu Perfil</h1>

        <!-- Visualização de dados -->
        <div class="bg-[#1A1A2E] text-[#D4C2FC] p-4 rounded shadow mb-4">
            <p><strong>Nome:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Sobrenome:</strong> {{ Auth::user()->lastname }}</p>
            <p><strong>Data de nascimento:</strong> {{ Auth::user()->birthdate }}</p>
            <p><strong>Telefone:</strong> {{ Auth::user()->phone }}</p>
            <p><strong>Endereço:</strong> {{ Auth::user()->address }}</p>
            <p><strong>Endereço de cobrança:</strong> {{ Auth::user()->billing_address }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <button
                id="edit-profile-btn"
                class="mt-4 px-4 py-2 bg-[#D4C2FC] text-[#1A1A2E] rounded hover:bg-[#cbb0f7] font-semibold"
            >
                Configurar Perfil
            </button>
        </div>

        <!-- Formulário oculto -->
        <div id="profile-form" class="hidden">
            <form method="POST" action="{{ route('profile.update') }}" class="bg-[#1A1A2E] p-4 rounded shadow">
                @csrf
                @method('PATCH')


                @php $user = Auth::user(); @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[#D4C2FC]">Nome</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div>
                        <label class="block text-[#D4C2FC]">Sobrenome</label>
                        <input type="text" name="lastname" value="{{ $user->lastname }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div>
                        <label class="block text-[#D4C2FC]">Data de nascimento</label>
                        <input type="date" name="birthdate" value="{{ $user->birthdate }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div>
                        <label class="block text-[#D4C2FC]">Telefone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div>
                        <label class="block text-[#D4C2FC]">Endereço</label>
                        <input type="text" name="address" value="{{ $user->address }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div>
                        <label class="block text-[#D4C2FC]">Endereço de cobrança</label>
                        <input type="text" name="billing_address" value="{{ $user->billing_address }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[#D4C2FC]">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 rounded bg-[#16213E] text-[#D4C2FC] border border-[#D4C2FC]/30">
                    </div>
                </div>

                <div class="text-right mt-4">
                    <button type="submit" class="px-6 py-2 bg-[#D4C2FC] text-[#16213E] rounded hover:bg-[#cbb0f7] font-bold">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>

        <!-- Pedidos -->
        <h2 class="text-xl font-semibold mt-10 mb-2 text-[#D4C2FC]">Mis Pedidos</h2>
        <div class="bg-white p-4 rounded shadow">
            @forelse($orders as $order)
                <div class="mb-4 border-b pb-2">
                    <p><strong>ID Pedido:</strong> {{ $order->id }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Total:</strong> €{{ number_format($order->total, 2) }}</p>
                    <p><strong>Itens:</strong></p>
                    <ul class="list-disc ml-6">
                        @foreach($order->orderItems as $item)
                            <li>
                                {{ $item->pokemonCard?->name ?? 'Produto removido' }} - {{ $item->quantity }}x
                            </li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p>Você ainda não fez nenhum pedido.</p>
            @endforelse
        </div>
    </div>
    <script src="{{ asset('js/perfil.js') }}"></script>

@endsection

@section('scripts')
@endsection
