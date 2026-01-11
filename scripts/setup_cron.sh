#!/bin/bash

#===============================================================================
# SETUP CRON JOB UNTUK BACKUP OTOMATIS
# Script ini akan mengatur cron job backup database jam 3 malam setiap hari
#===============================================================================

SCRIPT_PATH="/var/www/html/speedu-cbt/scripts/auto_backup_mysql.sh"
CRON_SCHEDULE="0 3 * * *"

echo "=========================================="
echo "SETUP CRON JOB BACKUP DATABASE"
echo "=========================================="

# Pastikan script backup ada dan executable
if [ ! -f "$SCRIPT_PATH" ]; then
    echo "ERROR: Script backup tidak ditemukan: $SCRIPT_PATH"
    exit 1
fi

# Buat script executable
chmod +x "$SCRIPT_PATH"
echo "✓ Script backup sudah executable"

# Buat direktori database-backups jika belum ada
mkdir -p /var/www/html/speedu-cbt/database-backups
echo "✓ Direktori backup sudah siap"

# Cek apakah cron job sudah ada
EXISTING_CRON=$(crontab -l 2>/dev/null | grep -F "$SCRIPT_PATH")

if [ -n "$EXISTING_CRON" ]; then
    echo "! Cron job sudah ada, memperbarui..."
    # Hapus cron job yang ada
    crontab -l 2>/dev/null | grep -v -F "$SCRIPT_PATH" | crontab -
fi

# Tambahkan cron job baru
(crontab -l 2>/dev/null; echo "$CRON_SCHEDULE $SCRIPT_PATH >> /var/www/html/speedu-cbt/scripts/cron.log 2>&1") | crontab -

if [ $? -eq 0 ]; then
    echo "✓ Cron job berhasil ditambahkan!"
    echo ""
    echo "Jadwal: Setiap hari jam 03:00 pagi"
    echo "Script: $SCRIPT_PATH"
    echo ""
    echo "Cron job aktif:"
    crontab -l | grep -F "$SCRIPT_PATH"
else
    echo "✗ ERROR: Gagal menambahkan cron job!"
    exit 1
fi

echo ""
echo "=========================================="
echo "SETUP SELESAI!"
echo "=========================================="
echo ""
echo "Untuk menguji backup secara manual, jalankan:"
echo "  bash $SCRIPT_PATH"
echo ""
echo "Untuk melihat log backup:"
echo "  tail -f /var/www/html/speedu-cbt/scripts/backup.log"
echo ""
echo "Untuk melihat semua cron job:"
echo "  crontab -l"
echo ""
