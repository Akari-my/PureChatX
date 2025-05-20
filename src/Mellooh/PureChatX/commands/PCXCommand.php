<?php

namespace Mellooh\PureChatX\commands;

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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;

class PCXCommand extends Command implements PluginOwned{

    private array $commands = [];
    private PCX $plugin;

    public function __construct(PCX $plugin) {
        parent::__construct("pcx", "Manage chat tags", "/pcx help");
        $this->plugin = $plugin;
        $this->setPermission("pcx.use");

        $this->commands = [
            "create"     => new TagCreate(),
            "delete"     => new TagDelete(),
            "setprefix"  => new TagSetPrefix(),
            "setsuffix"  => new TagSetSuffix(),
            "setformat"  => new TagSetFormat(),
            "link"       => new TagLink(),
            "help" => new TagHelp(),
            "set" => new TagSetPlayer(),
            "list" => new TagList(),
            "reload" => new Reload(),
        ];
    }

    public function execute(CommandSender $sender, string $label, array $args): void {
        if (!$sender->hasPermission("pcx.use")) {
            $sender->sendMessage("§cYou don’t have permission to use this.");
            return;
        }

        if (!isset($args[0]) || strtolower($args[0]) === "help") {
            $this->commands["help"]->execute($sender, []);
            return;
        }

        $sub = strtolower(array_shift($args));

        if (isset($this->commands[$sub])) {
            $this->commands[$sub]->execute($sender, $args);
        } else {
            $sender->sendMessage("§cUnknown subcommand. Use §e/pcx help");
        }
    }

    public function getOwningPlugin(): Plugin {
        return $this->plugin;
    }
}