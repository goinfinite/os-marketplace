# CHANGELOG

## v2

```
# 2026/03/26

fix: update n8n manifest to use Node 24 LTS and pin version to 2.13.4
  - Node version: 20 → 24 (LTS)
  - n8n version: @latest → @2.13.4 (pinned)
  - Fixes compatibility issue with n8n@latest requiring Node >= 22.16

# 2025/12/10

feat: add umami

# 2025/09/04

feat: add privatebin
fix: add wait for php to be up and running

# 2025/08/27

chore: update manifests ids

# 2025/08/22

feat: add adminer

# 2025/07/15

feat: add uptime kuma

# 2025/06/11

feat: add phpMyAdmin
docs: add CHANGELOG.md
```

## v1

```
# 2025/05/29

fix: add missing metadata and fix minor issues

# 2025/05/28

feat: add mautic

# 2025/05/23

feat: add passbolt

# 2025/05/09

docs: add `LICENSE.md`
feat: add `CONTRIBUTING.md`

# 2025/05/08

fix: images path now uses github pages

# 2025/05/07

fix: use `mappings` prop on n8n manifest

# 2025/04/22

fix: moodle must use `nobody` user on install and cron
fix: set webhook url on n8n

# 2025/04/11

chore: moodle enhancements
feat: add `defaultValue` for Moodle data fields
feat: add vscode cspell dictionary
feat: add `.gitignore`

# 2025/04/07

feat: add moodle

# 2025/03/25

feat: add n8n

# 2025/03/24

fix: set memory_limit on wp clis

# 2025/02 to 2025/03

docs: add `Avatars` to `README`
docs: add info about the execution order of `services` and `installCmdSteps` on manifest
style: lint README markdown

# 2024/12

fix: increase php memory on wp core install
fix: rename public and private key data fields on install
fix: return quote on echo command
fix: add missing plugin allow on openmage
fix: add quote to steps placeholders
fix: use marketplaceCatalogItemAssetsDirPath for wp htaccess
fix: add quote to steps placeholders
fix: bump drupal php to 8.3
```

## v0

```
# 2024/10 to 2024/12

refactor: add type to system data fields and improve some topics titles
chore: add README
feat: add LAMP stack
feat: add Laravel framework
feat: add WordPress
feat: add OpenMage
feat: add OpenCart
feat: add Joomla
feat: add Drupal
feat: add Adobe Commerce
```
