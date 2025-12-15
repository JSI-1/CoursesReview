# Simple Setup Script for Course Review App
# This script installs dependencies and sets up the Laravel application

$ErrorActionPreference = "Stop"

# Refresh PATH to include newly installed programs
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")

Write-Host "Course Review App - Setup" -ForegroundColor Cyan
Write-Host ""

# Check for PHP
$phpPath = $null
try {
    $phpVersion = php --version 2>&1 | Select-Object -First 1
    if ($phpVersion -match "PHP") {
        $phpPath = "php"
    }
} catch {}

# Try common PHP locations
if (-not $phpPath) {
    $paths = @(
        "C:\Users\$env:USERNAME\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.2_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe",
        "C:\xampp\php\php.exe",
        "C:\php\php.exe",
        "C:\Program Files\PHP\php.exe",
        "C:\laragon\bin\php\php-8.3\php.exe",
        "C:\laragon\bin\php\php-8.2\php.exe",
        "C:\laragon\bin\php\php-8.1\php.exe"
    )
    foreach ($path in $paths) {
        if (Test-Path $path) {
            $phpPath = $path
            break
        }
    }
}

if (-not $phpPath) {
    Write-Host "ERROR: PHP not found!" -ForegroundColor Red
    Write-Host "Please install PHP:" -ForegroundColor Yellow
    Write-Host "1. Download XAMPP: https://www.apachefriends.org/download.html" -ForegroundColor White
    Write-Host "2. Or download PHP: https://windows.php.net/download/" -ForegroundColor White
    Write-Host "3. Add PHP to your system PATH" -ForegroundColor White
    exit 1
}

# Change to script directory
Set-Location $PSScriptRoot

$composerPhar = Join-Path $PSScriptRoot "tools\composer.phar"

# Create .env if needed
if (-not (Test-Path ".env")) {
    if (Test-Path ".env.example") {
        Copy-Item ".env.example" ".env"
        Write-Host "Created .env file" -ForegroundColor Green
    }
}

# Install dependencies
Write-Host "Installing dependencies..." -ForegroundColor Yellow
& $phpPath $composerPhar install --no-interaction --quiet

# Generate app key
Write-Host "Generating application key..." -ForegroundColor Yellow
& $phpPath artisan key:generate --force 2>&1 | Out-Null

Write-Host ""
Write-Host "Setup complete!" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Configure database in .env file" -ForegroundColor White
Write-Host "2. Run: $phpPath artisan migrate --seed" -ForegroundColor White
Write-Host "3. Run: $phpPath artisan serve" -ForegroundColor White

