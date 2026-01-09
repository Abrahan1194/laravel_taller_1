@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')
    <div class="page-header">
        <a href="{{ route('users.index') }}" class="btn-flat waves-effect" style="margin-bottom: 16px;">
            <i class="material-icons left">arrow_back</i>
            Volver a Usuarios
        </a>
        <h4>
            <i class="material-icons">person_add</i>
            Nuevo Usuario
        </h4>
    </div>

    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card animate-fade-in">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">person</i>
                                    Información Personal
                                </h5>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                                    <label for="name">Nombre Completo</label>
                                    @error('name')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                                    <label for="email">Correo Electrónico</label>
                                    @error('email')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 16px;">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">lock</i>
                                    Seguridad
                                </h5>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" id="password" name="password" required>
                                    <label for="password">Contraseña</label>
                                    @error('password')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 16px;">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">admin_panel_settings</i>
                                    Rol y Permisos
                                </h5>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <select name="role" id="role" required>
                                        <option value="" disabled selected>Seleccionar rol</option>
                                        <option value="viewer" {{ old('role') === 'viewer' ? 'selected' : '' }}>Usuario
                                            Consulta</option>
                                        <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Gestor de
                                            Inventario</option>
                                        <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>
                                            Super Administrador</option>
                                    </select>
                                    <label for="role">Rol del Usuario</label>
                                    @error('role')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12">
                                <div
                                    style="background: var(--bg-secondary); border-radius: 12px; padding: 20px; margin-top: 16px;">
                                    <h6
                                        style="font-weight: 600; margin: 0 0 16px; font-size: 0.9rem; color: var(--text-secondary);">
                                        <i class="material-icons tiny" style="vertical-align: middle;">info</i>
                                        Resumen de Permisos
                                    </h6>
                                    <div style="display: grid; gap: 12px;">
                                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                                            <span class="badge-role badge-super-admin" style="white-space: nowrap;">Super
                                                Admin</span>
                                            <span style="font-size: 0.85rem; color: var(--text-secondary);">Acceso completo:
                                                usuarios, auditoría y productos</span>
                                        </div>
                                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                                            <span class="badge-role badge-editor" style="white-space: nowrap;">Gestor</span>
                                            <span style="font-size: 0.85rem; color: var(--text-secondary);">Crear, editar y
                                                eliminar productos</span>
                                        </div>
                                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                                            <span class="badge-role badge-viewer"
                                                style="white-space: nowrap;">Consulta</span>
                                            <span style="font-size: 0.85rem; color: var(--text-secondary);">Solo
                                                visualización de productos</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 24px;">
                                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                    <input type="checkbox" name="is_active" class="filled-in" checked
                                        style="opacity: 1; pointer-events: auto;">
                                    <span style="font-weight: 500;">Usuario Activo</span>
                                </label>
                                <p style="color: var(--text-secondary); font-size: 0.85rem; margin: 8px 0 0 32px;">
                                    Los usuarios inactivos no pueden iniciar sesión en el sistema.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-action" style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('users.index') }}" class="btn-flat waves-effect">Cancelar</a>
                        <button type="submit" class="btn waves-effect waves-light blue">
                            <i class="material-icons left">save</i>
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection