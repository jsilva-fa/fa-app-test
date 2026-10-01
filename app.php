<?php
// Training fixture only.
declare(strict_types=1);

header('Content-Type: application/json');

$pdo = new PDO(
    'mysql:host=' . (getenv('DB_HOST') ?: '127.0.0.1') . ';dbname=banking',
    getenv('DB_USER') ?: 'app',
    getenv('DB_PASSWORD') ?: '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$accountId = $_GET['account_id'] ?? '';

if ($accountId === '') {
    http_response_code(400);
    echo json_encode(['error' => 'account_id is required']);
    exit;
}

// Vulnerable: attacker-controlled input is concatenated into SQL.
$sql = "
    SELECT account_id, account_name, balance, currency
    FROM customer_accounts
    WHERE account_id = '$accountId'
";

$statement = $pdo->query($sql);
$account = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    'account' => $account ?: null,
]);
