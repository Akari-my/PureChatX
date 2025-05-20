<?php

namespace Mellooh\PureChatX\listener;

use Mellooh\PureChatX\PCX;
use Mellooh\PurePermsX\PPX;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;

class ChatListener implements Listener{

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = strtolower($player->getName());
        $group = PPX::getInstance()->getUserManager()->getGroup($name);
        $formatManager = PCX::getInstance()->getFormatManager();
        $tagGroup = $formatManager->getGroupByLink($group) ?? "default";
        $prefix = $formatManager->getPrefix($tagGroup);

        $player->setNameTag($prefix . $player->getDisplayName());
        PPX::getInstance()->getPermissionHandler()->applyPermissions($player);
    }

    public function onChat(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $name = strtolower($player->getName());

        $group = PPX::getInstance()->getUserManager()->getGroup($name);
        $fm = PCX::getInstance()->getFormatManager();
        $tagGroup = $fm->getGroupByLink($group) ?? "default";

        $prefix = $fm->getPrefix($tagGroup);
        $suffix = $fm->getSuffix($tagGroup);
        $format = $fm->getFormat($tagGroup);
        $nameTagFormat = $fm->getNameTagFormat($tagGroup);

        $message = $event->getMessage();

        $formattedChat = str_replace(
            ["{prefix}", "{name}", "{suffix}", "{group}", "{message}"],
            [$prefix, $player->getDisplayName(), $suffix, $group, $message],
            $format
        );

        $event->setFormatter(new LegacyRawChatFormatter($formattedChat, ""));

        $formattedNameTag = str_replace(
            ["{prefix}", "{name}", "{suffix}", "{group}"],
            [$prefix, $player->getDisplayName(), $suffix, $group],
            $nameTagFormat
        );

        $player->setNameTag($formattedNameTag);
    }
}