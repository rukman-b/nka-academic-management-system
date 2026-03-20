<?php

namespace App\Livewire\Traits;

use Illuminate\Database\QueryException;

trait HandlesDeleteExceptions
{
    public function safeDelete(callable $callback, string $successMessage = 'Deleted successfully.', ?string $foreignKeyMessage = null): void
    {
        try {
            $callback();

            session()->flash('success', $successMessage);

        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                session()->flash('error', $foreignKeyMessage ?? 'Cannot delete this item because it is referenced by other records.');
            } else {
                session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
            }
        }
    }
}
