#!/bin/sh

set -e 

VERSION="1.0.0"
IMAGE="ghcr.io/jksunny/jksunny.github.io"

docker build -t "${IMAGE}:${VERSION}" .
docker tag "${IMAGE}:${VERSION}" "${IMAGE}:latest"

docker push "${IMAGE}:${VERSION}"
docker push "${IMAGE}:latest"

echo ""
echo "done"
read