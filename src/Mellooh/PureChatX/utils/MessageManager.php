<?php

namespace Mellooh\PureChatX\utils;

use Mellooh\PureChatX\PCX;
use pocketmine\utils\Config;

class MessageManager{

    private static array $messages = [];

    public static function init(PCX $plugin): void {
        $plugin->saveResource("messages.yml");
        $cfg = new Config($plugin->getDataFolder() . "messages.yml", Config::YAML);
        self::$messages = $cfg->getAll();
    }

    public static function get(string $path, array $replacements = []): string {
        $segments = explode(".", $path);
        $msg = self::$messages;

        foreach ($segments as $segment) {
            if (!isset($msg[$segment])) return "§cMessage '$path' not found.";
            $msg = $msg[$segment];
        }

        if (is_array($msg)) return "§cInvalid message at '$path'";

        foreach ($replacements as $key => $value) {
            $msg = str_replace("{" . $key . "}", (string)$value, $msg);
        }

        return (self::$messages["prefix"] ?? "§7[PCX] ") . $msg;
    }
}