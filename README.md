# literarybohemian-plugin

Companion WordPress plugin for the `literarybohemian` site and theme.

This plugin is a site-specific legacy codebase. It is not intended to be a reusable general-purpose plugin. Its job is to hold content-model and site-behavior logic that should persist independently of the active theme, while continuing to work alongside the `literarybohemian` theme.

## Overview

The plugin currently owns:

- custom post type registration for core site content
- menu location registration used by the theme
- archive-query adjustments for selected taxonomies
- the `/destination-unknown/` random redirect flow
- small admin customizations for editors
- a few site integrations with Advanced Custom Fields and A-Z Listing

The plugin intentionally keeps the implementation in a single file:

- `literarybohemian-functions.php`

## Requirements And Assumptions

- WordPress
- the `literarybohemian` theme
- Advanced Custom Fields for the relationship-field workflow used by author bios
- A-Z Listing if the author index page is still powered by that plugin

The plugin can still load without ACF active, but some ACF-specific behavior becomes a no-op.

## What The Plugin Registers

### Menu Locations

The plugin registers the following menu locations:

- `menu-0`: Footer Primary
- `menu-1`: Primary Menu
- `menu-2`: Secondary Menu
- `menu-3`: Tertiary Menu
- `menu-4`: Social Channels

### Custom Post Types

The plugin registers these post types:

- `poetry` with archive slug `poetry`
- `postcard_prose` with archive slug `postcard-prose`
- `travel_notes` with archive slug `travel-notes`
- `visual_poetry` with archive slug `visual-poetry`
- `bio` with single-item slug `bio`
- `book_reviews` with archive slug `book-reviews`
- `logbook` with archive slug `article`
- `interviews` with archive slug `interviews`

There is also a disabled `issue_introductions` block left in the file for historical reference. It is not active.

## Frontend Behavior

### Asset Loading

The plugin currently enqueues Adobe Fonts only.

The theme owns its own JavaScript bundle, including `global-min.js`. The plugin should not enqueue theme JS/CSS bundles unless there is a very specific, documented reason. This avoids duplicate asset loading and keeps theme responsibilities inside the theme.

### Archive Query Behavior

The plugin adjusts the main frontend query for selected archives:

- tag archives include `post`, `postcard_prose`, `poetry`, and `travel_notes`
- category archives include `post`, `poetry`, `postcard_prose`, `travel_notes`, and `logbook`

These query changes are intentionally scoped to the frontend main query. They should not affect:

- wp-admin screens
- REST requests
- widgets
- navigation menu queries
- secondary loops

If you change archive behavior, preserve the existing tag/category intent unless there is a confirmed production bug.

### Destination Unknown Redirect

The plugin registers a rewrite endpoint for:

- `/destination-unknown/`

When requested, the plugin chooses one random published post from:

- `poetry`
- `postcard_prose`

It then redirects to that entry. If no eligible post exists, it falls back to the site homepage.

Because this depends on rewrites, permalink rules must be refreshed after first install or after rewrite-related changes.

## Admin And Editorial Behavior

The plugin also:

- removes the native WordPress Custom Fields meta box through ACF for faster admin screens
- adds an `Author` column to the Poetry, Postcard Prose, and Travel Notes admin lists using the `name` post meta value
- removes the default `comments` and `author` columns from standard post list tables
- disables default styling from the A-Z Listing plugin

## Advanced Custom Fields Integration

The plugin includes a bidirectional relationship updater for the ACF field named:

- `related_posts`

This is used for author-bio relationship maintenance. When the field is updated on one post, the reciprocal relationship is written back to the related post.

This code is legacy and intentionally conservative. If you touch it:

- avoid infinite loops
- preserve existing field names and keys
- test with real editorial data before deploying

## Installation

1. Place the plugin in `wp-content/plugins/literarybohemian-plugin`.
2. Activate it in WordPress.
3. Ensure the `literarybohemian` theme is installed and active.
4. Resave permalinks in Settings > Permalinks after first activation, or after changing CPT or rewrite logic.

## Deployment Checklist

Use this when deploying plugin changes to staging or production:

1. Deploy the updated plugin file.
2. If rewrites changed, resave permalinks.
3. Confirm key archives still behave correctly:
   - a tag archive
   - a category archive
   - `/destination-unknown/`
4. Confirm at least one item still loads correctly for each active custom post type.
5. Confirm menu locations remain registered in the theme.

## Maintenance Notes

- Treat this as a production plugin with legacy constraints.
- Prefer low-risk fixes and narrowly scoped refactors.
- Do not move theme-owned asset loading into the plugin.
- Keep `pre_get_posts` callbacks tightly scoped to the intended frontend main query.
- Preserve CPT slugs unless a content migration is planned.
- Do not deactivate this plugin casually in production. It registers content types and menu locations the site depends on.

## Local Validation

There is no automated test suite in this repository at the time of writing. At minimum, run:

```bash
php -l literarybohemian-functions.php
```

For functional changes, do a browser smoke test in WordPress covering:

- one tag archive
- one category archive
- `/destination-unknown/`
- one admin edit screen for a custom post type

## Repository Layout

```text
literarybohemian-plugin/
├── literarybohemian-functions.php
└── README.md
```

## Future Work

Reasonable follow-up improvements, if handled carefully:

- move repeated CPT registration into shared helpers without changing slugs or supports
- add activation/deactivation hooks for rewrite flushing
- split the single plugin file into logical modules once there is a clear maintenance need
- remove temporary theme-side compatibility shims after the relevant plugin deployment has been verified everywhere
