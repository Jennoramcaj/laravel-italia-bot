<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;

class BanUserCommand extends Command
{
    protected string $command = 'ban';

    protected ?string $description = 'Admins can ban users.';

    public function handle(Nutgram $bot): void
    {
        $administrators = $bot->getChatAdministrators($bot->chatId());
        $userIsAdmin = collect($administrators)->pluck('user.id')->contains($bot->userId());

        if (! $userIsAdmin) {
            return;
        }

        $userToBan = $bot->message()->reply_to_message->from->id;
        $bot->banChatMember($bot->chatId(), $userToBan);
    }
}
