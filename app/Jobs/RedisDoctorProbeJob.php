<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class RedisDoctorProbeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
        // Do NOT force a queue here.
        // Let the dispatcher decide the queue via ->onQueue(...)
    }


    public function handle(): void
    {
        // Proof that the job really executed:
        Cache::store('redis')->put("redis_doctor:queue:result:{$this->token}", 'processed', 300);
    }
}
