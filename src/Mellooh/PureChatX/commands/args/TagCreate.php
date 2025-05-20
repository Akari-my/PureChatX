<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class TagCreate implements SubCommand {

    public function execute(CommandSender $sender, array $args): void {
        if (!isset($args[0])) {
            $sender->sendMessage(MessageManager::get("tag.usage.create"));
            return;
        }

        $name = strtolower($args[0]);
        PCX::getInstance()->getFormatManager()->createTag($name);
        $sender->sendMessage(MessageManager::get("tag.success.create", ["name" => $name]));
    }

}