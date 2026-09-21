#!/bin/bash

command -v mise >/dev/null 2>&1 || {
    echo "ERROR: mise not found in PATH - Umami requires mise for runtime management" >&2
    exit 1
}
cd install_dir && exec mise x node@24 -- node node_modules/next/dist/bin/next start
