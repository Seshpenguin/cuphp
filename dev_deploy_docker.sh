#!/bin/bash
echo "~~ Targeting Development Build ~~"
echo "Building Docker image..."
docker build -t connectus/frontend .

echo "Stopping old container..."
docker stop Frontend-Dev

echo "Removing old container..."
docker rm Frontend-Dev

echo "Creating new container..."
docker run -d --name Frontend-Dev --security-opt seccomp=unconfined --tmpfs /run --tmpfs /run/lock -v /sys/fs/cgroup:/sys/fs/cgroup:ro -e VIRTUAL_HOST=dev.connectus.today -e LETSENCRYPT_HOST=dev.connectus.today -e LETSENCRYPT_EMAIL=admin@connectus.today -t connectus/frontend
sleep 2

echo "Viewing container logs..."
docker logs Frontend-1

echo "Done! Have fun."
