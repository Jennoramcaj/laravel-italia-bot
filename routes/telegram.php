<?php

/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Commands\BanUserCommand;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', function (Nutgram $bot) {
    logger((string) $bot->userId());
    $bot->sendMessage('Hello, world!');
})->description('The start command!');

$bot->registerCommand(BanUserCommand::class);
