<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class TagSetPrefix implements SubCommand{

    public function execute(CommandSender $sender, array $args): void {
        if (count($args) < 2) {
            $sender->sendMessage(MessageManager::get("tag.usage.setprefix"));
            return;
        }

        $tag = strtolower(array_shift($args));
        $prefix = implode(" ", $args);

        PCX::getInstance()->getFormatManager()->setPrefix($tag, $prefix);
        $sender->sendMessage(MessageManager::get("tag.success.setprefix", [
            "tag" => $tag,
            "prefix" => $prefix
        ]));
    }
}