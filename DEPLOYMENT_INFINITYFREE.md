# Deployment Guide for InfinityFree

This guide will help you deploy your Laravel Course Review System to InfinityFree hosting.

## Prerequisites

1. An InfinityFree account (free at https://www.infinityfree.net/)
2. FTP access credentials from InfinityFree
3. MySQL database credentials from InfinityFree

## Step 1: Prepare Your Application

### 1.1 Clean Up Local Files

Before uploading, clean up unnecessary files:

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Remove development files
rm -rf node_modules
rm -rf .git
rm -rf storage/logs/*.log
rm -rf storage/framework/views/*
```

### 1.2 Update .env File

Create a production `.env` file with your InfinityFree database credentials:

```env
APP_NAME="Course Review System"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.infinityfreeapp.com

DB_CONNECTION=mysql
DB_HOST=sqlXXX.infinityfree.com
DB_PORT=3306
DB_DATABASE=epiz_XXXXXX_yourdb
DB_USERNAME=epiz_XXXXXX_youruser
DB_PASSWORD=your_password

SESSION_DRIVER=file
SESSION_LIFETIME=120

# File storage
FILESYSTEM_DISK=public
```

**Important:** Get your database credentials from InfinityFree Control Panel → MySQL Databases.

## Step 2: Upload Files via FTP

### 2.1 Connect via FTP

Use an FTP client (FileZilla, WinSCP, etc.) with credentials from InfinityFree:
- Host: `ftpupload.net`
- Username: Your InfinityFree username
- Password: Your InfinityFree password
- Port: 21

### 2.2 Upload Structure

Upload ALL files to the `htdocs` folder, maintaining the Laravel structure:

```
htdocs/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          ← This is your web root
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── artisan
├── composer.json
└── ... (all other Laravel files)
```

**Important:** The `public` folder contents should be accessible at your domain root.

## Step 3: Configure InfinityFree

### 3.1 Set Document Root

In InfinityFree Control Panel:
1. Go to "Manage" → "Subdomain Settings"
2. Set "Document Root" to: `htdocs/public`

### 3.2 Create Storage Link

After uploading, you need to create a symbolic link. Since InfinityFree doesn't allow SSH, you can:

**Option A: Use a PHP script (temporary)**

Create `create-link.php` in `public/`:

```php
<?php
symlink('../storage/app/public', 'storage');
echo "Storage link created!";
```

Visit: `https://yourdomain.infinityfreeapp.com/create-link.php`
Then delete this file for security.

**Option B: Manual FTP**

1. In your FTP client, navigate to `htdocs/public/`
2. Create a symbolic link named `storage` pointing to `../storage/app/public`

## Step 4: Run Migrations

Since InfinityFree doesn't provide SSH access, you have two options:

### Option A: Use Artisan via Browser (Temporary)

Create `migrate.php` in `public/`:

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$kernel->call('migrate', ['--force' => true]);
echo "Migrations completed!";
```

Visit: `https://yourdomain.infinityfreeapp.com/migrate.php`
**IMPORTANT:** Delete this file immediately after running migrations!

### Option B: Run Locally and Export Database

1. Run migrations locally: `php artisan migrate`
2. Export your local database
3. Import to InfinityFree MySQL database via phpMyAdmin

## Step 5: Seed Database (Optional)

If you want to seed initial data, create `seed.php` in `public/`:

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$kernel->call('db:seed', ['--force' => true]);
echo "Database seeded!";
```

Visit the URL, then **delete the file immediately**.

## Step 6: Set Permissions

Set these folder permissions via FTP (usually 755 for folders, 644 for files):
- `storage/` → 755
- `storage/app/` → 755
- `storage/app/public/` → 755
- `storage/framework/` → 755
- `storage/logs/` → 755
- `bootstrap/cache/` → 755

## Step 7: Final Configuration

### 7.1 Update APP_KEY

If you haven't set APP_KEY, generate it locally:
```bash
php artisan key:generate
```

Copy the generated key to your `.env` file on InfinityFree.

### 7.2 Test Your Application

Visit your domain and test:
- Homepage loads
- Can register/login
- Can view courses
- Can create reviews
- File uploads work

## Troubleshooting

### Error: "No application encryption key"
- Make sure `.env` has `APP_KEY` set
- Run `php artisan key:generate` locally and copy the key

### Error: "Storage link not found"
- Create the storage link manually via FTP or use the PHP script method

### Error: "500 Internal Server Error"
- Check `storage/logs/laravel.log` for details
- Verify file permissions
- Ensure `.env` is configured correctly

### File Uploads Not Working
- Verify `storage/app/public/feedback/` exists and is writable (755)
- Check `public/storage` symlink exists
- Verify `FILESYSTEM_DISK=public` in `.env`

### Database Connection Issues
- Double-check database credentials in `.env`
- Verify database exists in InfinityFree Control Panel
- Check if database host is correct (usually `sqlXXX.infinityfree.com`)

## Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Delete any temporary PHP scripts (migrate.php, seed.php, create-link.php)
- [ ] Ensure `.env` is not publicly accessible
- [ ] Set proper file permissions (755 for folders, 644 for files)
- [ ] Remove any development tools from `vendor/` if possible

## Notes

- InfinityFree has file upload size limits (usually 10MB)
- Some Laravel features may be limited (queue workers, scheduled tasks)
- Consider upgrading to paid hosting for better performance and features
- Regular backups are recommended

## Support

For InfinityFree-specific issues, visit: https://forum.infinityfree.net/
For Laravel issues, visit: https://laravel.com/docs
