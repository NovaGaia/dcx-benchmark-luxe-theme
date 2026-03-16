# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Methodologie APEX

Appliquer systematiquement la methode **APEX** pour chaque tache de developpement :

| Phase       | Action                                                                    |
| ----------- | ------------------------------------------------------------------------- |
| **A**nalyze | Lire/explorer le code concerne, comprendre le contexte et les contraintes |
| **P**lan    | Presenter le plan d'action et attendre validation avant d'implementer     |
| **E**xecute | Implementer la solution uniquement apres accord                           |
| e**X**amine | Tester/valider le resultat, verifier qu'il n'y a pas de regression        |

### Regles

- Ne jamais coder sans avoir d'abord analyse et planifie
- Toujours attendre la validation du plan avant d'executer
- Toujours verifier le resultat apres implementation

### Commandes de verification (eXamine)

```bash
npm run build      # Verifier que la minification CSS se produit sans erreur
```

## Build Commands

```bash
npm install        # Install dependencies (requires Node >=20.10.0, NPM >=10.2.3)
npm run build      # Minify style.css → style.min.css (run after any CSS change)
npm run watch      # Watch mode: auto-minify on CSS changes during development
```

**CSS workflow:** Always run `npm run build` after editing `style.css`. The frontend loads `style.min.css` in production (when `SCRIPT_DEBUG` is disabled) and `style.css` in development.

## Versioning & Releases

Versioning via **Changesets** + **GitHub Actions** with automatic updates via **Plugin Update Checker (PUC)**.

### Workflow
1. `npm run changeset` — créer un changeset (choisir patch/minor/major + description)
2. Commit + push sur `main`
3. GitHub Actions crée/met à jour une PR "Version Packages"
4. Merger la PR → bump automatique de version dans `package.json` et `style.css`
5. GitHub Actions crée une release avec un ZIP du thème
6. WordPress détecte la mise à jour via PUC et propose l'installation

### Sources de vérité de la version
- `package.json` — mis à jour par Changesets
- `style.css` header (`Version:`) — synchronisé par `scripts/sync-version.mjs`

### ZIP de release
Contient : `style.css`, `style.min.css`, `functions.php`, `theme.json`, `templates/`, `parts/`, `patterns/`, `assets/`, `styles/`, `screenshot.png`, `composer.json`, `vendor/`

## Workflow Git

- **Ne jamais commit sans demande explicite de l'utilisateur**
- Toujours utiliser le skill `git-commit` pour créer des commits (jamais `git commit` directement)
- Toujours mettre à jour le README avant de commit et push

## Architecture

This is a **WordPress Full Site Editing (FSE) theme** — block-native, no PHP templates beyond `functions.php`.

### Core Files

- `functions.php` — Registers post formats, block styles, pattern categories, block bindings, and enqueues styles
- `theme.json` — Single source of truth for the design system: colors, spacing, typography, layout widths, and template parts
- `style.css` / `style.min.css` — Minimal CSS; most visual styling is defined in `theme.json`

### Content Structure

- `templates/` — 8 block HTML templates (single, archive, home, 404, etc.)
- `parts/` — 7 reusable template parts (3 header variants, 3 footer variants, sidebar)
- `patterns/` — 98 PHP files defining pre-built block patterns for the editor

### Design System (theme.json)

- **8 global style variations** under `styles/` — time-themed palettes (Morning, Noon, Dusk, Evening, etc.)
- **Typography presets** in `styles/typography/` (7 variants)
- **Section presets** in `styles/sections/` (5 variants)
- **Block-level styles** in `styles/blocks/` (4 variants)
- **Color palettes** in `styles/colors/` (8 variants)
- **Font families:** Manrope, Fira Code, Raleway (loaded from `assets/fonts/` as WOFF2)

### Block Patterns

Each file in `patterns/` is a PHP file with metadata in comments (Title, Slug, Categories) followed by block markup. The two registered pattern categories are:

- `dcx_benchmark_luxe_theme_page` — full page layouts
- `dcx_benchmark_luxe_theme_post-format` — post format-specific layouts

### Custom Block Features (functions.php)

- Post format support for all 9 WordPress formats (aside, audio, chat, gallery, image, link, quote, status, video)
- Custom block style `checkmark-list` registered for `core/list`
- Block binding source `dcx-benchmark-luxe-theme/format` for dynamic post format display

### No JavaScript

There is no custom JS. No JS build process exists.
