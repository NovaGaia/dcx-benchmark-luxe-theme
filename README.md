# dcx-benchmark-luxe-theme

Thème WordPress Full Site Editing (FSE) pour DCX Benchmark Luxe.

- **WordPress :** 6.9+
- **PHP :** 7.2+

## Installation

```bash
npm install
composer install
```

## Développement

```bash
npm run watch   # Mode développement (minification CSS auto)
npm run build   # Build production (style.css → style.min.css)
```

Un fichier `.prettierrc` est configuré à la racine pour respecter les standards de codage WordPress (indentation par tabs).

## Versioning & Releases

Versioning via [Changesets](https://github.com/changesets/changesets). Les releases GitHub sont créées automatiquement par GitHub Actions au push sur `main`.

```bash
npm run changeset   # Créer un changeset (patch / minor / major)
```

Après merge de la PR "Version Packages" générée par Actions :
- La version est bumped dans `package.json` et `style.css`
- Une release GitHub est créée avec le ZIP du thème
- WordPress détecte la mise à jour via Plugin Update Checker

## Design System — Espacements

Échelle inspirée de Tailwind CSS, en `rem` (base 16px) :

| Slug | Nom | Valeur | px |
|------|-----|--------|----|
| `10` | 2XS | `0.25rem` | 4px |
| `20` | XS | `0.5rem` | 8px |
| `30` | S | `1rem` | 16px |
| `40` | M | `1.5rem` | 24px |
| `50` | L | `2rem` | 32px |
| `60` | XL | `3rem` | 48px |
| `70` | 2XL | `4rem` | 64px |
| `80` | 3XL | `6rem` | 96px |
| `90` | 4XL | `8rem` | 128px |
| `100` | 5XL | `12rem` | 192px |
| `110` | 6XL | `16rem` | 256px |
| `120` | 7XL | `24rem` | 384px |

## Architecture

Thème FSE block-native — pas de templates PHP. Toute la configuration visuelle est dans `theme.json`.

| Répertoire | Contenu |
|------------|---------|
| `templates/` | Templates de pages (single, archive, home, 404…) |
| `parts/` | Parties réutilisables (header ×3, footer ×3, sidebar) |
| `patterns/` | 98 patterns de blocs |
| `styles/` | Variations de styles globaux (couleurs, typo, sections) |
| `assets/` | Polices WOFF2 et images |
