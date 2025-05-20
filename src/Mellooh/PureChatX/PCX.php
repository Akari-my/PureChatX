<?php

namespace Mellooh\PureChatX;

use Mellooh\PureChatX\commands\PCXCommand;
use Mellooh\PureChatX\listener\ChatListener;
use Mellooh\PureChatX\manager\ChatFormatManager;
use Mellooh\PureChatX\utils\MessageManager;
use pocketmine\plugin\PluginBase;

class PCX extends PluginBase {


    private static PCX $instance;
    private ChatFormatManager $formatManager;

    public function onEnable(): void {
        self::$instance = $this;

        $this->saveDefaultConfig();

        if ($this->getServer()->getPluginManager()->getPlugin("PurePermsX") === null) {
            $this->getLogger()->error("§cPurePermsX is not installed or enabled!");
            $this->getLogger()->error("§cDisabling plugin...");
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        $this->formatManager = new ChatFormatManager($this);
        MessageManager::init($this);


        $this->getServer()->getCommandMap()->register("pcx", new PCXCommand($this));
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener(), $this);
        $this->getLogger()->info("§6
#  ______               _____ _           _  __   __
#  | ___ \             /  __ | |         | | \ \ / /
#  | |_/ _   _ _ __ ___| /  \| |__   __ _| |_ \ V / 
#  |  __| | | | '__/ _ | |   | '_ \ / _` | __|/   \ 
#  | |  | |_| | | |  __| \__/| | | | (_| | |_/ /^\ \
#  \_|   \__,_|_|  \___|\____|_| |_|\__,_|\__\/   \/
#                                                   
# Enabled    
# by Mellooh                               
");

    }

    public static function getInstance(): PCX {
        return self::$instance;
    }

    public function getFormatManager(): ChatFormatManager {
        return $this->formatManager;
    }
}