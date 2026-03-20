<?php

use App\Livewire\Admin\Modules\ModuleManager;
use Illuminate\Support\Facades\Route;

//////////////////cold and warm run/////////////////

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

Route::get('/bench', function () {
    // Params:
    //   q=...          -> affects the cache key / search term
    //   delay=...      -> optional ms to simulate extra work (e.g., delay=200)
    //   cache=rw|none|prime|read
    //
    //   rw    : default; read-through + write-through (Cache::remember)
    //   none  : BYPASS cache entirely (no read, no write)  <-- use for "cold baseline"
    //   prime : compute and WRITE to cache, then return
    //   read  : READ only; if missing, return 404 (so you don't accidentally warm)

    $q       = request('q', 'data');
    $delayMs = (int) request('delay', 0);
    $mode    = request('cache', 'rw'); // rw|none|prime|read

    $cache   = Cache::tags(['bench']);
    $key     = 'bench:v1:' . md5($q);

    $heavyWork = function () use ($q, $delayMs) {
        if ($delayMs > 0) {
            usleep($delayMs * 1000); // simulate extra CPU/IO
        }

        // ---- heavy-ish queries over your tables ----
        $totals = [
            'modules'    => DB::table('modules')->count(),
            'programmes' => DB::table('programmes')->count(),
        ];

        $byLevel = DB::table('modules')
            ->select('fheq_level_id', DB::raw('COUNT(*) AS c'))
            ->groupBy('fheq_level_id')
            ->orderBy('fheq_level_id')
            ->get();

        $topLecturers = DB::table('modules')
            ->select('lecturer_id', DB::raw('COUNT(*) AS c'))
            ->groupBy('lecturer_id')
            ->orderByDesc('c')
            ->limit(10)
            ->get();

        $searchSample = DB::table('modules')
            ->where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->orderBy('name')
            ->limit(100)
            ->get();

        return [
            'totals'           => $totals,
            'modules_by_level' => $byLevel,
            'top_lecturers'    => $topLecturers,
            'search_sample'    => $searchSample,
        ];
    };

    $served = 'none';
    $t0 = microtime(true);

    if ($mode === 'none') {
        // Cold baseline: never touch cache
        $data = $heavyWork();
        $served = 'bypass';
    } elseif ($mode === 'prime') {
        // Compute once and write to cache
        $data = $heavyWork();
        $cache->put($key, $data, now()->addMinutes(30));
        $served = 'prime';
    } elseif ($mode === 'read') {
        // Read-only: if not present, don't populate (helps catch accidental misses)
        $data = $cache->get($key);
        if (!$data) {
            return response()->json(['error' => 'MISS (prime first)'], 404);
        }
        $served = 'hit';
    } else { // 'rw' (default)
        $wasHit = $cache->has($key);
        $data = $cache->remember($key, now()->addMinutes(30), $heavyWork);
        $served = $wasHit ? 'hit' : 'miss_then_store';
    }

    $elapsedMs = (int) round((microtime(true) - $t0) * 1000);

    return response()->json([
        'served'     => $served,
        'elapsed_ms' => $elapsedMs,
        'key'        => $key,
        'mode'       => $mode,
        'data'       => $data,
    ]);
});

// Clear only this benchmark cache group
Route::get('/bench/clear', function () {
    Cache::tags(['bench'])->flush();
    return response()->json(['ok' => true, 'message' => 'bench cache cleared']);
});


////////////End of Cold and Warm////////////////////



Route::get('/notifications/mark-all-read', function () {
    auth()->user()?->unreadNotifications->markAsRead();
    return back()->with('status', 'All notifications marked as read.');
})->name('notifications.markAllRead');


Route::get('/test', function () {
    return 'Working!';
});



//Fallback route. This fallback route triggers even without the below routes as long as you 
//leave the errors files in the "resources/views/" with their expected blade names.
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

