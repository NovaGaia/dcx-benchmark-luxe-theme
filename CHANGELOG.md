# dcx-benchmark-luxe-theme

## 1.2.0

### Minor Changes

-   fac7d68: add icon style to style.css

## 1.1.8

### Patch Changes

-   f845e10: add sticky template part CSS class for FSE themes

## 1.1.7

### Patch Changes

-   5b27c4f: fix(ci): add missing inc/ directory to release ZIP

    The `inc/core-block-styles.php` file is required by `functions.php` but was not included in the release ZIP, causing a fatal error on production installs.

## 1.1.6

### Patch Changes

-   dc05c67: feat(header): add site tagline and style navigation block

    -   Add site tagline below site title in header
    -   Add padding and border-radius to navigation block
    -   Add hover colors to nav items

## 1.1.5

### Patch Changes

-   9e818c6: Ajoute inc/core-block-styles.php : enregistrement des block styles dcx-box-\* et génération CSS dynamique depuis theme.json via wp_get_global_settings() — plus aucune liste de slugs hardcodée.

## 1.1.4

### Patch Changes

-   7f7cb80: Déplace les block styles nav-header et nav-internal, le JS nav-internal et les CSS associés vers le plugin dcx-benchmark-luxe-plugin.

## 1.1.3

### Patch Changes

-   56cc1a0: Add CSS variables for nav item styling (padding, border, bg, color) on nav-header and nav-internal styles; mobile toggle pill inherits same variables

## 1.1.2

### Patch Changes

-   458aa92: Use CSS variables for nav-internal mobile toggle pill styling

## 1.1.1

### Patch Changes

-   2aa58e1: Add nav-internal and nav-header block styles with accessible mobile toggle; reorganize border settings and update layout/spacing values

## 1.1.0

### Minor Changes

-   0136ccf: feat(theme): add border radius presets (XS to Full) in theme.json

## 1.0.4

### Patch Changes

-   b131a5b: Ajout des styles par défaut du bouton (border-radius 22px, fond accent-2, ombre) et nettoyage de l'indentation dans theme.json

## 1.0.3

### Patch Changes

-   a90feff: Replace spacing presets with a Tailwind-inspired rem scale (12 steps, slugs 10–120).

## 1.0.2

### Patch Changes

-   da61237: Restrict color customization in editor: disable custom color picker and custom gradients in blocks. Add duotone preset (Contrast → Accent 1). Add Prettier config aligned with WordPress coding standards (tabs).

## 1.0.1

### Patch Changes

-   741a56c: Test du workflow de release automatique via Changesets et GitHub Actions.

## 1.0.0

### Initial release
