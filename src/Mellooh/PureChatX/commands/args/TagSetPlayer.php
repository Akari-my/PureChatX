<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use Mellooh\PurePermsX\PPX;
use pocketmine\command\CommandSender;
use pocketmine\Server;

class TagSetPlayer implements SubCommand {

    public function execute(CommandSender $sender, array $args): void {
        if (count($args) < 2) {
            $sender->sendMessage(MessageManager::get("tag.usage.set"));
            return;
        }

        $playerName = $args[0];
        $tag = strtolower($args[1]);

        $fm = PCX::getInstance()->getFormatManager();
        $linkedGroup = $fm->getTagLink($tag);

        if (!$linkedGroup) {
            $sender->sendMessage(MessageManager::get("tag.error.not_linked"));
            return;
        }

        PPX::getInstance()->getUserManager()->setGroup($playerName, $linkedGroup);

        $player = Server::getInstance()->getPlayerExact($playerName);
        if ($player !== null) {
            PPX::getInstance()->getPermissionHandler()->applyPermissions($player);

            $prefix = $fm->getPrefix($tag);
            $player->setNameTag($prefix . $player->getDisplayName());
        }

        $sender->sendMessage(MessageManager::get("tag.success.set", [
            "player" => $playerName,
            "tag" => $tag
        ]));
    }
}