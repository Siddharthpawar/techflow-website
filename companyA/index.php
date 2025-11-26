<?php
require_once 'config/db.php';

function getUsersFromCompany($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for development
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Only for development
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 10 second timeout
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    
    // Set browser-like headers to bypass basic protection
    $headers = [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'Accept: application/json, text/plain, */*',
        'Accept-Language: en-US,en;q=0.9',
        'Accept-Encoding: gzip, deflate, br',
        'Connection: keep-alive',
        'Referer: https://dokalayaswanth.infinityfree.me/',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: same-origin'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, ''); // Enable automatic decompression
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    
    if(curl_errno($ch)) {
        error_log("Curl error for $url: " . $curlError);
        curl_close($ch);
        return [];
    }
    
    curl_close($ch);
    
    if ($httpCode !== 200) {
        error_log("HTTP error for $url: Status code $httpCode");
        return [];
    }
    
    if (empty($response)) {
        error_log("Empty response from $url");
        return [];
    }
    
    // Trim response and remove BOM if present
    $response = trim($response);
    if (substr($response, 0, 3) === "\xEF\xBB\xBF") {
        $response = substr($response, 3);
    }
    
    // Check if response is HTML (likely a protection page like Cloudflare)
    if (stripos($response, '<html') !== false || stripos($response, '<script') !== false) {
        error_log("Received HTML instead of JSON from $url - likely blocked by DDoS protection");
        return [];
    }
    
    $data = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error for $url: " . json_last_error_msg() . " | Response: " . substr($response, 0, 200));
        return [];
    }
    
    if (!$data || !is_array($data)) {
        error_log("Invalid data structure from $url");
        return [];
    }
    
    // Handle different API response formats
    $users = [];
    
    // Format 1: {users: [...]} - Company B and C format
    if (isset($data['users']) && is_array($data['users'])) {
        foreach ($data['users'] as $user) {
            $users[] = [
                'id' => $user['id'] ?? '',
                'username' => $user['name'] ?? $user['username'] ?? '',
                'email' => $user['email'] ?? '',
                'company' => $user['company'] ?? $data['company'] ?? 'Unknown'
            ];
        }
    }
    // Format 2: {data: [...]} - Company B format
    elseif (isset($data['data']) && is_array($data['data'])) {
        $users = $data['data'];
    }
    // Format 3: Direct array
    elseif (is_array($data) && isset($data[0]) && is_array($data[0])) {
        $users = $data;
    }
    else {
        // Log the actual structure for debugging
        error_log("Unexpected data structure from $url. Keys: " . implode(', ', array_keys($data)));
    }
    
    return $users;
}

