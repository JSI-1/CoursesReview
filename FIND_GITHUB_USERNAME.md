# How to Find Your GitHub Username

## Method 1: Check GitHub Website
1. Go to https://github.com
2. Sign in to your account
3. Click your profile picture in the top right corner
4. Your username appears:
   - In the URL: `https://github.com/YOUR_USERNAME`
   - Or under your profile name

## Method 2: Check Your Email
- Look for GitHub welcome emails
- The username is usually mentioned in the email

## Method 3: Check Repository URL
If you've created any repositories:
- The URL format is: `https://github.com/YOUR_USERNAME/repository-name`

## Common Formats
GitHub usernames are usually:
- Lowercase letters and numbers
- May contain hyphens
- Examples: `alhussin-marai`, `alhussinmarai`, `muhammad-almarai`, `jsi-1`

## After Finding Your Username

Once you have your GitHub username, you can:

**Option 1: Tell me your username and I'll set it up**

**Option 2: Run the script:**
```powershell
.\push-to-github.ps1 -GitHubUsername YOUR_USERNAME
```

**Option 3: Run commands manually:**
```bash
git remote add origin https://github.com/YOUR_USERNAME/CoursesReview.git
git branch -M main
git push -u origin main
```

## Create Repository First!

**IMPORTANT:** Make sure you've created the repository on GitHub first:

1. Go to https://github.com/new
2. Repository name: `CoursesReview`
3. Choose Public or Private
4. **DO NOT** check "Initialize with README"
5. Click "Create repository"

Then come back and push your code!
