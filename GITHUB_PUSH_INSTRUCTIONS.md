# How to Push to GitHub

## Step 1: Create a Repository on GitHub

1. Go to https://github.com and sign in
2. Click the "+" icon in the top right corner
3. Select "New repository"
4. Repository name: `course-review-app` (or any name you prefer)
5. Description: "Laravel Course Review System with bilingual support"
6. Choose **Public** or **Private**
7. **DO NOT** initialize with README, .gitignore, or license (we already have these)
8. Click "Create repository"

## Step 2: Push Your Code

After creating the repository, GitHub will show you commands. Use these:

### Option A: If you haven't set up the remote yet

```bash
git remote add origin https://github.com/YOUR_USERNAME/course-review-app.git
git branch -M main
git push -u origin main
```

Replace `YOUR_USERNAME` with your actual GitHub username.

### Option B: If you already have a remote

```bash
git remote set-url origin https://github.com/YOUR_USERNAME/course-review-app.git
git branch -M main
git push -u origin main
```

## Step 3: Authentication

When you push, GitHub will ask for authentication:

**Option 1: Personal Access Token (Recommended)**
1. Go to GitHub → Settings → Developer settings → Personal access tokens → Tokens (classic)
2. Generate new token (classic)
3. Give it a name and select scopes: `repo` (full control)
4. Copy the token
5. When prompted for password, paste the token instead

**Option 2: GitHub CLI**
```bash
gh auth login
```

**Option 3: SSH (if you have SSH keys set up)**
```bash
git remote set-url origin git@github.com:YOUR_USERNAME/course-review-app.git
git push -u origin main
```

## Quick Commands Summary

```bash
# Navigate to project
cd c:\Users\user\OneDrive\Desktop\course-review-app

# Add remote (replace YOUR_USERNAME)
git remote add origin https://github.com/YOUR_USERNAME/course-review-app.git

# Rename branch to main (if needed)
git branch -M main

# Push to GitHub
git push -u origin main
```

## Troubleshooting

### Error: "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/course-review-app.git
```

### Error: "Authentication failed"
- Make sure you're using a Personal Access Token, not your password
- Check that the token has `repo` scope

### Error: "Repository not found"
- Verify the repository name and username are correct
- Make sure the repository exists on GitHub

## After Pushing

Once pushed, you can:
- View your code at: `https://github.com/YOUR_USERNAME/course-review-app`
- Share the repository URL
- Set up GitHub Pages (if needed)
- Add collaborators
- Create issues and pull requests
