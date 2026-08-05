<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\UpdateType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Telegram\Types\User\User;
use SergiX44\Nutgram\Testing\FakeNutgram;
use Tests\Fixtures\Helpers\BotHelper;

/**
 * @throws JsonException
 */
function setupBotForCaptcha(FakeNutgram $bot, Chat $chat, User $newMember, string $oldStatus = 'left'): FakeNutgram
{
    return $bot->setCommonUser($newMember)
        ->setCommonChat($chat)
        ->hearUpdateType(UpdateType::CHAT_MEMBER, [
            'old_chat_member' => ['status' => $oldStatus, 'user' => $newMember->toArray()],
            'new_chat_member' => ['status' => 'member', 'user' => $newMember->toArray()],
        ])
        ->willReceive(result: true) // restrictChatMember response
        ->willReceive(result: [      // sendMessage response
            'message_id' => 1,
            'chat' => $chat->toArray(),
            'date' => time(),
            'text' => 'Captcha message',
        ]);
}

describe('when captcha is enabled', function (): void {
    beforeEach(function (): void {
        config()->set('bot.captcha.enabled', true);
    });

    describe('when a new user enters the group', function (): void {
        it('mutes the new user', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser)
                ->reply()
                ->assertCalled('restrictChatMember');
        });

        it('sends a captcha challenge message', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser)
                ->reply()
                ->assertCalled('sendMessage');
        });

        it('sends captcha with inline keyboard buttons', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser)
                ->reply()
                ->assertRaw(function (Request $request): bool {
                    $body = (string) $request->getBody();
                    $data = json_decode($body, true);

                    if (! is_array($data)) {
                        parse_str($body, $data);
                    }

                    $replyMarkup = $data['reply_markup'] ?? null;

                    if ($replyMarkup === null) {
                        return false;
                    }

                    $keyboard = is_string($replyMarkup) ? json_decode($replyMarkup, true) : $replyMarkup;
                    $buttons = $keyboard['inline_keyboard'] ?? [];

                    // Should have exactly 4 buttons in the first row
                    return isset($buttons[0]) && count($buttons[0]) === 4;
                }, index: 1);
        });

        it('also mutes a user rejoining after being kicked', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser, oldStatus: 'kicked')
                ->reply()
                ->assertCalled('restrictChatMember')
                ->assertCalled('sendMessage');
        });
    });

    describe('when a status change is not a new member joining', function (): void {
        it('does not send captcha when a member becomes an admin', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $user = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            $bot->setCommonUser($user)
                ->setCommonChat($chat)
                ->hearUpdateType(UpdateType::CHAT_MEMBER, [
                    'old_chat_member' => ['status' => 'member', 'user' => $user->toArray()],
                    'new_chat_member' => [
                        'status' => 'administrator',
                        'user' => $user->toArray(),
                        'can_be_edited' => false,
                        'is_anonymous' => false,
                        'can_manage_chat' => true,
                        'can_delete_messages' => true,
                        'can_manage_video_chats' => true,
                        'can_restrict_members' => true,
                        'can_promote_members' => false,
                        'can_change_info' => true,
                        'can_invite_users' => true,
                    ],
                ])
                ->reply()
                ->assertNoReply();
        });
    });
});

describe('when captcha is disabled', function (): void {
    beforeEach(function (): void {
        config()->set('bot.captcha.enabled', false);
    });

    describe('when a new user enters the group', function (): void {
        it('does not mute the new user', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser)
                ->reply()
                ->assertNoReply();
        });

        it('does not send a captcha challenge message', function (): void {
            /** @var FakeNutgram $bot */
            $bot = resolve(Nutgram::class);
            $newUser = BotHelper::makeUser();
            $chat = BotHelper::makeChat();

            setupBotForCaptcha($bot, $chat, $newUser)
                ->reply()
                ->assertCalled('sendMessage', 0);
        });
    });
});
