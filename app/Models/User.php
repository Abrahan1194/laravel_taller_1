<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user is super admin (can manage users and view audit)
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is editor (can manage products)
     */
    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }

    /**
     * Check if user is viewer (read-only access)
     */
    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    /**
     * Check if user can manage products (super_admin and editor)
     */
    public function canManageProducts(): bool
    {
        return in_array($this->role, ['super_admin', 'editor']);
    }

    /**
     * Check if user can manage users (only super_admin)
     */
    public function canManageUsers(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user can view audit (only super_admin)
     */
    public function canViewAudit(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Alias for backward compatibility
     */
    public function isAdmin(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Get role display name
     */
    public function getRoleNameAttribute(): string
    {
        return match ($this->role) {
            'super_admin' => 'Super Administrador',
            'editor' => 'Gestor de Inventario',
            'viewer' => 'Usuario Consulta',
            default => ucfirst($this->role),
        };
    }

    /**
     * Get audit logs for this user
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
