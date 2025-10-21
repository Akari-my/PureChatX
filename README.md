# 💬 PureChatX

> 🔧 A modern, flexible chat formatting and nametag system for PocketMine-MP — fully integrated with [PurePermsX](https://github.com/Akari-my/PurePermsX)

**PureChatX** is a other version of the original PureChat. completely written from scratch, bringing customizable chat formats, dynamic nameTags, and group-based formatting for PocketMine-MP.

---

## ✨ Features

- 🔗 Full integration with PurePermsX
- 🎨 Fully customizable chat format per group
- 🏷️ NameTag formatting with placeholders
- 📁 Configurable via `config.yml` & `messages.yml`
- 📥 Group-based formatting + linking to permissions
- 💬 Supports multiple placeholders (`{name}`, `{prefix}`, `{message}`, etc.)

---

## ⚙️ Configs Files

`config.yml`:
```yaml
default-format: "{prefix}§l{name}§r{suffix} » {message}"
default-nametag: "{prefix}{name}{suffix}"

groups:
  guest:
    prefix: "§7[Guest] "
    suffix: ""
    format: '{prefix}§l{name}§r{suffix} » §7{message}'
    link: "guest"
    nametag: "§7{name}"
```

`messages.yml`:
```yaml
prefix: "§7[§6PCX§7] "

reload:
  success: "Configuration reloaded successfully."

tag:
  usage:
    create: "§cUsage: /pcx create <name>"
    delete: "§cUsage: /pcx delete <name>"
    link: "§cUsage: /pcx link <tag> <pureperms-group>"
    set: "§c§cUsage: /pcx set <player> <tag>"
    setformat: "§cUsage: /pcx setformat <tag> <format>"
    setprefix: "§cUsage: /tag setprefix <tag> <prefix>"
    setsuffix: "§cUsage: /pcx setsuffix <tag> <suffix>"

  success:
    create: "§7Tag §6{name}§7 created."
    delete: "§7Tag §6{name}§a successfully deleted."
    link: "§7Tag §6{tag}§a linked to group §6{group}§7."
    set: "§7Player §6{player}§a has been assigned to tag §6{tag}."
    setprefix: "§7Prefix for §6{tag}§a set to: §r{prefix}"
    setsuffix: "§7Suffix for §6{tag}§a set to: §r{suffix}"
    setformat: "§7Format for §6{tag}§a set to:\n§r{format}"

  error:
    not_linked: "§cThat tag is not linked to a PurePermsX group."
    no_tags: "§cNo tags found."
```

---

## 🔧 Commands

| Command | Description |
|--------|-------------|
| `/pcx reload` | Reload plugin configuration |
| `/pcx create <tag>` | Create a tag |
| `/pcx delete <tag>` | Delete a tag |
| `/pcx set <player> <tag>` | Assign a tag (and group) to a player |
| `/pcx setprefix <tag> <prefix>` | Set prefix for a tag |
| `/pcx setsuffix <tag> <suffix>` | Set suffix for a tag |
| `/pcx setformat <tag> <format>` | Set chat format |
| `/pcx link <tag> <group>` | Link tag to a PurePermsX group |
| `/pcx list` | List all registered tags |

---

## 🧠 Placeholders

Use these in both format & nametags:

- `{prefix}`
- `{suffix}`
- `{name}`
- `{group}`
- `{message}`

## 📁 Directory Structure

```
src/
└── Mellooh/
    └── PureChatX/
        ├── commands/
        ├── args/             # Subcommand handlers
        ├── manager/          # Format & config handling
        ├── utils/            # MessageManager for configurable messages
        └── PCX.php           # Main plugin class
```

---

## 🧑‍💻 Developer

- Plugin by [**Mellooh**](https://github.com/Akari-my)
---

## 📄 License

This project is open-source and licensed under the [MIT License](./LICENSE)

---

## 🔗 Related

- [PurePermsX](https://github.com/Akari-my/PurePermsX) – Group/permission manager for modern PocketMine servers

## ⭐ Contribute

- Found a bug? Open an issue
- Want to help? Pull Requests are welcome
- Love the plugin? Leave a ⭐ on GitHub!

