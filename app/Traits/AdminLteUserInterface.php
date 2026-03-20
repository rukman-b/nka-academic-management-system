<?php

namespace App\Traits;

use App\Constants\Guards;
use App\Constants\Roles;
use App\Services\Auth\GuardResolver;

trait AdminLteUserInterface
{
    /**
     * Return the user's primary Spatie role KEY (e.g. 'sysadmin'), or null.
     */
    public function getPrimaryRoleKey(): ?string
    {
        if (! method_exists($this, 'getRoleNames')) {
            return null;
        }

        $role = $this->getRoleNames()->first();

        return is_string($role) && $role !== '' ? $role : null;
    }

    /**
     * Return a human-readable label for the user context.
     * - role label if roles exist
     * - otherwise guard label (Student/Employer/Web/etc.)
     */
    public function getPrimaryRoleLabel(): string
    {
        $roleKey = $this->getPrimaryRoleKey();

        if ($roleKey) {
            return Roles::label($roleKey);
        }

        $guard = app(GuardResolver::class)->detect() ?? Guards::WEB;

        return Guards::label($guard);
    }

    public function adminlte_profile_url(): string
    {
        return route('profile');
    }

    public function adminlte_image(): string
    {
        return asset($this->getProfileImageUrlAttribute());
    }

    /**
     * AdminLTE "description" under the name in the user menu.
     */
    public function adminlte_desc(): string
    {
        return $this->getPrimaryRoleLabel();
    }

    public function adminlte_user()
    {
        return $this;
    }
}
