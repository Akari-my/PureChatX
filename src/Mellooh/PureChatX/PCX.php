<?php

/**
 *      _____   _______   __
 *     |  __ \ / ____\ \ / /
 *     | |__) | |     \ V /
 *     |  ___/| |      > <
 *     | |    | |____ / . \
 *     |_|     \_____/_/ \_\
 *
 * This program is free plugin: you can redistribute it and/or modify
 * * it under the terms of the GNU Lesser General Public License as published by
 * * the Free plugin Foundation, either version 3 of the License, or
 * * (at your option) any later version.
 * *
 * * @author Mellooh
 * * @link https://github.com/Akari-my
 *
 */

namespace Mellooh\PureChatX;

use Mellooh\PureChatX\commands\PCXCommand;
use Mellooh\PureChatX\listener\ChatListener;
use Mellooh\PureChatX\manager\ChatFormatManager;
use Mellooh\PureChatX\utils\MessageManager;
use Mellooh\PureChatX\utils\UpdateChecker;
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
        UpdateChecker::check($this);


        $this->getServer()->getCommandMap()->register("purechatx", new PCXCommand($this, "pcx"));;
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener(), $this);
        $this->getLogger()->info("§6PureChatX enabled successfully !");

    }

    public static function getInstance(): PCX {
        return self::$instance;
    }

    public function getFormatManager(): ChatFormatManager {
        return $this->formatManager;
    }
}