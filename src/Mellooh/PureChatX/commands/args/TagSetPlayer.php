<?php

namespace Mellooh\PureChatX\commands\args;

use Mellooh\libs\CommandoX\argument\StringArgument;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\PCX;
use Mellooh\PureChatX\utils\MessageManager;
use Mellooh\PurePermsX\PPX;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class TagSetPlayer extends BaseSubCommand {

    public function __construct(Plugin $plugin) {
        parent::__construct($plugin, "set", "Assign a tag to a player");
    }

    protected function configure(): void {
        $this->registerArgument(0, new StringArgument("player"));
        $this->registerArgument(1, new StringArgument("tag"));
    }

    public function onRun(CommandContext $context): void {
        /** @var PCX $pcx */
        $pcx = $context->getPlugin();
        $sender = $context->getSender();

        $playerName = (string)$context->getArg("player");
        $tag        = strtolower((string)$context->getArg("tag"));

        $fm = $pcx->getFormatManager();
        $linkedGroup = $fm->getTagLink($tag);

        if (!$linkedGroup) {
            $sender->sendMessage(MessageManager::get("tag.error.not_linked"));
            return;
        }

        PPX::getInstance()->getUserManager()->setGroup($playerName, $linkedGroup);

        $player = Server::getInstance()->getPlayerExact($playerName);
        if ($player !== null) {
            PPX::getInstance()->getPermissionHandler()->applyPermissions($player);

            $prefix = $fm->getPrefix($tag);
            $player->setNameTag($prefix . $player->getDisplayName());
        }

        $sender->sendMessage(
            MessageManager::get("tag.success.set", [
                "player" => $playerName,
                "tag"    => $tag,
            ])
        );
    }
}