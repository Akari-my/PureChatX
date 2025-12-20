<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class TagList extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "list", "List all tags");
    }

    protected function configure(): void {
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $groups = $pcx->getFormatManager()->getAllTags();

        if (empty($groups)) {
            $sender->sendMessage(MessageManager::get("tag.error.no_tags"));
            return;
        }

        $sender->sendMessage("§6☰ Tags List");

        foreach ($groups as $tag => $data) {
            $prefix = $data["prefix"] ?? "";
            $linked = $data["link"] ?? "§c✖ not linked";
            $sender->sendMessage(" §8- §e{$tag} §7(group: §b´{$linked}´§7)");
        }
    }
}