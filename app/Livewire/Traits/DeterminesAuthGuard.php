<?php

namespace App\Livewire\Traits;

trait DeterminesAuthGuard
{
    
    /**
     * Get the guard based on the first segment of the current request URL.
     */
    protected function getDeterminedGuard(): string
    {
        return request()->segment(1) ?? 'web';
    }
    
    // protected function getPasswordBroker(string $guard): string
    // {
    //     return config("nka.auth.password_brokers.$guard", config('nka.default_password_broker', 'users'));
    // }

    protected function getPasswordBroker(string $guard): string
    {
        $provider = config("auth.guards.{$guard}.provider");

        if (!is_string($provider)) {
            return config('auth.defaults.passwords', 'users');
        }

        $brokers = config('auth.passwords', []);

        foreach ($brokers as $brokerName => $brokerConfig) {
            if (isset($brokerConfig['provider']) && $brokerConfig['provider'] === $provider) {
                return $brokerName;
            }
        }

        return config('auth.defaults.passwords', 'users');
    }



}
