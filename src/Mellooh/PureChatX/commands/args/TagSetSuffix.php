<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\argument\RawTextArgument;
use Mellooh\libs\CommandoX\argument\StringArgument;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class TagSetSuffix extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "setsuffix", "Set tag suffix");
    }

    protected function configure(): void {
        $this->registerArgument(0, new StringArgument("tag"));
        $this->registerArgument(1, new RawTextArgument("suffix"));
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $tag    = strtolower((string)$context->getArg("tag"));
        $suffix = (string)$context->getArg("suffix");

        $pcx->getFormatManager()->setSuffix($tag, $suffix);

        $sender->sendMessage(
            MessageManager::get("tag.success.setsuffix", [
                "tag"    => $tag,
                "suffix" => $suffix,
            ])
        );
    }
}