# Push to GitHub - Quick Guide

Your repository is cleaned up and ready to push!

## Repository Name: `CoursesReview`

## Step 1: Create Repository on GitHub

1. Go to https://github.com/new
2. Repository name: `CoursesReview`
3. Choose **Public** or **Private**
4. **DO NOT** check "Initialize with README", ".gitignore", or "license"
5. Click **"Create repository"**

## Step 2: Find Your GitHub Username

1. Go to https://github.com
2. Sign in
3. Click your profile picture (top right)
4. Your username is in the URL: `https://github.com/YOUR_USERNAME`

## Step 3: Push Your Code

**Option A: Use the script (easiest)**
```powershell
.\push-to-github.ps1 -GitHubUsername YOUR_USERNAME
```

**Option B: Manual commands**
```bash
git remote add origin https://github.com/YOUR_USERNAME/CoursesReview.git
git branch -M main
git push -u origin main
```

## Authentication

When prompted for password, use a **Personal Access Token**:
1. Go to: https://github.com/settings/tokens
2. Generate new token (classic)
3. Select scope: `repo` (full control)
4. Copy the token and use it as your password

## After Push

Your code will be available at:
`https://github.com/YOUR_USERNAME/CoursesReview`
