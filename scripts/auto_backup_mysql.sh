#!/bin/bash

#===============================================================================
# AUTO BACKUP MySQL DATABASE TO GITHUB
# Script ini akan melakukan backup database MySQL dan push ke GitHub
# Dijalankan otomatis setiap jam 3 malam via cron job
#===============================================================================

# Konfigurasi
LOG_FILE="/var/www/html/speedu-cbt/scripts/backup.log"
BACKUP_DIR="/var/www/html/speedu-cbt/database-backups"
REPO_DIR="/var/www/html/speedu-cbt"
GIT_BRANCH="vps"
GIT_REMOTE="origin"

# Database Configuration
DB_HOST="localhost"
DB_USER="root"
DB_PASS="@Zkayang29"
DB_NAME="speedukedinasanku"

# Timestamp
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
DATE_READABLE=$(date +"%Y-%m-%d %H:%M:%S")
BACKUP_FILENAME="${DB_NAME}_${TIMESTAMP}.sql"
COMPRESSED_FILENAME="${BACKUP_FILENAME}.gz"

# Jumlah hari untuk menyimpan backup (backup lama akan dihapus)
RETENTION_DAYS=7

#===============================================================================
# FUNCTIONS
#===============================================================================

log_message() {
    echo "[$(date +"%Y-%m-%d %H:%M:%S")] $1" | tee -a "$LOG_FILE"
}

check_command() {
    if ! command -v $1 &> /dev/null; then
        log_message "ERROR: Command '$1' tidak ditemukan. Silakan install terlebih dahulu."
        exit 1
    fi
}

#===============================================================================
# MAIN SCRIPT
#===============================================================================

log_message "=========================================="
log_message "MEMULAI BACKUP DATABASE OTOMATIS"
log_message "=========================================="

# Cek dependencies
check_command mysqldump
check_command gzip
check_command git

# Buat direktori backup jika belum ada
if [ ! -d "$BACKUP_DIR" ]; then
    mkdir -p "$BACKUP_DIR"
    log_message "Direktori backup dibuat: $BACKUP_DIR"
fi

# Buat direktori scripts jika belum ada
if [ ! -d "$(dirname "$LOG_FILE")" ]; then
    mkdir -p "$(dirname "$LOG_FILE")"
fi

#===============================================================================
# STEP 1: Backup Database
#===============================================================================
log_message "Step 1: Memulai backup database ${DB_NAME}..."

mysqldump -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" \
    --single-transaction \
    --routines \
    --triggers \
    --add-drop-table \
    --complete-insert \
    "$DB_NAME" > "${BACKUP_DIR}/${BACKUP_FILENAME}" 2>> "$LOG_FILE"

if [ $? -eq 0 ]; then
    log_message "✓ Backup database berhasil: ${BACKUP_FILENAME}"
    
    # Dapatkan ukuran file
    FILE_SIZE=$(du -h "${BACKUP_DIR}/${BACKUP_FILENAME}" | cut -f1)
    log_message "  Ukuran file SQL: $FILE_SIZE"
else
    log_message "✗ ERROR: Gagal membuat backup database!"
    exit 1
fi

#===============================================================================
# STEP 2: Kompres File Backup
#===============================================================================
log_message "Step 2: Mengompres file backup..."

gzip -f "${BACKUP_DIR}/${BACKUP_FILENAME}"

if [ $? -eq 0 ]; then
    COMPRESSED_SIZE=$(du -h "${BACKUP_DIR}/${COMPRESSED_FILENAME}" | cut -f1)
    log_message "✓ File berhasil dikompres: ${COMPRESSED_FILENAME}"
    log_message "  Ukuran file terkompresi: $COMPRESSED_SIZE"
else
    log_message "✗ ERROR: Gagal mengompres file backup!"
    exit 1
fi

#===============================================================================
# STEP 3: Push ke GitHub
#===============================================================================
log_message "Step 3: Memulai push ke GitHub..."

# Masuk ke direktori repository
cd "$REPO_DIR" || { log_message "ERROR: Direktori repository tidak ditemukan!"; exit 1; }

# Pastikan branch yang benar
log_message "  Mengecek branch aktif..."
CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
if [ "$CURRENT_BRANCH" != "$GIT_BRANCH" ]; then
    log_message "  Beralih ke branch $GIT_BRANCH..."
    git checkout "$GIT_BRANCH" 2>> "$LOG_FILE"
    if [ $? -ne 0 ]; then
        log_message "  Branch $GIT_BRANCH tidak ada, membuat branch baru..."
        git checkout -b "$GIT_BRANCH" 2>> "$LOG_FILE"
    fi
fi

# Pull perubahan terbaru untuk menghindari konflik
log_message "  Mengambil perubahan terbaru dari remote..."
git pull "$GIT_REMOTE" "$GIT_BRANCH" --rebase 2>> "$LOG_FILE" || true

# Tambahkan file backup ke git
log_message "  Menambahkan file backup ke staging..."
git add "${BACKUP_DIR}/${COMPRESSED_FILENAME}" 2>> "$LOG_FILE"

# Commit perubahan
log_message "  Membuat commit..."
git commit -m "🗄️ Auto Backup MySQL: ${DATE_READABLE}

Database: ${DB_NAME}
File: ${COMPRESSED_FILENAME}
Size: ${COMPRESSED_SIZE}" 2>> "$LOG_FILE"

if [ $? -eq 0 ]; then
    log_message "✓ Commit berhasil dibuat"
else
    log_message "! Tidak ada perubahan untuk di-commit atau commit gagal"
fi

# Push ke remote
log_message "  Push ke remote repository..."
git push "$GIT_REMOTE" "$GIT_BRANCH" 2>> "$LOG_FILE"

if [ $? -eq 0 ]; then
    log_message "✓ Backup berhasil di-push ke GitHub"
else
    log_message "✗ ERROR: Gagal push ke GitHub!"
    exit 1
fi

#===============================================================================
# STEP 4: Membersihkan Backup Lama
#===============================================================================
log_message "Step 4: Membersihkan backup lebih dari ${RETENTION_DAYS} hari..."

# Hitung jumlah file sebelum
FILES_BEFORE=$(find "$BACKUP_DIR" -name "*.gz" -type f | wc -l)

# Hapus backup lama
find "$BACKUP_DIR" -name "*.gz" -type f -mtime +$RETENTION_DAYS -delete 2>> "$LOG_FILE"

# Hitung jumlah file setelah
FILES_AFTER=$(find "$BACKUP_DIR" -name "*.gz" -type f | wc -l)
FILES_DELETED=$((FILES_BEFORE - FILES_AFTER))

if [ $FILES_DELETED -gt 0 ]; then
    log_message "✓ $FILES_DELETED file backup lama telah dihapus"
else
    log_message "✓ Tidak ada backup lama yang perlu dihapus"
fi

#===============================================================================
# SELESAI
#===============================================================================
log_message "=========================================="
log_message "BACKUP SELESAI!"
log_message "File: ${BACKUP_DIR}/${COMPRESSED_FILENAME}"
log_message "=========================================="
log_message ""

exit 0
