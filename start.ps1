# Start the development server

$ErrorActionPreference = "Stop"

# Refresh PATH to include newly installed programs
$env:Path = [System.Environment]::GetEnvironmentVariable("Path","Machine") + ";" + [System.Environment]::GetEnvironmentVariable("Path","User")

# Change to script directory
Set-Location $PSScriptRoot

# Find PHP
$phpPath = $null
try {
    $phpVersion = php --version 2>&1 | Select-Object -First 1
    if ($phpVersion -match "PHP") {
        $phpPath = "php"
    }
} catch {}

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
    exit 1
}

# Check if port 8080 is available, if not use 8000
$port = 8080
$portInUse = netstat -ano | findstr ":$port" | Select-String "LISTENING"
if ($portInUse) {
    Write-Host "Port 8080 is in use, trying port 8000..." -ForegroundColor Yellow
    $port = 8000
    $portInUse = netstat -ano | findstr ":$port" | Select-String "LISTENING"
    if ($portInUse) {
        Write-Host "Port 8000 is also in use, trying port 8001..." -ForegroundColor Yellow
        $port = 8001
    }
}

Write-Host "Starting server at http://localhost:$port" -ForegroundColor Cyan
Write-Host "Press Ctrl+C to stop" -ForegroundColor Gray
Write-Host ""

& $phpPath artisan serve --port=$port

