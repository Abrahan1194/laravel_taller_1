@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="page-header">
        <a href="{{ route('products.index') }}" class="btn-flat waves-effect" style="margin-bottom: 16px;">
            <i class="material-icons left">arrow_back</i>
            Volver a Productos
        </a>
    </div>

    <div class="row">
        <div class="col s12 l10 offset-l1">
            <div class="card animate-fade-in" style="overflow: hidden;">
                <div class="row" style="margin: 0;">
                    <!-- Image Section -->
                    <div class="col s12 m5" style="padding: 0;">
                        @if($product->image)
                            <div
                                style="height: 100%; min-height: 400px; background: url('{{ asset('storage/' . $product->image) }}') center/cover no-repeat;">
                            </div>
                        @else
                            <div
                                style="height: 100%; min-height: 400px; background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="material-icons" style="font-size: 100px; color: #94a3b8;">inventory_2</i>
                            </div>
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="col s12 m7">
                        <div class="card-content" style="padding: 32px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                                <div>
                                    <h4 style="font-weight: 700; margin: 0 0 8px; color: var(--text-primary);">
                                        {{ $product->name }}</h4>
                                    <span style="font-size: 0.85rem; color: var(--text-secondary);">
                                        <i class="material-icons tiny" style="vertical-align: middle;">schedule</i>
                                        Agregado {{ $product->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <span class="product-price"
                                    style="font-size: 2rem;">${{ number_format($product->price, 2) }}</span>
                            </div>

                            <div style="margin-bottom: 32px;">
                                <h6
                                    style="font-weight: 600; color: var(--text-secondary); margin-bottom: 12px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <i class="material-icons tiny" style="vertical-align: middle;">description</i>
                                    Descripción
                                </h6>
                                <p style="font-size: 1rem; line-height: 1.7; color: var(--text-primary);">
                                    {{ $product->description ?? 'Este producto no tiene descripción.' }}
                                </p>
                            </div>

                            <div
                                style="background: var(--bg-secondary); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                                <div class="row" style="margin: 0;">
                                    <div class="col s6">
                                        <small
                                            style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Creado</small>
                                        <p style="margin: 4px 0 0; font-weight: 500;">
                                            {{ $product->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col s6">
                                        <small
                                            style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Actualizado</small>
                                        <p style="margin: 4px 0 0; font-weight: 500;">
                                            {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if(Auth::user()->canManageProducts())
                                <div style="display: flex; gap: 12px;">
                                    <a href="{{ route('products.edit', $product) }}" class="btn waves-effect waves-light blue"
                                        style="flex: 1;">
                                        <i class="material-icons left">edit</i>
                                        Editar
                                    </a>
                                    <a href="#modal-delete" class="btn waves-effect waves-light red modal-trigger">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->canManageProducts())
        <!-- Delete Modal -->
        <div id="modal-delete" class="modal">
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
@endsection