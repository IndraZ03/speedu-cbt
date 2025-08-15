#!/bin/bash

# Configuration
DB_USER="root"
DB_NAME="speedu_cbt"
BACKUP_PATH="/var/www/html/speedu-cbt/database/backups"
BACKUP_FILE="backup_$(date +%Y%m%d_%H%M%S).sql"
GITHUB_REPO="/var/www/html/speedu-cbt"

# Create backup directory if not exists
mkdir -p $BACKUP_PATH

# Perform MySQL backup
mysqldump -u $DB_USER -p $DB_NAME > "$BACKUP_PATH/$BACKUP_FILE"

# Navigate to the repository directory
cd $GITHUB_REPO

# Add, commit, and push to GitHub
git add $BACKUP_PATH/$BACKUP_FILE
git commit -m "Automated database backup - $(date +%Y-%m-%d)"
git push origin main

# Remove backups older than 7 days
find $BACKUP_PATH -type f -name "backup_*" -mtime +7 -exec rm {} \; 