# Feature Map

> Auto-maintained index of every user-facing feature and the code path that implements it. Updated alongside the code — not after the fact.

This repository is a data catalog with no application source files: Infinite OS (external, https://github.com/goinfinite/os) fetches these manifests via Git and executes the install steps on the user's instance. GitHub Actions workflows and manifest `installCmdSteps` do contain executable commands. Feature paths below therefore run from manifest entry point to the external executor.

## Catalog Item Installation

A user installs an application, framework, or stack from the Infinite OS marketplace. Infinite OS reads the item's manifest and runs its install steps on the instance.

**Flow:**

1. `app/wordpress/manifest.json` — example entry point: declares `name`, `slugs`, `type`, `services`, `dataFields`, `mappings`, `installCmdSteps` (every catalog item under `app/`, `framework/`, `stack/` follows this shape)
2. `app/wordpress/manifest.json` (`services`) — Infinite OS installs dependencies first, e.g. `php:8.2`, `mariadb`
3. `app/wordpress/manifest.json` (`dataFields`) — the installer prompts for these values; `%name%` placeholders in commands are replaced at install time
4. `app/wordpress/assets/htaccess.txt` — copied into the installation via `%marketplaceCatalogItemAssetsDirPath%` during step 5
5. `app/wordpress/manifest.json` (`installCmdSteps`) — shell commands run in order (WP-CLI download, `os db create`, `wp core install`)
6. `app/wordpress/manifest.json` (`mappings`) — route `/` is mapped to the `php` service so the item is reachable
7. `app/wordpress/manifest.json` (`uninstallCmdSteps`, `uninstallFileNames`) — reverse path: drop database user/database, remove installed files

Branch: some items skip the `services` property and create their service inside `installCmdSteps` with `os services create-installable` or `os services create-custom` — see `app/n8n/manifest.yml` and `app/pocketbase/manifest.yml`.

---

## Catalog Browsing (Avatars and Screenshots)

A user browses the marketplace in the Infinite OS interface and sees each item's icon and screenshots.

**Flow:**

1. `app/adminer/manifest.yml` — `avatarUrl` and `screenshotUrls` point to `https://goinfinite.github.io/os-marketplace/...` (GitHub Pages serves this repository)
2. `app/adminer/assets/avatar.png` — the icon file, path mirrors the URL within the repo
3. `app/adminer/assets/screenshot-0.png` … `screenshot-4.png` — screenshot files, same rule
4. Infinite OS marketplace UI (external) renders the fetched images

---

## Catalog Version Selection

A user (or Infinite OS itself) pins the marketplace to a repository version compatible with the installed OS release.

**Flow:**

1. `README.md` — documents the branch-as-release scheme: branch `v0`/`v1`/`v2` maps to Infinite OS versions and a supported `manifestVersion`
2. `git clone --single-branch --branch v2 ...` — the user or system fetches only that branch (documented in `README.md`)
3. `app/adminer/manifest.yml` (`manifestVersion`) — each manifest carries its own version stamp, checked by the consuming OS

---

## Marketplace CI Install Testing

A nightly job installs every eligible catalog item into a fresh Infinite OS container and reports pass/fail per item.

**Flow:**

1. `.github/workflows/ci-marketplace.yml` (`discover` job) — parses every manifest under `app/`, `framework/`, `stack/`, resolves `dataFields` values, builds a test matrix, skips items without slugs or missing secrets
2. `.github/workflows/ci-marketplace.yml` (`test` job) — pulls the latest `goinfinite/os` Docker image, starts a container, runs `os mktplace install -s <slug>` inside it
3. `app/<item>/manifest.(json|yml|yaml)` — the manifest under test; its `installCmdSteps` execute inside the container
4. `.github/workflows/ci-marketplace.yml` (`report` job) — downloads result artifacts, writes a PASS/FAIL/SKIP table to the job summary, fails the run on any install failure

---

## Contributing a Catalog Item

A contributor adds or changes a marketplace item and gets it merged.

**Flow:**

1. `README.md` — manifest schema reference: required properties, `dataFields` shape, system placeholder list
2. `app/<item>/manifest.(json|yml|yaml)` — the new manifest, following the pattern of existing items (e.g. `app/wordpress/manifest.json`)
3. `app/<item>/assets/avatar.jpg` — required icon; screenshots optional (guidance in `README.md`, Avatars section)
4. `CONTRIBUTING.md` — process rules: open an issue first, sign the FLA, Conventional Commits, maintainer approval
5. `.github/workflows/ci-marketplace.yml` — validates the item installs on the next nightly run

---
