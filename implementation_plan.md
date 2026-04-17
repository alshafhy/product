# Surgical POS Fixes Plan

Perform 3 specific fixes as requested by the user to address sidebar positioning, language switcher UI, and badge redundancy.

## Proposed Changes

### [Component] Styling
#### [MODIFY] [app.scss](file:///home/moustafa/App/product/resources/sass/app.scss)
- Replace the existing sidebar and main content positioning rules with the comprehensive rules provided by the user.
- Map the user's `.main-wrapper` to the actual `.app-content` or `.main-content` used in the project, OR update the layout to use `.main-wrapper` if permissible (sticking to CSS change for now as requested).
- Use `html[dir="rtl"]` as requested by the user to ensure standard-compliant RTL detection.

### [Component] Navigation
#### [MODIFY] [navbar.blade.php](file:///home/moustafa/App/product/resources/views/panels/navbar.blade.php)
- Replace the current language switcher dropdown with the new version provided by the user.
- Update flags to use Saudi Arabia (🇸🇦) for Arabic and UK (🇬🇧) for English.
- Remove standalone RTL/LTR badges from the topbar (outside the dropdown).
- Ensure all labels use `__('layout.key')` as per regional requirements.

## Open Questions

- **File Paths:** You mentioned `_responsive.scss` and `header.blade.php`, but I found the code in `app.scss` and `navbar.blade.php`. Should I proceed with editing the existing files, or do you want me to create the new files and update the imports/includes?
- **Class Names:** Your CSS uses `.main-wrapper` but the project currently uses `.app-content`. Should I update the CSS to target `.app-content`, or should I update the layout to use `.main-wrapper`?

## Verification Plan

### Automated Tests
- Run `npm run build` to ensure no regressions in asset compilation.

### Manual Verification
- Visual inspection of the sidebar position in RTL mode.
- Visual inspection of the language switcher button and dropdown options.
- Verify that no standalone RTL badges are visible.
