@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="page-header">
    <div class="row valign-wrapper" style="margin-bottom: 0;">
        <div class="col s12 m6">
            <h4>
                <i class="material-icons">people</i>
                Usuarios
            </h4>
            <p style="color: var(--text-secondary); margin: 8px 0 0;">Gestión de usuarios del sistema</p>
        </div>
        <div class="col s12 m6 right-align">
            <a href="{{ route('users.create') }}" class="btn waves-effect waves-light blue">
                <i class="material-icons left">person_add</i>
                Nuevo Usuario
            </a>
        </div>
    </div>
</div>

<div class="card animate-fade-in">
    <div class="card-content" style="padding: 0;">
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th style="padding-left: 24px;">Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th class="center-align" style="padding-right: 24px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="padding: 16px 16px 16px 24px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--text-primary);">{{ $user->name }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-secondary);">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @switch($user->role)
                            @case('super_admin')
                                <span class="badge-role badge-super-admin">Super Admin</span>
                                @break
                            @case('editor')
                                <span class="badge-role badge-editor">Gestor</span>
                                @break
                            @case('viewer')
                                <span class="badge-role badge-viewer">Consulta</span>
                                @break
                            @default
                                <span class="badge-role badge-viewer">{{ ucfirst($user->role) }}</span>
                        @endswitch
                    </td>
                    <td>
                        <span class="badge-role {{ $user->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td style="color: var(--text-secondary); font-size: 0.9rem;">
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                    <td class="center-align" style="padding-right: 24px;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="{{ route('users.edit', $user) }}" class="btn-floating btn-small waves-effect waves-light blue tooltipped" data-position="top" data-tooltip="Editar">
                                <i class="material-icons">edit</i>
                            </a>
                            @if($user->id !== Auth::id())
                            <a href="#modal-delete-{{ $user->id }}" class="btn-floating btn-small waves-effect waves-light red modal-trigger tooltipped" data-position="top" data-tooltip="Eliminar">
                                <i class="material-icons">delete</i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                
                <!-- Delete Modal -->
                <div id="modal-delete-{{ $user->id }}" class="modal">
                    <div class="modal-content">
                        <h5>
                            <i class="material-icons left" style="color: #ef4444;">warning</i>
                            Eliminar Usuario
                        </h5>
                        <p>¿Estás seguro de que deseas eliminar a <strong>{{ $user->name }}</strong>?</p>
                        <p style="color: var(--text-secondary); font-size: 0.9rem;">Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-close btn-flat waves-effect">Cancelar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn waves-effect waves-light red">
                                <i class="material-icons left">delete</i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="material-icons">people_outline</i>
                            <h5>No hay usuarios registrados</h5>
                            <p>Comienza agregando usuarios al sistema</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="center-align" style="margin-top: 20px;">
    {{ $users->links() }}
</div>
@endsection