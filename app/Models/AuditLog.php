<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'module',
        'record_id',
        'old_values',
        'new_values',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    /**
     * Get the user that performed the action
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get action badge color for UI
     */
    public function getActionColorAttribute(): string
    {
        return match ($this->action) {
            'create' => 'green',
            'update' => 'orange',
            'delete' => 'red',
            default => 'grey',
        };
    }

    /**
     * Get action icon for UI
     */
    public function getActionIconAttribute(): string
    {
        return match ($this->action) {
            'create' => 'add_circle',
            'update' => 'edit',
            'delete' => 'delete',
            default => 'info',
        };
    }
}
