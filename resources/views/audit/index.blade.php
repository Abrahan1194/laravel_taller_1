@extends('layouts.app')

@section('title', 'Auditoría')

@section('content')
<div class="page-header">
    <div class="row valign-wrapper" style="margin-bottom: 0;">
        <div class="col s12 m6">
            <h4>
                <i class="material-icons">history</i>
                Historial de Auditoría
            </h4>
            <p style="color: var(--text-secondary); margin: 8px 0 0;">Registro de todas las acciones del sistema</p>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card animate-fade-in" style="margin-bottom: 24px;">
    <div class="card-content">
        <form method="GET" action="{{ route('audit.index') }}">
            <div class="row" style="margin-bottom: 0;">
                <div class="col s12 m3">
                    <div class="input-field" style="margin-top: 0;">
                        <select name="module">
                            <option value="">Todos los módulos</option>
                            <option value="users" {{ request('module') == 'users' ? 'selected' : '' }}>Usuarios</option>
                            <option value="products" {{ request('module') == 'products' ? 'selected' : '' }}>Productos</option>
                        </select>
                        <label>Módulo</label>
                    </div>
                </div>
                <div class="col s12 m3">
                    <div class="input-field" style="margin-top: 0;">
                        <select name="action">
                            <option value="">Todas las acciones</option>
                            <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Creación</option>
                            <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Actualización</option>
                            <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Eliminación</option>
                        </select>
                        <label>Acción</label>
                    </div>
                </div>
                <div class="col s12 m3">
                    <div class="input-field" style="margin-top: 0;">
                        <input type="text" name="from" class="datepicker" value="{{ request('from') }}" placeholder="Desde">
                        <label class="active">Desde</label>
                    </div>
                </div>
                <div class="col s12 m3">
                    <div class="input-field" style="margin-top: 0;">
                        <input type="text" name="to" class="datepicker" value="{{ request('to') }}" placeholder="Hasta">
                        <label class="active">Hasta</label>
                    </div>
                </div>
                <div class="col s12 right-align">
                    <a href="{{ route('audit.index') }}" class="btn-flat waves-effect">
                        <i class="material-icons left">clear</i>Limpiar
                    </a>
                    <button type="submit" class="btn waves-effect waves-light blue">
                        <i class="material-icons left">filter_list</i>Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Audit Logs -->
<div class="card animate-fade-in">
    <div class="card-content" style="padding: 0;">
        <table class="striped responsive-table">
            <thead>
                <tr>
                    <th style="padding-left: 24px;">Fecha/Hora</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Módulo</th>
                    <th>ID Registro</th>
                    <th>IP</th>
                    <th class="center-align" style="padding-right: 24px;">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td style="padding-left: 24px; white-space: nowrap;">
                        <div style="font-weight: 500;">{{ $log->created_at->format('d/m/Y') }}</div>
                        <div style="font-size: 0.85rem; color: var(--text-secondary);">{{ $log->created_at->format('H:i:s') }}</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="user-avatar-sm" style="width: 32px; height: 32px; font-size: 12px; border-radius: 8px;">
                                {{ substr($log->user->name ?? 'S', 0, 1) }}
                            </div>
                            <span style="font-weight: 500;">{{ $log->user->name ?? 'Sistema' }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="audit-action audit-{{ $log->action }}">
                            @switch($log->action)
                                @case('create')
                                    <i class="material-icons tiny">add_circle</i> Creación
                                    @break
                                @case('update')
                                    <i class="material-icons tiny">edit</i> Actualización
                                    @break
                                @case('delete')
                                    <i class="material-icons tiny">delete</i> Eliminación
                                    @break
                            @endswitch
                        </span>
                    </td>
                    <td>
                        <span style="padding: 4px 10px; background: var(--bg-secondary); border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                            {{ ucfirst($log->module) }}
                        </span>
                    </td>
                    <td style="font-weight: 600; color: var(--primary-color);">#{{ $log->record_id }}</td>
                    <td style="font-family: monospace; font-size: 0.85rem; color: var(--text-secondary);">{{ $log->ip_address ?? '-' }}</td>
                    <td class="center-align" style="padding-right: 24px;">
                        <a href="#modal-details-{{ $log->id }}" class="btn-floating btn-small waves-effect waves-light blue modal-trigger tooltipped" data-position="top" data-tooltip="Ver detalles">
                            <i class="material-icons">visibility</i>
                        </a>
                    </td>
                </tr>
                
                <!-- Details Modal -->
                <div id="modal-details-{{ $log->id }}" class="modal" style="max-width: 700px;">
                    <div class="modal-content">
                        <h5 style="margin-bottom: 24px;">
                            <i class="material-icons left" style="color: var(--primary-color);">info</i>
                            Detalles del Registro
                        </h5>
                        
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 24px;">
                            <div style="padding: 16px; background: var(--bg-secondary); border-radius: 10px;">
                                <small style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Fecha/Hora</small>
                                <p style="margin: 4px 0 0; font-weight: 500;">{{ $log->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div style="padding: 16px; background: var(--bg-secondary); border-radius: 10px;">
                                <small style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Usuario</small>
                                <p style="margin: 4px 0 0; font-weight: 500;">{{ $log->user->name ?? 'Sistema' }}</p>
                            </div>
                            <div style="padding: 16px; background: var(--bg-secondary); border-radius: 10px;">
                                <small style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Acción</small>
                                <p style="margin: 4px 0 0;">
                                    <span class="audit-action audit-{{ $log->action }}">{{ ucfirst($log->action) }}</span>
                                </p>
                            </div>
                            <div style="padding: 16px; background: var(--bg-secondary); border-radius: 10px;">
                                <small style="color: var(--text-secondary); font-weight: 600; text-transform: uppercase; font-size: 0.7rem;">Módulo / ID</small>
                                <p style="margin: 4px 0 0; font-weight: 500;">{{ ucfirst($log->module) }} #{{ $log->record_id }}</p>
                            </div>
                        </div>
                        
                        @if($log->old_values)
                        <div style="margin-bottom: 16px;">
                            <h6 style="font-weight: 600; margin-bottom: 12px; color: #dc2626;">
                                <i class="material-icons tiny" style="vertical-align: middle;">remove_circle</i>
                                Valores Anteriores
                            </h6>
                            <pre style="background: #fef2f2; border: 1px solid #fecaca; padding: 16px; border-radius: 10px; overflow-x: auto; font-size: 0.85rem;">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                        @endif
                        
                        @if($log->new_values)
                        <div>
                            <h6 style="font-weight: 600; margin-bottom: 12px; color: #16a34a;">
                                <i class="material-icons tiny" style="vertical-align: middle;">add_circle</i>
                                Valores Nuevos
                            </h6>
                            <pre style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 16px; border-radius: 10px; overflow-x: auto; font-size: 0.85rem;">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-close btn-flat waves-effect">Cerrar</a>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="material-icons">history</i>
                            <h5>No hay registros de auditoría</h5>
                            <p>Las acciones del sistema aparecerán aquí</p>
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
    {{ $logs->appends(request()->query())->links() }}
</div>
@endsection
