<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class TagList implements SubCommand {

    public function execute(CommandSender $sender, array $args): void {
        $groups = PCX::getInstance()->getFormatManager()->getAllTags();

        if (empty($groups)) {
            $sender->sendMessage(MessageManager::get("tag.error.no_tags"));
            return;
        }

        $sender->sendMessage("§6☰ Tags List");

        foreach ($groups as $tag => $data) {
            $prefix = $data["prefix"] ?? "";
            $linked = $data["link"] ?? "§c✖ not linked";
            $sender->sendMessage(" §8- §e$tag §7(group: §b´" . $linked . "´§7)");
        }
    }
}