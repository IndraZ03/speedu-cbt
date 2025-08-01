#!/bin/bash

# Konfigurasi Database
DB_NAME="speedukedinasanku"
DB_USER="root"
DB_PASSWORD="@Speedujaya123"      
BACKUP_DIR="backup" # Ganti dengan direktori penyimpanan backup

# Nama file backup
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="${DB_NAME}_${TIMESTAMP}.sql"
COMPRESSED_BACKUP_FILE="${BACKUP_FILE}.gz"

# Pastikan direktori backup ada
mkdir -p "$BACKUP_DIR"

echo "Memulai backup database ${DB_NAME}..."

# Melakukan dump database
mysqldump -u"${DB_USER}" -p"${DB_PASSWORD}" "${DB_NAME}" > "${BACKUP_DIR}/${BACKUP_FILE}"

# Memeriksa apakah dump berhasil
if [ $? -eq 0 ]; then
    echo "Backup database berhasil dibuat: ${BACKUP_DIR}/${BACKUP_FILE}"

    # Kompresi file backup (opsional, disarankan)
    echo "Mengompres file backup..."
    gzip "${BACKUP_DIR}/${BACKUP_FILE}"
    if [ $? -eq 0 ]; then
        echo "File backup berhasil dikompres: ${BACKUP_DIR}/${COMPRESSED_BACKUP_FILE}"
        # Hapus file .sql asli setelah dikompres (opsional)
        # rm "${BACKUP_DIR}/${BACKUP_FILE}"
    else
        echo "Gagal mengompres file backup."
    fi

else
    echo "Gagal membuat backup database."
    exit 1 # Keluar dengan error
fi

# Konfigurasi Git
GIT_REPO_PATH="/var/www/html/speedu-cbt" # Ganti dengan path ke repository Git Anda
GIT_REMOTE="origin"                    # Nama remote Git Anda (biasanya 'origin')
GIT_BRANCH="vps"                      # Branch Git Anda (misalnya 'main' atau 'master')

echo "Memulai push backup ke Git..."

# Masuk ke direktori repository Git
cd "$GIT_REPO_PATH" || { echo "Direktori Git tidak ditemukan!"; exit 1; }

# Tambahkan file backup ke staging area Git
git add "${BACKUP_DIR}/${COMPRESSED_BACKUP_FILE}"

# Buat commit baru
git commit -m "Auto backup MySQL: ${TIMESTAMP}"

# Push ke remote repository
git push "${GIT_REMOTE}" "${GIT_BRANCH}"

if [ $? -eq 0 ]; then
    echo "Backup berhasil di-push ke Git."
else
    echo "Gagal mem-push backup ke Git."
    exit 1 # Keluar dengan error
fi

echo "Proses backup dan push selesai."