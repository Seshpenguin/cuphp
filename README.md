# ConnectUS
NOTICE: This is a backup repository of the frontend software I wrote from ConnectUS


This is the ConnectUS frontend software, written in PHP, designed to run with the api-server.

Docker build and then deploy with "docker run -d --name Frontend-1 --security-opt seccomp=unconfined --tmpfs /run --tmpfs /run/lock -v /sys/fs/cgroup:/sys/fs/cgroup:ro -p 80:80 -t connectus/frontend"

Please use the ```# ./deploy_docker.sh``` script if you are deploying to the server (it will setup, build, and push everything automatically).
