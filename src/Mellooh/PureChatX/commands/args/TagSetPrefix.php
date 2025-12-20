<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\argument\RawTextArgument;
use Mellooh\libs\CommandoX\argument\StringArgument;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class TagSetPrefix extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "setprefix", "Set tag prefix");
    }

    protected function configure(): void {
        $this->registerArgument(0, new StringArgument("tag"));
        $this->registerArgument(1, new RawTextArgument("prefix"));
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $tag    = strtolower((string)$context->getArg("tag"));
        $prefix = (string)$context->getArg("prefix");

        $pcx->getFormatManager()->setPrefix($tag, $prefix);

        $sender->sendMessage(
            MessageManager::get("tag.success.setprefix", [
                "tag"    => $tag,
                "prefix" => $prefix,
            ])
        );
    }
}