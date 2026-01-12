<?php

declare(strict_types=1);

use App\Telegram\Enums\CommandEnum;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Testing\FakeNutgram;

describe('when sending /ban', function () {
    it('bans the user', function () {
        /** @var FakeNutgram $bot */
        $bot = resolve(Nutgram::class);

        $chatId = 123;
        $bot->setCommonChat(Chat::make(id: $chatId, type: ChatType::PRIVATE));

        $bot->hearText(CommandEnum::Ban->command())
            ->reply()
            ->assertReplyText("L'ID della chat è $chatId");
    })->todo();
});
