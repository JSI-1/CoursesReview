<?php
/**
 * Temporary script to create storage symlink on InfinityFree
 * 
 * IMPORTANT: Delete this file after running it once!
 * 
 * Usage: Visit https://yourdomain.infinityfreeapp.com/create-storage-link.php
 */

// Security check - only allow in specific conditions
if (php_sapi_name() !== 'cli' && !isset($_GET['token'])) {
    die('Access denied. Add ?token=YOUR_SECRET_TOKEN to the URL');
}

// Set a secret token (change this!)
$secretToken = 'change_this_secret_token_12345';

if (isset($_GET['token']) && $_GET['token'] !== $secretToken) {
    die('Invalid token');
}

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

// Remove existing link if it exists
if (file_exists($link) || is_link($link)) {
    if (is_link($link)) {
        unlink($link);
    } else {
        die('Storage directory already exists as a real directory. Please remove it manually via FTP.');
    }
}

// Create the symlink
if (symlink($target, $link)) {
    echo '<h1>✅ Storage link created successfully!</h1>';
    echo '<p>The storage symlink has been created.</p>';
    echo '<p><strong>IMPORTANT: Delete this file (create-storage-link.php) immediately for security!</strong></p>';
} else {
    echo '<h1>❌ Failed to create storage link</h1>';
    echo '<p>Please create it manually via FTP:</p>';
    echo '<ul>';
    echo '<li>Target: <code>../storage/app/public</code></li>';
    echo '<li>Link name: <code>storage</code></li>';
    echo '<li>Location: <code>public/storage</code></li>';
    echo '</ul>';
}
