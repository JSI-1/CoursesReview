# PowerShell script to push to GitHub
# Replace YOUR_USERNAME with your actual GitHub username

param(
    [Parameter(Mandatory=$true)]
    [string]$GitHubUsername
)

Write-Host "Setting up GitHub remote..." -ForegroundColor Cyan

# Remove existing remote if any
git remote remove origin 2>$null

# Add remote
$remoteUrl = "https://github.com/$GitHubUsername/CoursesReview.git"
git remote add origin $remoteUrl

Write-Host "Remote added: $remoteUrl" -ForegroundColor Green

# Rename branch to main
git branch -M main

Write-Host "Branch renamed to main" -ForegroundColor Green

# Push to GitHub
Write-Host "`nPushing to GitHub..." -ForegroundColor Yellow
Write-Host "Note: You may be prompted for credentials." -ForegroundColor Yellow
Write-Host "Use a Personal Access Token instead of password if prompted." -ForegroundColor Yellow
Write-Host ""

git push -u origin main

if ($LASTEXITCODE -eq 0) {
    Write-Host "`n✅ Successfully pushed to GitHub!" -ForegroundColor Green
    Write-Host "Repository URL: https://github.com/$GitHubUsername/CoursesReview" -ForegroundColor Cyan
} else {
    Write-Host "`n❌ Push failed. Please check:" -ForegroundColor Red
    Write-Host "1. Repository exists on GitHub: https://github.com/$GitHubUsername/CoursesReview" -ForegroundColor Yellow
    Write-Host "2. You have authentication set up (Personal Access Token)" -ForegroundColor Yellow
    Write-Host "3. You have write access to the repository" -ForegroundColor Yellow
}
