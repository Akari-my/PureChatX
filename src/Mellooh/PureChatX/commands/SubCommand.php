<?php

namespace Mellooh\PureChatX\commands;

use pocketmine\command\CommandSender;

interface SubCommand{
    public function execute(CommandSender $sender, array $args): void;
}