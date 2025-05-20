<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class TagSetSuffix implements SubCommand{

    public function execute(CommandSender $sender, array $args): void {
        if (count($args) < 2) {
            $sender->sendMessage(MessageManager::get("tag.usage.setsuffix"));
            return;
        }

        $tag = strtolower(array_shift($args));
        $suffix = implode(" ", $args);

        PCX::getInstance()->getFormatManager()->setSuffix($tag, $suffix);
        $sender->sendMessage(MessageManager::get("tag.success.setsuffix", [
            "tag" => $tag,
            "suffix" => $suffix
        ]));
    }
}