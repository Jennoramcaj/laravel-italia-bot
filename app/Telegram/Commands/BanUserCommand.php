<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Telegram\Enums\CommandEnum;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\User\User;

final class BanUserCommand extends Command
{
    protected string $command = CommandEnum::Ban->value;

    protected ?string $description = 'Consente di bannare un utente';

    public function handle(Nutgram $bot): void
    {
        // The command must be called in reply to a user

        $reply = $bot->message()?->reply_to_message;

        if ($reply === null) {
            return;
        }

        // Can't ban the BOT itself

        /** @var User $targetUser */
        $targetUser = $reply->from;

        if ($targetUser->id === $bot->userId()) {
            return;
        }

        // Can't ban admins

        /** @var int $chatId */
        $chatId = $bot->chatId();
        $targetMember = $bot->getChatMember($chatId, $targetUser->id);

        if ($targetMember === null) {
            return;
        }

        if (in_array($targetMember->status, ['administrator', 'creator'], true)) {
            $bot->sendMessage('❌ Non posso bannare un admin.');

            return;
        }

        // 6. BAN

        // TODO
        // $bot->banChatMember($chatId, $targetUser->id);

        $bot->sendMessage("🔨L'utente @$targetUser->username ci ha lasciato. Rimarrà sempre nei nostri cuori. 🪽");
    }
}