// Debug function to get detailed error information
function getUsersFromCompanyDebug($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Set browser-like headers
    $headers = [
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'Accept: application/json, text/plain, */*',
        'Accept-Language: en-US,en;q=0.9',
        'Accept-Encoding: gzip, deflate, br',
        'Connection: keep-alive',
        'Referer: https://dokalayaswanth.infinityfree.me/',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Site: same-origin'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_ENCODING, ''); // Enable automatic decompression
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    $curlErrno = curl_errno($ch);
    
    $debug = [
        'url' => $url,
        'http_code' => $httpCode,
        'curl_error' => $curlError,
        'curl_errno' => $curlErrno,
        'response_length' => strlen($response),
        'response_full' => $response,
        'response_preview' => substr($response, 0, 500),
        'json_error' => null,
        'json_error_code' => null,
        'decoded_data' => null
    ];
    
    if ($curlErrno) {
        curl_close($ch);
        return $debug;
    }
    
    curl_close($ch);
    
    if (!empty($response)) {
        $data = json_decode($response, true);
        $jsonError = json_last_error();
        $debug['json_error'] = $jsonError !== JSON_ERROR_NONE ? json_last_error_msg() : null;
        $debug['json_error_code'] = $jsonError;
        $debug['decoded_data'] = $data;
        $debug['decoded_data_keys'] = is_array($data) ? array_keys($data) : null;
    }
    
    return $debug;
}

// Get local users
$localUsers = [];
if ($pdo !== null) {
    try {
        $stmt = $pdo->query("SELECT id, username, email, company FROM users");
        $localUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $localUsers = [];
    }
}

// Get remote users from Company B and C
$companyB_url = 'http://mohitreddy.online/api_users.php';
$companyB_users = getUsersFromCompany($companyB_url);
$companyB_debug = getUsersFromCompanyDebug($companyB_url);
$companyC_url = 'https://dokalayaswanth.infinityfree.me/api/users.php';
$companyC_users = getUsersFromCompany($companyC_url);
$companyC_debug = getUsersFromCompanyDebug($companyC_url);

// Ensure all arrays are arrays (handle null/undefined gracefully)
$localUsers = is_array($localUsers) ? $localUsers : [];
$companyB_users = is_array($companyB_users) ? $companyB_users : [];
$companyC_users = is_array($companyC_users) ? $companyC_users : [];

// Check if Company B API is blocked by protection (for debug purposes only)
$companyB_blocked = false;
if (count($companyB_users) === 0 && isset($companyB_debug['response_full'])) {
    $response = $companyB_debug['response_full'];
    if (stripos($response, '<html') !== false || stripos($response, '<script') !== false) {
        $companyB_blocked = true;
    }
}

// Check if Company C API is blocked by protection (for debug purposes only)
$companyC_blocked = false;
if (count($companyC_users) === 0 && isset($companyC_debug['response_full'])) {
    $response = $companyC_debug['response_full'];
    if (stripos($response, '<html') !== false || stripos($response, '<script') !== false) {
        $companyC_blocked = true;
    }
}

// Combine all users (empty arrays are handled gracefully by array_merge)
$allUsers = array_merge($localUsers, $companyB_users, $companyC_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combined User List - Company A</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .company-badge {
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .company-a { background-color: #4CAF50; color: white; }
        .company-b { background-color: #2196F3; color: white; }
        .company-c { background-color: #f44336; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Combined User List</h1>
        
        <!-- Debug Info (toggle with ?debug=1 in URL) -->
        <?php if (isset($_GET['debug']) && $_GET['debug'] == '1'): ?>
        <div style="background: #fff3cd; padding: 10px; margin: 10px 0; border: 1px solid #ffc107; border-radius: 5px;">
            <strong>Debug Info:</strong> <a href="?" style="float: right; font-size: 12px;">Hide Debug</a><br>
            Local Users: <?php echo count($localUsers); ?><br>
            Company B Users: <?php echo count($companyB_users); ?><br>
            Company C Users: <?php echo count($companyC_users); ?><br>
            Total Users: <?php echo count($allUsers); ?><br>
            
            <?php if (count($companyB_users) > 0): ?>
                <div style="margin-top: 10px;">
                    <strong>Company B Users (preview):</strong>
                    <pre style="font-size: 11px; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; max-height: 150px; overflow-y: auto;"><?php print_r(array_slice($companyB_users, 0, 2)); ?></pre>
                </div>
            <?php else: ?>
                <div style="margin-top: 10px; color: red;">
                    <strong>Company B Debug Details:</strong><br>
                    <div style="font-size: 11px; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; overflow-x: auto;">
                        <strong>HTTP Code:</strong> <?php echo $companyB_debug['http_code']; ?><br>
                        <strong>Curl Error:</strong> <?php echo $companyB_debug['curl_error'] ?: 'None'; ?><br>
                        <strong>Response Length:</strong> <?php echo $companyB_debug['response_length']; ?> bytes<br>
                        <strong>JSON Error:</strong> <?php echo $companyB_debug['json_error'] ?: 'None'; ?> (Code: <?php echo $companyB_debug['json_error_code']; ?>)<br>
                        <strong>Response (first 500 chars):</strong><br>
                        <pre style="white-space: pre-wrap; word-wrap: break-word;"><?php echo htmlspecialchars(substr($companyB_debug['response_full'], 0, 500)); ?></pre>
                        <strong>Decoded Data Keys:</strong> <?php echo $companyB_debug['decoded_data_keys'] ? implode(', ', $companyB_debug['decoded_data_keys']) : 'None'; ?><br>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (count($companyC_users) > 0): ?>
                <div style="margin-top: 10px;">
                    <strong>Company C Users (preview):</strong>
                    <pre style="font-size: 11px; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; max-height: 150px; overflow-y: auto;"><?php print_r(array_slice($companyC_users, 0, 2)); ?></pre>
                </div>
            <?php else: ?>
                <div style="margin-top: 10px; color: red;">
                    <strong>Company C Debug Details:</strong><br>
                    <div style="font-size: 11px; background: #f8f9fa; padding: 10px; border: 1px solid #ddd; overflow-x: auto;">
                        <strong>HTTP Code:</strong> <?php echo $companyC_debug['http_code']; ?><br>
                        <strong>Curl Error:</strong> <?php echo $companyC_debug['curl_error'] ?: 'None'; ?><br>
                        <strong>Response Length:</strong> <?php echo $companyC_debug['response_length']; ?> bytes<br>
                        <strong>JSON Error:</strong> <?php echo $companyC_debug['json_error'] ?: 'None'; ?> (Code: <?php echo $companyC_debug['json_error_code']; ?>)<br>
                        <strong>Response (first 500 chars):</strong><br>
                        <pre style="white-space: pre-wrap; word-wrap: break-word;"><?php echo htmlspecialchars(substr($companyC_debug['response_full'], 0, 500)); ?></pre>
                        <strong>Decoded Data Keys:</strong> <?php echo $companyC_debug['decoded_data_keys'] ? implode(', ', $companyC_debug['decoded_data_keys']) : 'None'; ?><br>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div style="text-align: right; margin-bottom: 10px;">
            <a href="?debug=1" style="font-size: 12px; color: #666; text-decoration: none;">Show Debug Info</a>
        </div>
        <?php endif; ?>
        
        <?php /* Notice commented out - code handles blocked companies gracefully
        <?php if ($companyB_blocked || $companyC_blocked): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 20px 0; border: 1px solid #f5c6cb; border-radius: 5px;">
                <strong>⚠️ Notice:</strong> Some company user data is currently unavailable.
                <?php if ($companyB_blocked): ?>
                    <br><br><strong>Company B:</strong> The API is protected by DDoS protection that requires JavaScript execution.
                <?php endif; ?>
                <?php if ($companyC_blocked): ?>
                    <br><br><strong>Company C:</strong> The API is protected by DDoS protection that requires JavaScript execution.
                <?php endif; ?>
                <br><br>
                <strong>Possible solutions:</strong>
                <ul style="margin: 10px 0 0 20px;">
                    <li>Contact the API provider to whitelist your server IP address</li>
                    <li>Use a headless browser solution (Puppeteer/Playwright) to execute JavaScript</li>
                    <?php if ($companyB_blocked): ?>
                        <li>Access Company B API directly: <a href="<?php echo htmlspecialchars($companyB_url); ?>" target="_blank"><?php echo htmlspecialchars($companyB_url); ?></a></li>
                    <?php endif; ?>
                    <?php if ($companyC_blocked): ?>
                        <li>Access Company C API directly: <a href="<?php echo htmlspecialchars($companyC_url); ?>" target="_blank"><?php echo htmlspecialchars($companyC_url); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        */ ?>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($allUsers) > 0): ?>
                    <?php foreach ($allUsers as $user): ?>
                        <?php if (is_array($user)): // Safety check to ensure user is an array ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($user['username'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                            <td>
                                <span class="company-badge company-<?php echo strtolower($user['company'] ?? 'unknown'); ?>">
                                    <?php echo htmlspecialchars($user['company'] ?? 'Unknown'); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px; color: #999;">
                            No users found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>