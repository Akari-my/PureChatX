<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\command\CommandSender;

class Reload implements SubCommand{

    public function execute(CommandSender $sender, array $args): void {

        PCX::getInstance()->getServer()->getPluginManager()->disablePlugin(PCX::getInstance());
        PCX::getInstance()->getServer()->getPluginManager()->enablePlugin(PCX::getInstance());
        PCX::getInstance()->reloadConfig();
        PCX::getInstance()->getFormatManager()->reload();

        $sender->sendMessage(MessageManager::get("reload.success"));
    }
}