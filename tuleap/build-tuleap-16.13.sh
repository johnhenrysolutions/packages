#!/usr/bin/env bash -e

# Get sources
git clone https://github.com/johnhenrysolutions/tuleap.git
cp compile-tuleap-16.13.sh tuleap/
cd tuleap
./compile-tuleap-16.13.sh
cd ..

# Create container image
docker build -t johnhenrysolutions/tuleap:16.13 .
