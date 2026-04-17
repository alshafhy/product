#!/bin/bash

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}Starting Laravel 13 & Vite Upgrade...${NC}"

step() {
    echo -e "${GREEN}Running: $1...${NC}"
    $2
    if [ $? -ne 0 ]; then
        echo -e "${RED}FAILED: $1${NC}"
        exit 1
    fi
    echo -e "${GREEN}OK: $1${NC}"
}

# 1. Composer update
step "Composer Update" "composer update"

# 2. Clear artisan caches
step "Artisan Cache Clear" "php artisan cache:clear"
step "Artisan Config Clear" "php artisan config:clear"
step "Artisan View Clear" "php artisan view:clear"
step "Artisan Route Clear" "php artisan route:clear"

# 3. Publish Spatie Permissions
step "Publish Spatie Permissions" "php artisan vendor:publish --provider=\"Spatie\Permission\PermissionServiceProvider\" --force"

# 4. NPM Install
step "NPM Install" "npm install"

# 5. NPM Build
step "NPM Build" "npm run build"

echo -e "${GREEN}Upgrade completed successfully!${NC}"
