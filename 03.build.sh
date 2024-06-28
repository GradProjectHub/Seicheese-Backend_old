#!/bin/bash

# Build the project
docker build --target web-dev -t seicheese:web ./Docker && docker build --target app-dev -t seicheese:app ./Docker && \
docker build --target db-dev -t seicheese:db ./Docker && docker build --target admin -t seicheese:pma ./Docker