<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;

class SystemComponent extends AppBaseModel
{
    use SoftDeletes, NodeTrait;

    public $table = 'system_components';

    public $fillable = [
        'comp_name',
        'comp_ar_label',
        'description',
        '_lft',
        '_rgt',
        'comp_type',
        'route_name',
        'prefix',
        'parent_id',
        'icon_name',
        'icon_class',
        'sort_order',
        'is_active',
        'permission_name',
        'config',
    ];

    protected $casts = [
        'id'         => 'integer',
        '_lft'       => 'integer',
        '_rgt'       => 'integer',
        'comp_type'  => 'integer',
        'parent_id'  => 'integer',
        'sort_order' => 'integer',
        'is_active'  => 'boolean',
        'config'     => 'array',
        'deleted_at' => 'datetime',
    ];

    public function scopeActive($query): mixed
    {
        return $query->where('is_active', true);
    }

    public function hasAccess(User $user): bool
    {
        if (empty($this->permission_name)) {
            return true;
        }

        return $user->hasPermissionTo($this->permission_name);
    }

    public function getRouteUrl(): string
    {
        if (empty($this->route_name)) {
            return '#';
        }

        return Route::has($this->route_name) ? route($this->route_name) : '#';
    }

    public function isCurrentRoute(): bool
    {
        if (empty($this->route_name)) {
            return false;
        }

        return request()->routeIs($this->route_name . '*');
    }

    public function parentData(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SystemComponent::class, 'parent_id', 'id');
    }

    public function getConfig(): array
    {
        return is_array($this->config) ? $this->config : [];
    }

    public function getReportTemplateName(): string
    {
        return $this->getConfig()['reportTemplate'] ?? '';
    }

    public function getReportButtonsArray(): array
    {
        return $this->getConfig()['reportButtons'] ?? [];
    }

    public function getReportNumber(): string
    {
        return (string) ($this->id + 10000);
    }

    public function scopeGetSystemName($query, int $id): ?string
    {
        $node = self::find($id);

        if (!$node) {
            return null;
        }

        return self::whereAncestorOf($node)
            ->where('comp_type', 1)
            ->value('route_name');
    }
}
