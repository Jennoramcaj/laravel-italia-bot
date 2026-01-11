<?php

declare(strict_types=1);

use App\Telegram\Enums\CommandEnum;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Testing\FakeNutgram;

describe('when sending /start', function () {
    it('replies with a message', function () {
        /** @var FakeNutgram $bot */
        $bot = resolve(Nutgram::class);

        $bot->hearText(CommandEnum::Start->command())
            ->reply()
            ->assertReplyText('Hello, world!');
    });
});
