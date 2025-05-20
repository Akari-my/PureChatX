<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class TagLink implements SubCommand{

    public function execute(CommandSender $sender, array $args): void {
        if (count($args) < 2) {
            $sender->sendMessage(MessageManager::get("tag.usage.link"));
            return;
        }

        [$tag, $group] = $args;

        PCX::getInstance()->getFormatManager()->linkPurePerms($tag, $group);
        $sender->sendMessage(MessageManager::get("tag.success.link", [
            "tag" => $tag,
            "group" => $group
        ]));
    }
}