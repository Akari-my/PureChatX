<?php

namespace Mellooh\PureChatX\listener;

use Mellooh\PureChatX\PCX;
use Mellooh\PurePermsX\PPX;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;

class ChatListener implements Listener{

    private PCX $plugin;

    public function __construct(PCX $plugin){
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = strtolower($player->getName());
        $ppx = PPX::getInstance();
        if($ppx === null) return;

        $group = $ppx->getUserManager()->getGroup($name) ?? "guest";
        $formatManager = $this->plugin->getFormatManager();
        $tagGroup = $formatManager->getGroupByLink($group) ?? "guest";
        $prefix = $formatManager->getPrefix($tagGroup);

        $player->setNameTag($prefix . $player->getDisplayName());
    }

    public function onChat(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $name = strtolower($player->getName());

        $ppx = PPX::getInstance();
        if($ppx === null) return;

        $group = $ppx->getUserManager()->getGroup($name) ?? "guest";
        $fm = $this->plugin->getFormatManager();
        $tagGroup = $fm->getGroupByLink($group) ?? "guest";

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