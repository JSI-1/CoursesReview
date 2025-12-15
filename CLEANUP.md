# Cleanup Checklist

Before deploying to InfinityFree, clean up these files/folders:

## Files to Delete

1. **Development Scripts:**
   - `setup.ps1` (PowerShell setup script - not needed on server)
   - `start.ps1` (PowerShell start script - not needed on server)
   - `tools/composer.phar` (Composer - not needed if using Composer on server)

2. **Cache Files:**
   - `storage/framework/views/*` (compiled views - will regenerate)
   - `storage/logs/*.log` (old log files)
   - `bootstrap/cache/*.php` (except `.gitignore`)

3. **Node Modules (if not using Vite in production):**
   - `node_modules/` (if you're not building assets on server)

4. **Temporary Files:**
   - `public/create-storage-link.php` (after creating the link)
   - Any test files you created

## Files to Keep

- All Laravel core files
- `vendor/` directory (required)
- `storage/` directory structure (required)
- `public/` directory (required)
- `.env` file (with production values)
- `composer.json` and `composer.lock`

## Quick Cleanup Commands

### Windows (PowerShell):
```powershell
# Clear Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Remove compiled views
Remove-Item storage\framework\views\*.php -Force

# Remove old logs (keep the directory)
Remove-Item storage\logs\*.log -Force -ErrorAction SilentlyContinue
```

### Linux/Mac:
```bash
# Clear Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Remove compiled views
rm -f storage/framework/views/*.php

# Remove old logs
rm -f storage/logs/*.log
```

## After Deployment

1. Delete `public/create-storage-link.php` after creating the storage link
2. Verify `.env` has `APP_DEBUG=false`
3. Test all functionality
4. Monitor `storage/logs/laravel.log` for any errors
