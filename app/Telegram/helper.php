<?php

use SergiX44\Nutgram\Telegram\Types\User\User;

if (! function_exists('buildUserMention')) {
    function buildUserMention(User $user): string
    {
        $firstName = \Illuminate\Support\Str::replace('.', '', $user->first_name);
        return "[{$firstName}](tg://user?id={$user->id})";
    }
}
