<?php

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Builder;
 
trait HandlesJoinSearching
{
        protected function applyJoinSearch(
    Builder $query,
    string $modelClass,
    string $searchColumn,
    string $searchTerm
    ): Builder {
        $parts = explode('.', $searchColumn);

        // No relationship, do plain WHERE
        if (count($parts) < 2) {
            return $query->where($searchColumn, 'like', "%$searchTerm%");
        }

        $field = array_pop($parts);
        $model = app($modelClass);
        $mainTable = $model->getTable();
        $alias = $mainTable;
        $current = $model;

        foreach ($parts as $i => $relationName) {
            $relation = $current->$relationName();
            $related = $relation->getRelated();
            $relatedTable = $related->getTable();
            $joinAlias = "{$relatedTable}_{$i}";

            $foreignKey = method_exists($relation, 'getQualifiedForeignKeyName')
                ? $relation->getQualifiedForeignKeyName()
                : $relation->getQualifiedParentKeyName();

            $ownerKey = method_exists($relation, 'getQualifiedOwnerKeyName')
                ? $relation->getQualifiedOwnerKeyName()
                : $relation->getQualifiedKeyName();

            // Replace table name in foreign/owner key with alias
            $foreignKey = str_replace($relation->getParent()->getTable(), $alias, $foreignKey);
            $ownerKey   = str_replace($relatedTable, $joinAlias, $ownerKey);

            $query->leftJoin("{$relatedTable} as {$joinAlias}", $foreignKey, '=', $ownerKey);

            $current = $related;
            $alias = $joinAlias;
        }

        return $query
            ->where("{$alias}.{$field}", 'like', "%$searchTerm%")
            ->select("{$mainTable}.*");
    }


}
