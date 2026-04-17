<?php

namespace App\Services;

use App\Models\SystemComponent;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function getMenuForUser(?User $user): Collection
    {
        if (!$user) {
            return collect();
        }

        return Cache::remember("menu_user_{$user->id}", 3600, function () use ($user) {
            $roots = SystemComponent::with('children')
                ->whereIsRoot()
                ->active()
                ->orderBy('sort_order')
                ->get();

            return $this->filterTree($roots, $user);
        });
    }

    public function clearMenuCache(int $userId): void
    {
        Cache::forget("menu_user_{$userId}");
    }

    public function clearAllMenuCache(): void
    {
        try {
            Cache::tags(['menu'])->flush();
        } catch (\BadMethodCallException) {
            // Driver does not support tags — iterate known users
            \App\Models\User::query()->select('id')->each(
                fn(User $u) => $this->clearMenuCache($u->id)
            );
        }
    }

    private function filterTree(Collection $nodes, User $user): Collection
    {
        return $nodes
            ->filter(fn(SystemComponent $node) => $node->hasAccess($user))
            ->map(function (SystemComponent $node) use ($user) {
                if ($node->children->isNotEmpty()) {
                    $visibleChildren = $this->filterTree(
                        $node->children->sortBy('sort_order'),
                        $user
                    );

                    // Drop groups with no visible children
                    if ($visibleChildren->isEmpty() && empty($node->route_name)) {
                        return null;
                    }

                    $node->setRelation('children', $visibleChildren);
                }

                return $node;
            })
            ->filter()
            ->values();
    }
}
