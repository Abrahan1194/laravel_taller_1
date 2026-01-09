<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    protected static function bootAuditable()
    {
        // Log when a model is created
        static::created(function ($model) {
            self::logAction($model, 'create', null, $model->getAttributes());
        });

        // Log when a model is updated
        static::updated(function ($model) {
            $oldValues = $model->getOriginal();
            $newValues = $model->getChanges();

            // Remove timestamps from changes
            unset($newValues['updated_at']);

            if (!empty($newValues)) {
                self::logAction($model, 'update', $oldValues, $newValues);
            }
        });

        // Log when a model is deleted
        static::deleted(function ($model) {
            self::logAction($model, 'delete', $model->getOriginal(), null);
        });
    }

    /**
     * Create an audit log entry
     */
    protected static function logAction($model, string $action, ?array $oldValues, ?array $newValues): void
    {
        // Skip if no user is authenticated
        if (!Auth::check()) {
            return;
        }

        // Remove sensitive data from logs
        $sensitiveFields = ['password', 'remember_token'];

        if ($oldValues) {
            foreach ($sensitiveFields as $field) {
                if (isset($oldValues[$field])) {
                    $oldValues[$field] = '[HIDDEN]';
                }
            }
        }

        if ($newValues) {
            foreach ($sensitiveFields as $field) {
                if (isset($newValues[$field])) {
                    $newValues[$field] = '[HIDDEN]';
                }
            }
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'module' => self::getModuleName($model),
            'record_id' => $model->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
        ]);
    }

    /**
     * Get the module name from the model
     */
    protected static function getModuleName($model): string
    {
        $className = class_basename($model);
        return strtolower($className) . 's'; // users, products
    }
}
