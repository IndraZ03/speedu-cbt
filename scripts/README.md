# 🗄️ Sistem Backup Database MySQL Otomatis ke GitHub

## Deskripsi
Sistem backup otomatis yang akan melakukan backup database MySQL setiap hari jam **03:00 pagi** dan meng-upload ke GitHub repository.

## Cara Kerja
1. **Dump Database** - Menggunakan `mysqldump` untuk membuat backup database
2. **Kompresi** - File SQL dikompres menggunakan `gzip` untuk menghemat space
3. **Upload ke GitHub** - Commit dan push file backup ke branch `vps`
4. **Pembersihan Otomatis** - Backup lebih dari 7 hari akan dihapus otomatis

## Struktur File

```
/var/www/html/speedu-cbt/
├── scripts/
│   ├── auto_backup_mysql.sh    # Script backup utama
│   ├── setup_cron.sh           # Script untuk setup cron job
│   ├── backup.log              # Log aktivitas backup
│   └── cron.log                # Log output cron job
└── database-backups/           # Folder penyimpanan backup
    └── speedukedinasanku_YYYYMMDD_HHMMSS.sql.gz
```

## Cron Job
```bash
# Jam 3 malam setiap hari
0 3 * * * /var/www/html/speedu-cbt/scripts/auto_backup_mysql.sh >> /var/www/html/speedu-cbt/scripts/cron.log 2>&1
```

## Perintah Berguna

### Menjalankan backup secara manual
```bash
bash /var/www/html/speedu-cbt/scripts/auto_backup_mysql.sh
```

### Melihat log backup
```bash
tail -f /var/www/html/speedu-cbt/scripts/backup.log
```

### Melihat log cron
```bash
tail -f /var/www/html/speedu-cbt/scripts/cron.log
```

### Melihat daftar cron job
```bash
crontab -l
```

### Menghapus cron job
```bash
crontab -e
# Hapus baris yang berisi auto_backup_mysql.sh
```

### Melihat daftar backup
```bash
ls -lh /var/www/html/speedu-cbt/database-backups/
```

## Restore Database
Untuk restore database dari file backup:

```bash
# 1. Ekstrak file backup
gunzip -c /var/www/html/speedu-cbt/database-backups/speedukedinasanku_YYYYMMDD_HHMMSS.sql.gz > backup.sql

# 2. Restore ke MySQL
mysql -u root -p speedukedinasanku < backup.sql
```

## Konfigurasi

Konfigurasi dapat diubah di file `/var/www/html/speedu-cbt/scripts/auto_backup_mysql.sh`:

| Variable | Deskripsi | Default |
|----------|-----------|---------|
| `DB_HOST` | Host database | localhost |
| `DB_USER` | Username database | root |
| `DB_PASS` | Password database | *** |
| `DB_NAME` | Nama database | speedukedinasanku |
| `GIT_BRANCH` | Branch untuk push backup | vps |
| `RETENTION_DAYS` | Jumlah hari menyimpan backup | 7 |

## GitHub Repository
- Repository: https://github.com/IndraZ03/speedu-cbt
- Branch backup: `vps`
- Folder backup: `database-backups/`

## Troubleshooting

### Backup gagal - Access denied
Cek kredensial database di file `.env` atau di script backup.

### Push ke GitHub gagal
1. Cek koneksi internet
2. Cek kredensial Git (`git remote -v`)
3. Pastikan memiliki akses push ke repository

### Cron tidak berjalan
1. Cek service cron: `sudo systemctl status cron`
2. Cek log cron: `sudo tail -f /var/log/syslog | grep CRON`
3. Pastikan script executable: `chmod +x /var/www/html/speedu-cbt/scripts/auto_backup_mysql.sh`

---
*Dibuat pada: 2026-01-11*
