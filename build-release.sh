#!/usr/bin/env bash
set -euo pipefail
ROOT="$(cd "$(dirname "$0")" && pwd)"
VERSION="$(awk -F': ' '/^Version:/{print $2; exit}' "$ROOT/style.css" | tr -d '\r')"
if [[ -z "$VERSION" ]]; then echo "Version missing" >&2; exit 1; fi
OUT="${ROOT}/../wp-dev-theme-${VERSION}.zip"
rm -f "$OUT"
cd "$ROOT/.."
zip -qr "$OUT" "$(basename "$ROOT")" -x "*/.git/*" "*/.github/*" "*/build-release.sh" "*/.DS_Store"
echo "$OUT"
