<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Clean up expired sessions every day at 2 AM
Schedule::command('session:cleanup')->daily()->at('02:00');

// Prune stale cache entries weekly
Schedule::command('cache:prune-stale-tags')->weekly();
