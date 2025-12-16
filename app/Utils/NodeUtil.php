<?php

namespace App\Utils;

use App\Models\SystemComponent;

class NodeUtil
{

    // private function buildNodesFromObjects()
    // {
    //     SystemComponent::query()->delete();
    //     $PrmObjects = PrmObject::GetAllObjectsByType(1);
    //     foreach ($PrmObjects as $PrmObject) {
    //         $parent = $this->addNewNode($PrmObject, null);
    //         $this->buildSubNodesFromParentObjects($PrmObject->object_id, $parent);
    //     }
    // }

    // private function buildSubNodesFromParentObjects($parent_id, $parent)
    // {
    //     $PrmObjects = PrmObject::GetAllObjectsByParent($parent_id);
    //     if ($PrmObjects) {
    //         foreach ($PrmObjects as $PrmObject) {
    //             $subNode = $this->addNewNode($PrmObject, $parent);
    //             $this->buildSubNodesFromParentObjects($PrmObject->object_id, $subNode);
    //         }
    //     }
    // }

    public static function addNewNode($sysComp, $parent = null)
    {
        $attributes = [
            'comp_name' => $sysComp->comp_name,
            'comp_type' => $sysComp->comp_type,
            'route_name' => $sysComp->route_name,
            'parent_id' => $sysComp->parent_id,
            'prefix' => $sysComp->prefix,
            'description' => $sysComp->description,
            'config' => $sysComp->config,
            // 'parent_id' => ($parent) ? $parent : null,
            'comp_ar_label' => $sysComp->comp_ar_label,
        ];

        return SystemComponent::create($attributes, $parent);
    }

    // private function createNode($attributes, $parent = null)
    // {
    //     return SystemComponent::create($attributes, $parent);
    // }

    private function traverse($categories, $prefix = '-')
    {
        foreach ($categories as $category) {
            echo "<br>" . $prefix . ' ' . $category->name;
            $this->traverse($category->children, $prefix . '-');
        }
    }
}
