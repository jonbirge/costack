#!/bin/bash
docker compose build
docker compose pull
docker compose up --remove-orphans -d

