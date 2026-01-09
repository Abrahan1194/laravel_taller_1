@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <div class="row valign-wrapper" style="margin-bottom: 0;">
            <div class="col s12 m6">
                <h4>
                    <i class="material-icons">dashboard</i>
                    Dashboard
                </h4>
                <p style="color: var(--text-secondary); margin: 8px 0 0;">Resumen general del sistema</p>
            </div>
            <div class="col s12 m6 right-align hide-on-small-only">
                <span style="color: var(--text-secondary); font-size: 0.9rem;">
                    <i class="material-icons tiny" style="vertical-align: middle;">schedule</i>
                    {{ now()->format('d M Y, H:i') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col s12 m6 l3 animate-fade-in">
            <div class="stats-card blue-gradient">
                <div class="stats-icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="stats-number">{{ $stats['total_users'] }}</div>
                <div class="stats-label">Total Usuarios</div>
            </div>
        </div>
        <div class="col s12 m6 l3 animate-fade-in">
            <div class="stats-card green-gradient">
                <div class="stats-icon">
                    <i class="material-icons">verified_user</i>
                </div>
                <div class="stats-number">{{ $stats['active_users'] }}</div>
                <div class="stats-label">Usuarios Activos</div>
            </div>
        </div>
        <div class="col s12 m6 l3 animate-fade-in">
            <div class="stats-card orange-gradient">
                <div class="stats-icon">
                    <i class="material-icons">inventory_2</i>
                </div>
                <div class="stats-number">{{ $stats['total_products'] }}</div>
                <div class="stats-label">Total Productos</div>
            </div>
        </div>
        <div class="col s12 m6 l3 animate-fade-in">
            <div class="stats-card purple-gradient">
                <div class="stats-icon">
                    <i class="material-icons">history</i>
                </div>
                <div class="stats-number">{{ $stats['recent_actions'] }}</div>
                <div class="stats-label">Acciones Hoy</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Activity -->
        <div class="col s12 l8 animate-fade-in">
            <div class="card">
                <div class="card-content">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <span class="card-title" style="margin: 0;">
                            <i class="material-icons left" style="color: var(--primary-color);">timeline</i>
                            Actividad Reciente
                        </span>
                        @if(Auth::user()->isSuperAdmin())
                            <a href="{{ route('audit.index') }}" class="btn-flat btn-small waves-effect"
                                style="text-transform: none;">
                                Ver todo <i class="material-icons right tiny">arrow_forward</i>
                            </a>
                        @endif
                    </div>

                    @if($recentLogs->count() > 0)
                        <div class="collection" style="border: none; margin: 0;">
                            @foreach($recentLogs as $log)
                                <div class="collection-item"
                                    style="border: none; padding: 16px 0; border-bottom: 1px solid var(--border-color);">
                                    <div style="display: flex; align-items: center; gap: 16px;">
                                        <div
                                            style="width: 44px; height: 44px; border-radius: 12px; background: {{ $log->action === 'create' ? '#dcfce7' : ($log->action === 'update' ? '#fef3c7' : '#fee2e2') }}; display: flex; align-items: center; justify-content: center;">
                                            <i class="material-icons"
                                                style="font-size: 20px; color: {{ $log->action === 'create' ? '#166534' : ($log->action === 'update' ? '#92400e' : '#991b1b') }};">
                                                {{ $log->action === 'create' ? 'add_circle' : ($log->action === 'update' ? 'edit' : 'delete') }}
                                            </i>
                                        </div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 600; color: var(--text-primary); margin-bottom: 2px;">
                                                {{ ucfirst($log->action) }} en {{ ucfirst($log->module) }}
                                            </div>
                                            <div style="font-size: 0.85rem; color: var(--text-secondary);">
                                                {{ $log->user->name ?? 'Sistema' }} • {{ $log->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <span class="audit-action audit-{{ $log->action }}">
                                            #{{ $log->record_id }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state" style="padding: 40px 20px;">
                            <i class="material-icons" style="font-size: 60px;">inbox</i>
                            <h5>Sin actividad reciente</h5>
                            <p>Las acciones del sistema aparecerán aquí</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col s12 l4 animate-fade-in">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">
                        <i class="material-icons left" style="color: var(--primary-color);">flash_on</i>
                        Acciones Rápidas
                    </span>

                    <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 20px;">
                        @if(Auth::user()->canManageProducts())
                            <a href="{{ route('products.create') }}" class="btn waves-effect waves-light blue"
                                style="width: 100%; text-align: left; display: flex; align-items: center; gap: 12px;">
                                <i class="material-icons">add_box</i>
                                <span>Nuevo Producto</span>
                            </a>
                        @endif

                        @if(Auth::user()->isSuperAdmin())
                            <a href="{{ route('users.create') }}" class="btn waves-effect waves-light green"
                                style="width: 100%; text-align: left; display: flex; align-items: center; gap: 12px;">
                                <i class="material-icons">person_add</i>
                                <span>Nuevo Usuario</span>
                            </a>
                            <a href="{{ route('audit.index') }}" class="btn waves-effect waves-light purple"
                                style="width: 100%; text-align: left; display: flex; align-items: center; gap: 12px;">
                                <i class="material-icons">history</i>
                                <span>Ver Auditoría</span>
                            </a>
                        @endif

                        <a href="{{ route('products.index') }}" class="btn waves-effect waves-light orange"
                            style="width: 100%; text-align: left; display: flex; align-items: center; gap: 12px;">
                            <i class="material-icons">inventory_2</i>
                            <span>Ver Productos</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="card" style="margin-top: 20px;">
                <div class="card-content">
                    <span class="card-title">
                        <i class="material-icons left" style="color: var(--primary-color);">account_circle</i>
                        Mi Cuenta
                    </span>

                    <div style="text-align: center; padding: 20px 0;">
                        <div
                            style="width: 80px; height: 80px; border-radius: 20px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 32px; color: white; font-weight: 700;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h5 style="margin: 0 0 4px; font-weight: 600;">{{ Auth::user()->name }}</h5>
                        <p style="color: var(--text-secondary); margin: 0 0 12px; font-size: 0.9rem;">
                            {{ Auth::user()->email }}</p>
                        <span
                            class="badge-role badge-{{ Auth::user()->role === 'super_admin' ? 'super-admin' : Auth::user()->role }}">
                            {{ Auth::user()->role_name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection