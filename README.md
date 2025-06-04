# LiteSpeed Cache Auto Excluder
A lightweight WordPress plugin that automatically adds exclusions for query strings and cookies on activation.

## 🔧 What It Does

On activation, this plugin automatically adds:

- `accessibility` to **Do Not Cache Query Strings** at LiteSpeed Cache > Cache > Excludes.
- `wp_accessibility` to **Do Not Cache Cookies** at LiteSpeed Cache > Cache > Excludes.

This helps ensure compatibility with frontend accessibility tools by avoiding cached versions when these parameters or cookies are present.

## ✅ Features

- Automatically inserts these exclusions
- Prevents duplicates
- Displays an admin success message after activation
- Safe and clean — no overwrite of existing settings

## 🧩 Requirements

- WordPress 5.0+
- LiteSpeed Cache plugin installed and active

## 📦 Installation

1. Upload the plugin to `/wp-content/plugins/litespeed-cache-auto-excluder`
2. Activate the plugin through the WordPress dashboard.
3. That's it! The exclusions will be automatically applied.

## 🧪 Example

Upon activation, you'll see an admin notice:

```
LiteSpeed Cache Auto Excluder:

Added query string exclusion: accessibility
Cookie wp_accessibility already exists.
```

## 🧼 Uninstallation

This plugin does not remove the exclusions on deactivation or deletion, to avoid breaking behavior-dependent functionality.
