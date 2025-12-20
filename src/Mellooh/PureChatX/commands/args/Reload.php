<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class Reload extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "reload", "Reload PureChatX configs");
    }

    protected function configure(): void {
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();

        $server = $pcx->getServer();
        $pm = $server->getPluginManager();

        $pm->disablePlugin($pcx);
        $pm->enablePlugin($pcx);
        $pcx->reloadConfig();
        $pcx->getFormatManager()->reload();

        $context->getSender()->sendMessage(MessageManager::get("reload.success"));
    }
}