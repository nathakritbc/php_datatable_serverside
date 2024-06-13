<?php
include_once "connectDB_pdo.php";

// Initialize the request variables with default values to avoid undefined index warnings
$request = array_merge([
    'start' => 0,
    'length' => 10,
    'search' => ['value' => ''],
    'order' => [['column' => 0, 'dir' => 'asc']]
], $_REQUEST);

$columns = array(
    0 => 'id',
    1 => 'first_name',
    2 => 'last_name',
    3 => 'email',
    4 => 'created_at'
);

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$totalData = $stmt->rowCount();
$totalFilter = $totalData;

$sql = "SELECT * FROM users WHERE 1=1";
if (!isset($request['search']['value'])) {
    $sql .= " AND (first_name LIKE :search OR last_name LIKE :search OR email LIKE :search)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $request['search']['value'] . '%', PDO::PARAM_STR);
    $stmt->execute();
    $totalFilter = $stmt->rowCount();
    $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . " " . $request['order'][0]['dir'];
    $sql .= " LIMIT :start, :length";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $request['search']['value'] . '%', PDO::PARAM_STR);
    $stmt->bindValue(':start', $request['start'], PDO::PARAM_INT);
    $stmt->bindValue(':length', $request['length'], PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . " " . $request['order'][0]['dir'];
    $sql .= " LIMIT :start, :length";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':start', $request['start'], PDO::PARAM_INT);
    $stmt->bindValue(':length', $request['length'], PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$json_data = array(
    "draw" => intval(@$request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFilter),
    "data" => $data
);

echo json_encode($json_data);
?>