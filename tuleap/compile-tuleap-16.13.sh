#!/usr/bin/env nix-shell
#! nix-shell -i bash --pure

# Tested with nix 2.32.4 

# Specify version
git checkout 16.13

# Build
make composer
pnpm install
pnpm run build

