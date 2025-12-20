<?php

namespace Mellooh\PureChatX\commands;

use Mellooh\libs\CommandoX\BaseCommand;
use Mellooh\libs\CommandoX\BaseSubCommand;
use Mellooh\libs\CommandoX\CommandContext;
use Mellooh\PureChatX\commands\args\Reload;
use Mellooh\PureChatX\commands\args\TagCreate;
use Mellooh\PureChatX\commands\args\TagDelete;
use Mellooh\PureChatX\commands\args\TagHelp;
use Mellooh\PureChatX\commands\args\TagLink;
use Mellooh\PureChatX\commands\args\TagList;
use Mellooh\PureChatX\commands\args\TagSetFormat;
use Mellooh\PureChatX\commands\args\TagSetPlayer;
use Mellooh\PureChatX\commands\args\TagSetPrefix;
use Mellooh\PureChatX\commands\args\TagSetSuffix;
use Mellooh\PureChatX\PCX;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class PCXCommand extends BaseCommand implements PluginOwned {

    public function __construct(PCX $plugin, string $name = "pcx") {
        parent::__construct($plugin, $name, "Manage chat tags", []);
    }

    protected function configure(): void {
        $this->setPermission("pcx.use");
        $this->setPermissionMessageCustom("§cYou don’t have permission to use this.");

        $this->registerSubCommand(new TagCreate($this->plugin));
        $this->registerSubCommand(new TagDelete($this->plugin));
        $this->registerSubCommand(new TagSetPrefix($this->plugin));
        $this->registerSubCommand(new TagSetSuffix($this->plugin));
        $this->registerSubCommand(new TagSetFormat($this->plugin));
        $this->registerSubCommand(new TagLink($this->plugin));
        $this->registerSubCommand(new TagSetPlayer($this->plugin));
        $this->registerSubCommand(new TagList($this->plugin));
        $this->registerSubCommand(new Reload($this->plugin));
        $this->registerSubCommand(new TagHelp($this->plugin));
    }

    public function onRun(CommandContext $context): void {
        $sub = $this->subCommandsByName["help"] ?? null;
        if ($sub instanceof BaseSubCommand) {
            $sub->onRun(new CommandContext(
                $this->plugin,
                $context->getSender(),
                $context->getLabel(),
                [],
                $this,
                $sub
            ));
        } else {
            $context->getSender()->sendMessage("§eUse: §f/pcx help");
        }
    }

    public function getOwningPlugin(): Plugin {
        return $this->plugin;
    }
}