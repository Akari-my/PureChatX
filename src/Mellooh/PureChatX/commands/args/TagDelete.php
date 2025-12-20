<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\argument\StringArgument;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class TagDelete extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "delete", "Delete a tag");
    }

    protected function configure(): void {
        $this->registerArgument(0, new StringArgument("name"));
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $name = strtolower((string)$context->getArg("name"));
        $pcx->getFormatManager()->deleteTag($name);

        $sender->sendMessage(MessageManager::get("tag.success.delete", ["name" => $name]));
    }
}