<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\PureChatX\commands\SubCommand;
use pocketmine\command\CommandSender;

class TagHelp implements SubCommand{

    public function execute(CommandSender $sender, array $args): void {
        $sender->sendMessage("§6§l☰ PureChatX Help §r§7(PCX)");
        $sender->sendMessage("§e/pcx create <name>§7 - Create a new chat tag");
        $sender->sendMessage("§e/pcx delete <name>§7 - Delete an existing tag");
        $sender->sendMessage("§e/pcx setprefix <tag> <prefix>§7 - Set tag prefix");
        $sender->sendMessage("§e/pcx setsuffix <tag> <suffix>§7 - Set tag suffix");
        $sender->sendMessage("§e/pcx setformat <tag> <format>§7 - Set chat format");
        $sender->sendMessage("§e/pcx link <tag> <purepermsx-group>§7 - Link to a PurePermsX group");
        $sender->sendMessage("§e/pcx set <player> <tag>§7 - Assign a tag and sync group");
        $sender->sendMessage("§e/pcx list§7 - View all registered tags");
    }
}