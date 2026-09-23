# CHANGELOG

## v2
```

# 2026-09-22

fix: download Moodle from a digest-verified commit pin on the GitHub mirror
  - download.moodle.org 302-redirects to packaging.moodle.org; Cloudflare there serves a "Moodle challenge" 403 to datacenter IPs, so CI wget hit exit 8 again (run 35708392217)
  - The install now fetches commit 344232c15336c71b80f9aca8359ce0e0a9f3d116 from the official moodle/moodle GitHub mirror — the same host CI already reaches for the marketplace clone. A commit cannot be retargeted, unlike a tag or the floating moodle-latest tarball.
  - The install verifies the archive's SHA-256 digest before extraction and aborts on mismatch
  - The archive extracts under a moodle-<commit>/ prefix; the tar step strips it into the expected moodle/ dir
  - estimatedSizeBytes now matches the measured 5.2 tree (432 MB), not the old 4.5 tarball

# 2026-09-21

fix: remove unsupported PHP imap module step from Mautic install
  - The OS supports no imap module for any PHP version; the step always failed
  - Composer now ignores the ext-imap platform requirement; Mautic treats imap as optional
  - The install creates var/cache and var/logs before mautic:install, which aborts silently without them

fix: switch Moodle download to the current stable branch 5.2
  - Legacy stable405 downloads fail from datacenter IPs; CI hit wget exit 8 daily
  - Moodle 5.x serves from public/; the install links the site root to that directory
  - PHP 8.3 meets the new minimum; installer flags and cron paths still apply

fix: bump Umami pnpm to 12.3.4 and cap build memory
  - Upstream engines.pnpm requires 12.3.4; pnpm 10.33 aborted with ERR_PNPM_UNSUPPORTED_ENGINE
  - The next build runs with a 2.5 GB V8 heap cap to fit the 4 GB container
  - The start script runs next through node directly; the OS strips exec bits after install

# 2026/09/17

docs: add feature map and per-directory context files
  - Creates docs/FEATURE-MAP.md tracing marketplace features through the code
  - Adds .context.md files for docs/, assets directories, and new apps
  - Updates drifted app context files against current manifests

docs: correct catalog and CI coverage descriptions
  - Nightly CI installs every eligible catalog item, not every item
  - Describes the repo as a data catalog whose workflows and installCmdSteps
    contain executable commands
  - Fixes the app/ item count to the 20 manifest-backed entries

chore: remove supabase placeholder directory
  - Held no manifest or assets, only context notes

docs: use extension-neutral manifest paths in feature map
  - Testing and contributing flows now reference manifest.(json|yml|yaml)

docs: make feature map manifest paths directory-neutral
  - CI testing and contributing flows cover app/, framework/, and stack/ items

docs: make feature map avatar path directory and extension neutral
  - Contributing flow now references avatar.(jpg|png) under any catalog root

# 2026/07/24

fix: enable PHP IMAP extension during Mautic install
  - Adds runtime php update-module for imap to resolve composer dependency error

fix: set utf8mb4 collation on Moodle database before install
  - Adds ALTER DATABASE to avoid charset mismatch during installation

refactor: extract CI test values to env vars and switch domain to goinfinite.dev
  - Moves hardcoded email, password, names, locale, and domain from inline
    Python strings to workflow-level environment variables
  - Switches PRIMARY_VHOST from goinfinite.local to goinfinite.dev for valid MX
    records, fixing passbolt GPG email validation

# 2026/07/23

fix: add services field to hermes-dashboard manifest
  - Declares hermes-agent as a dependency service

# 2026/06/08

feat: add open-webui
  - New app manifest for Open WebUI (issue #111)
  - Uses mise python@3.11 for Python runtime
  - Uses os services create-custom for service management
  - pip-autoremove cleans orphaned dependencies on uninstall

# 2026/04/18

feat: add hermes-dashboard

# 2026/04/08

feat: add pocketbase
  - New app manifest for PocketBase (issue #61)
  - Uses os services create-custom for standalone binary
  - Includes dataFields for admin email and password
  - Superuser created during installation

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
