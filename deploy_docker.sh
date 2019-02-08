#!/bin/bash
echo "~~ Targeting PRODUCTION Build ~~"
echo "Press Ctrl-C within 5 Seconds to cancel..."
sleep 5
echo "Building Docker image..."
docker build -t connectus/frontend .

echo "Stopping old container..."
docker stop Frontend-1
docker stop Frontend-2

echo "Removing old container..."
docker rm Frontend-1
docker rm Frontend-2

echo "Creating new container..."
docker run -d --name Frontend-1 --security-opt seccomp=unconfined --tmpfs /run --tmpfs /run/lock -v /sys/fs/cgroup:/sys/fs/cgroup:ro -t connectus/frontend
# Also create a second container!
docker run -d --name Frontend-2 --security-opt seccomp=unconfined --tmpfs /run --tmpfs /run/lock -v /sys/fs/cgroup:/sys/fs/cgroup:ro -t connectus/frontend
sleep 2

echo "Viewing container logs..."
docker logs Frontend-1

echo "Done! Have fun."
