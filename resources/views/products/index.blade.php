@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <div class="page-header">
        <div class="row valign-wrapper" style="margin-bottom: 0;">
            <div class="col s12 m6">
                <h4>
                    <i class="material-icons">inventory_2</i>
                    Productos
                </h4>
                <p style="color: var(--text-secondary); margin: 8px 0 0;">Gestión del catálogo de productos</p>
            </div>
            @if(Auth::user()->canManageProducts())
                <div class="col s12 m6 right-align">
                    <a href="{{ route('products.create') }}" class="btn waves-effect waves-light blue">
                        <i class="material-icons left">add</i>
                        Nuevo Producto
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $product)
                <div class="col s12 m6 l4 animate-fade-in">
                    <div class="card product-card">
                        <div class="card-image">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div
                                    style="height: 200px; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="material-icons" style="font-size: 64px; color: #94a3b8;">inventory_2</i>
                                </div>
                            @endif
                            <span class="card-title">{{ $product->name }}</span>
                        </div>
                        <div class="card-content">
                            <p
                                style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 16px; height: 40px; overflow: hidden;">
                                {{ Str::limit($product->description, 80) ?? 'Sin descripción' }}
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                <span style="font-size: 0.8rem; color: var(--text-secondary);">
                                    {{ $product->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <div class="card-action" style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a href="{{ route('products.show', $product) }}" class="btn-flat btn-small waves-effect"
                                style="flex: 1;">
                                <i class="material-icons left tiny">visibility</i>Ver
                            </a>
                            @if(Auth::user()->canManageProducts())
                                <a href="{{ route('products.edit', $product) }}" class="btn-flat btn-small waves-effect"
                                    style="flex: 1;">
                                    <i class="material-icons left tiny">edit</i>Editar
                                </a>
                                <a href="#modal-delete-{{ $product->id }}"
                                    class="btn-flat btn-small waves-effect red-text modal-trigger">
                                    <i class="material-icons tiny">delete</i>
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(Auth::user()->canManageProducts())
                        <!-- Delete Modal -->
                        <div id="modal-delete-{{ $product->id }}" class="modal">
                            <div class="modal-content">
                                <h5>
                                    <i class="material-icons left" style="color: #ef4444;">warning</i>
                                    Eliminar Producto
                                </h5>
                                <p>¿Estás seguro de que deseas eliminar <strong>{{ $product->name }}</strong>?</p>
                                <p style="color: var(--text-secondary); font-size: 0.9rem;">Esta acción no se puede deshacer.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close btn-flat waves-effect">Cancelar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn waves-effect waves-light red">
                                        <i class="material-icons left">delete</i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="center-align" style="margin-top: 20px;">
            {{ $products->links() }}
        </div>

        @if(Auth::user()->canManageProducts())
            <!-- Floating Action Button -->
            <div class="fixed-action-btn">
                <a href="{{ route('products.create') }}" class="btn-floating btn-large waves-effect waves-light">
                    <i class="material-icons">add</i>
                </a>
            </div>
        @endif

    @else
        <div class="card animate-fade-in">
            <div class="empty-state">
                <i class="material-icons">inventory_2</i>
                <h5>No hay productos registrados</h5>
                @if(Auth::user()->canManageProducts())
                    <p>Comienza agregando tu primer producto al catálogo</p>
                    <a href="{{ route('products.create') }}" class="btn waves-effect waves-light blue">
                        <i class="material-icons left">add</i>
                        Agregar Producto
                    </a>
                @else
                    <p>No hay productos disponibles para mostrar</p>
                @endif
            </div>
        </div>
    @endif
@endsection