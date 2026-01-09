@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="page-header">
        <a href="{{ route('users.index') }}" class="btn-flat waves-effect" style="margin-bottom: 16px;">
            <i class="material-icons left">arrow_back</i>
            Volver a Usuarios
        </a>
        <h4>
            <i class="material-icons">edit</i>
            Editar Usuario
        </h4>
    </div>

    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card animate-fade-in">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-content">
                        <div class="row">
                            <!-- User info header -->
                            <div class="col s12" style="margin-bottom: 24px;">
                                <div
                                    style="display: flex; align-items: center; gap: 20px; padding: 20px; background: var(--bg-secondary); border-radius: 12px;">
                                    <div class="user-avatar-sm"
                                        style="width: 64px; height: 64px; font-size: 24px; border-radius: 16px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h5 style="margin: 0 0 4px; font-weight: 600;">{{ $user->name }}</h5>
                                        <p style="margin: 0; color: var(--text-secondary);">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>

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
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                        required>
                                    <label for="name" class="active">Nombre Completo</label>
                                    @error('name')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12">
                                <div class="input-field">
                                    <i class="material-icons prefix">email</i>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                        required>
                                    <label for="email" class="active">Correo Electrónico</label>
                                    @error('email')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 16px;">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">lock</i>
                                    Cambiar Contraseña
                                </h5>
                                <p style="color: var(--text-secondary); font-size: 0.9rem; margin: -16px 0 20px;">
                                    Dejar en blanco para mantener la contraseña actual
                                </p>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock</i>
                                    <input type="password" id="password" name="password">
                                    <label for="password">Nueva Contraseña</label>
                                    @error('password')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input type="password" id="password_confirmation" name="password_confirmation">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>

                            <div class="col s12" style="margin-top: 16px;">
                                <h5
                                    style="font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                                    <i class="material-icons" style="color: var(--primary-color);">admin_panel_settings</i>
                                    Rol y Estado
                                </h5>
                            </div>

                            <div class="col s12 m6">
                                <div class="input-field">
                                    <select name="role" id="role" required>
                                        <option value="viewer" {{ old('role', $user->role) === 'viewer' ? 'selected' : '' }}>
                                            Usuario Consulta</option>
                                        <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>
                                            Gestor de Inventario</option>
                                        <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Administrador</option>
                                    </select>
                                    <label for="role">Rol del Usuario</label>
                                    @error('role')
                                        <span class="helper-text" style="color: #ef4444;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col s12 m6" style="display: flex; align-items: center; padding-top: 20px;">
                                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                                    <input type="checkbox" name="is_active" class="filled-in" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                    <span style="font-weight: 500;">Usuario Activo</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-action" style="display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('users.index') }}" class="btn-flat waves-effect">Cancelar</a>
                        <button type="submit" class="btn waves-effect waves-light blue">
                            <i class="material-icons left">save</i>
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection