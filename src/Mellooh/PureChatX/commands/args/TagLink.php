<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\argument\StringArgument;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\Plugin;

class TagLink extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "link", "Link a tag to a PurePermsX group");
    }

    protected function configure(): void {
        $this->registerArgument(0, new StringArgument("tag"));
        $this->registerArgument(1, new StringArgument("group"));
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $tag   = (string)$context->getArg("tag");
        $group = (string)$context->getArg("group");

        $pcx->getFormatManager()->linkPurePerms($tag, $group);

        $sender->sendMessage(
            MessageManager::get("tag.success.link", [
                "tag"   => $tag,
                "group" => $group,
            ])
        );
    }
}