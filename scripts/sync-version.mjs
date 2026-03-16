/**
 * Synchronise la version de package.json vers le header de style.css.
 * Appelé automatiquement par `changeset version` via le script `version` de package.json.
 */

import { readFileSync, writeFileSync } from 'fs';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const root = resolve(__dirname, '..');

const pkg = JSON.parse(readFileSync(resolve(root, 'package.json'), 'utf8'));
const version = pkg.version;

const cssFile = resolve(root, 'style.css');
let css = readFileSync(cssFile, 'utf8');

// Met à jour le header "Version:"
css = css.replace(/(Version:\s+)[\d.]+/, `$1${version}`);

writeFileSync(cssFile, css, 'utf8');

console.log(`Version synchronisée : ${version}`);
