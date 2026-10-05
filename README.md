# wp-dev-theme

Production personal portfolio theme for **Kiran Khadka — Full Stack Developer**.

## What is included

- Editorial, distinctive visual system
- Responsive mobile-first layout
- Right-side mobile navigation drawer with backdrop, Escape handling and scroll lock
- About, Experience, Expertise, Blog, Resume, Contact and Projects
- Native WordPress Projects custom post type
- Single Theme Options panel under **WP Dev Theme**
- Personal/entity SEO controls
- `Person`, `ProfilePage`, `WebSite`, `Article`, `CreativeWork` and `BreadcrumbList` JSON-LD where appropriate
- Open Graph and X/Twitter metadata
- Google/Bing verification fields
- WordPress core sitemap compatibility
- Lightweight vanilla JavaScript
- Reduced-motion support
- Mobile overflow hardening
- GitHub Releases update integration
- Optional forced theme auto-updates
- GitHub Actions PHP linting and release packaging
- No page builder, Bootstrap, Elementor or jQuery dependency

## GitHub release workflow

The intended repository is:

`https://github.com/therealkiranda/wp-dev-theme`

Create a GitHub Release by pushing a tag such as:

```text
v1.0.0
```

The workflow validates PHP, checks that the tag matches `style.css`, builds a WordPress-ready ZIP and attaches it to the release.

### Version sequence

`1.0.0` → `1.0.1` → … → `1.0.9` → `1.1.0` → `1.1.1` → …

See `VERSIONING.md`.

## Installing

Upload the generated `wp-dev-theme-X.Y.Z.zip` from **Appearance → Themes → Add New → Upload Theme** and activate it.

After activation, configure **WP Dev Theme** in the WordPress admin. Existing settings from the earlier Kiran theme are migrated when available.

## GitHub updater requirements

The updater reads the latest stable GitHub Release through the GitHub API. The release must include a `.zip` asset containing a top-level `wp-dev-theme/` directory. The repository URL can be changed under **WP Dev Theme → Updates**.

WordPress's normal theme update and automatic-update controls remain available as supported by the installed WordPress version.
