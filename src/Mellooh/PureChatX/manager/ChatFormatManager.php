<?php

namespace Mellooh\PureChatX\manager;

use Mellooh\PureChatX\PCX;
use pocketmine\utils\Config;

class ChatFormatManager {

    private Config $config;
    private string $defaultFormat;
    private array $groups;

    public function __construct(PCX $plugin) {
        $this->config = $plugin->getConfig();
        $this->defaultFormat = $this->config->get("default-format", "{name} » {message}");
        $this->groups = $this->config->get("groups", []);
    }

    public function getFormat(string $tag): string {
        return $this->groups[$tag]["format"] ?? $this->defaultFormat;
    }

    public function getPrefix(string $tag): string {
        return $this->groups[$tag]["prefix"] ?? "";
    }

    public function getSuffix(string $tag): string {
        return $this->groups[$tag]["suffix"] ?? "";
    }

    public function getGroupByLink(string $purePermsGroup): ?string {
        foreach ($this->groups as $tag => $options) {
            if (isset($options["link"]) && strtolower($options["link"]) === strtolower($purePermsGroup)) {
                return $tag;
            }
        }
        return null;
    }

    public function createTag(string $tag): void {
        $tag = strtolower($tag);
        if (!isset($this->groups[$tag])) {
            $this->groups[$tag] = [
                "prefix" => "",
                "suffix" => "",
                "format" => $this->defaultFormat,
                "link" => ""
            ];
            $this->save();
        }
    }

    public function deleteTag(string $tag): void {
        $tag = strtolower($tag);
        if (isset($this->groups[$tag])) {
            unset($this->groups[$tag]);
            $this->save();
        }
    }

    public function setPrefix(string $tag, string $prefix): void {
        $this->groups[$tag]["prefix"] = $prefix;
        $this->save();
    }

    public function setSuffix(string $tag, string $suffix): void {
        $this->groups[$tag]["suffix"] = $suffix;
        $this->save();
    }

    public function setFormat(string $tag, string $format): void {
        $this->groups[$tag]["format"] = $format;
        $this->save();
    }

    public function linkPurePerms(string $tag, string $group): void {
        $this->groups[$tag]["link"] = $group;
        $this->save();
    }

    private function save(): void {
        $this->config->set("groups", $this->groups);
        $this->config->save();
    }

    public function reload(): void {
        $this->config->reload();
        $this->groups = $this->config->get("groups", []);
        $this->defaultFormat = $this->config->get("default-format", "{name} » {message}");
    }

    public function getTagLink(string $tag): ?string {
        return $this->groups[$tag]["link"] ?? null;
    }

    public function getAllTags(): array {
        return $this->groups;
    }

    public function getNameTagFormat(string $tag): string {
        return $this->groups[$tag]["nametag"] ?? $this->config->get("default-nametag", "{prefix}{name}{suffix}");
    }
}