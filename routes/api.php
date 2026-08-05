<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/telegram/webhook', function (Nutgram $bot): void {
    $bot->run();
});
