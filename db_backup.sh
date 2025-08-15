#!/bin/bash

# Database credentials
DB_USER="root"
DB_PASS="@Speedujaya123"
DB_NAME="speedukedinasanku"
DB_HOST="localhost"


# Backup directory
BACKUP_DIR="/var/www/html/speedu-cbt/backups"
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="$BACKUP_DIR/$DB_NAME_backup_$DATE.sql"

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Perform backup
echo "Starting database backup..."
mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_FILE

if [ $? -eq 0 ]; then
    echo "Backup successful: $BACKUP_FILE"
    # Compress the backup
    gzip -c $BACKUP_FILE > $BACKUP_FILE.gz
    rm $BACKUP_FILE
    echo "Backup compressed: $BACKUP_FILE.gz"
else
    echo "Backup failed!"
    exit 1
fi

# GitHub repository details
REPO_DIR="/var/www/html/speedu-cbt/repo_temp"
REPO_URL="https://github.com/IndraZ03/speedu-cbt.git"
BRANCH="vps"
BACKUP_FOLDER="backup"

# Clone repo if it doesn't exist
if [ ! -d "$REPO_DIR" ]; then
    echo "Cloning repository..."
    git clone -b $BRANCH $REPO_URL $REPO_DIR
    if [ $? -ne 0 ]; then
        echo "Branch $BRANCH not found, creating it..."
        git clone $REPO_URL $REPO_DIR
        cd $REPO_DIR
        git checkout -b $BRANCH
        git push origin $BRANCH
    fi
fi

# Create backup folder in repo if it doesn't exist
mkdir -p $REPO_DIR/$BACKUP_FOLDER

# Copy backup to repo
cp $BACKUP_FILE.gz $REPO_DIR/$BACKUP_FOLDER/

# Push to GitHub
cd $REPO_DIR
git add $BACKUP_FOLDER/*
git commit -m "Automated database backup for $DATE"
git push origin $BRANCH

echo "Backup pushed to GitHub successfully"

# Clean up old backups (keep last 7 days)
find $BACKUP_DIR -name "*.gz" -mtime +7 -delete
echo "Old backups cleaned up"
