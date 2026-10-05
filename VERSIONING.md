# wp-dev-theme versioning

This theme uses a simple three-part release sequence:

- `1.0.0` — first production release
- `1.0.1` through `1.0.9` — incremental patch releases
- after `1.0.9`, the next release is `1.1.0`
- `1.1.1` through `1.1.9`, then `1.2.0`, and so on
- a larger redesign or breaking change may use the next major version, e.g. `2.0.0`

Every GitHub release tag must match the `Version:` value in `style.css`, prefixed with `v` (for example `v1.0.0`).

The release workflow builds a WordPress-ready ZIP whose top-level directory is `wp-dev-theme` and attaches it to the GitHub Release. The theme's WordPress updater checks the latest stable GitHub Release.
