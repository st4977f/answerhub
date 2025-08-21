<?php
// Security functions for AnswerHub

// Set security headers
function setSecurityHeaders() {
    // Only set headers if they haven't been sent yet
    if (!headers_sent()) {
        // Prevent XSS attacks
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
    }
}

// Simple rate limiting for login attempts
function checkRateLimit($identifier, $maxAttempts = 5, $timeWindow = 300) {
    // Session should already be started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $key = 'rate_limit_' . md5($identifier);
    $now = time();
    
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 1, 'start_time' => $now];
        return true;
    }
    
    $attempts = $_SESSION[$key];
    
    // Reset if time window has passed
    if (($now - $attempts['start_time']) > $timeWindow) {
        $_SESSION[$key] = ['count' => 1, 'start_time' => $now];
        return true;
    }
    
    // Check if limit exceeded
    if ($attempts['count'] >= $maxAttempts) {
        return false;
    }
    
    // Increment counter
    $_SESSION[$key]['count']++;
    return true;
}

// Generate CSRF token
function generateCSRFToken() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION['csrf_token'];
}

// Validate CSRF token
function validateCSRFToken($token) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Enhanced input sanitization
function sanitizeInput($input, $type = 'string') {
    switch ($type) {
        case 'int':
            return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
        case 'email':
            return filter_var(trim($input), FILTER_SANITIZE_EMAIL);
        case 'url':
            return filter_var(trim($input), FILTER_SANITIZE_URL);
        case 'string':
        default:
            $input = trim($input);
            $input = strip_tags($input);
            $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
            return $input;
    }
}

// Log security events
function logSecurityEvent($event, $details = '') {
    $logFile = __DIR__ . '/security.log';
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    $logEntry = "[{$timestamp}] IP: {$ip} | Event: {$event} | Details: {$details} | User-Agent: {$userAgent}" . PHP_EOL;
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}
?>
