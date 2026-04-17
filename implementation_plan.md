# Automated RTL Conversion Plan (Vite + PostCSS)

Reproduce the automatic RTL flipping behavior of `laravel-mix-rtl` using `postcss-rtlcss` within the Vite build pipeline. This will ensure all components, margins, paddings, and directional properties are handled automatically without manual overrides.

## User Review Required

> [!IMPORTANT]
> This change will move from **manual** RTL overrides (current state) to **automated** translation. I will be installing a new dependency (`postcss-rtlcss`) and configuring PostCSS to handle the flip.

- **Mode**: I propose using the `combined` mode for `postcss-rtlcss`. This generates both LTR and RTL rules in the same CSS file, allowing for instantaneous switching via the `dir="rtl"` attribute on the `<html>` tag (already implemented in your header).
- **Cleanup**: I will remove the manual "Nuclear" fixes from `overrides.scss` as they will be handled automatically by the plugin.

## Proposed Changes

### [Component] Build System
#### [MODIFY] [package.json](file:///home/moustafa/App/product/package.json)
- Add `postcss-rtlcss` to `devDependencies`.

#### [NEW] [postcss.config.cjs](file:///home/moustafa/App/product/postcss.config.cjs)
- Create a configuration file to enable `postcss-rtlcss` and `autoprefixer`.

### [Component] Styling
#### [MODIFY] [overrides.scss](file:///home/moustafa/App/product/resources/scss/overrides.scss)
- Remove manual sidebar and content positioning rules.
- Retain only non-directional overrides (like dark mode file input fixes).

#### [MODIFY] [styles.blade.php](file:///home/moustafa/App/product/resources/views/panels/styles.blade.php)
- Simplify asset loading by removing the conditional `@vite` for `-rtl` files, as the main files will now contain both LTR and RTL styles.

## Open Questions

- **Plugin Mode**: Are you comfortable with the increased CSS file size of `combined` mode in exchange for seamless LTR/RTL switching without page reloads?
- **Manual RTL Files**: Should I keep `custom-rtl.scss` as a final layer of manual tweaks, or do you want to move entirely to the automated system?

## Verification Plan

### Automated Tests
- Run `docker compose run --rm cashpos-node npm install -D postcss-rtlcss`
- Run `docker compose run --rm cashpos-node npm run build`
- Check Vite output for generated CSS rules with `[dir="rtl"]` selectors.

### Manual Verification
- Use the language switcher to flip from Arabic to English.
- Verify that **all** components (not just the sidebar) flip their orientation (e.g. check margins on cards, positions of icons in form inputs).
