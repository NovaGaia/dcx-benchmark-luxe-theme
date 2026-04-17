---
"dcx-benchmark-luxe-theme": patch
---

fix(ci): add missing inc/ directory to release ZIP

The `inc/core-block-styles.php` file is required by `functions.php` but was not included in the release ZIP, causing a fatal error on production installs.
