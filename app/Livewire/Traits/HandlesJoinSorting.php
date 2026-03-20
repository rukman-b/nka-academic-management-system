<?php

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HandlesJoinSorting
{
    protected function applyJoinSort(Builder $query, string $modelClass, string $sortColumn, string $sortDirection): Builder
    {
        if (!Str::contains($sortColumn, '.')) {
            return $query->orderBy($sortColumn, $sortDirection);
        }

        $model = app($modelClass);
        $mainTable = $model->getTable();

        $parts = explode('.', $sortColumn);
        $field = array_pop($parts); // last part is the column
        $relations = $parts;

        $currentModel = $model;
        $previousTable = $mainTable;

        foreach ($relations as $relation) {
            if (!method_exists($currentModel, $relation)) {
                throw new \Exception("Relation '{$relation}' not defined on model " . get_class($currentModel));
            }

            $relationInstance = $currentModel->$relation();
            $relatedTable = $relationInstance->getRelated()->getTable();

            $foreignKey = method_exists($relationInstance, 'getQualifiedForeignKeyName')
                ? $relationInstance->getQualifiedForeignKeyName()
                : $relationInstance->getQualifiedParentKeyName();

            $ownerKey = method_exists($relationInstance, 'getQualifiedOwnerKeyName')
                ? $relationInstance->getQualifiedOwnerKeyName()
                : $relationInstance->getQualifiedKeyName();

            // Avoid rejoining the same table multiple times
            if (! $this->isJoined($query, $relatedTable)) {
                $query->join($relatedTable, $foreignKey, '=', $ownerKey);
            }

            $currentModel = $relationInstance->getRelated();
            $previousTable = $relatedTable;
        }

        return $query->orderBy("{$previousTable}.{$field}", $sortDirection)->select("{$mainTable}.*");
    }

    protected function isJoined(Builder $query, string $table): bool
    {
        $joins = $query->getQuery()->joins;

        if (!is_array($joins)) {
            return false;
        }

        foreach ($joins as $join) {
            if ($join->table === $table) {
                return true;
            }
        }

        return false;
    }
}
