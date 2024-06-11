<?php
 
include_once('connectDB.php');

// Retrieve the request parameters
$request = $_REQUEST;

// Columns array
$columns = array(
    0 => 'id',
    1 => 'first_name',
    2 => 'last_name',
    3 => 'email',
    4 => 'created_at'
);

// Build the query
$sql = "SELECT * FROM users";
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = "SELECT * FROM users WHERE 1=1";

// ฟังชั่นค้นหา
if (!empty($request['search']['value'])) {
    $sql .= " AND (first_name LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR last_name LIKE '%" . $request['search']['value'] . "%' ";
    $sql .= " OR email LIKE '%" . $request['search']['value'] . "%')";
}
$query = mysqli_query($conn, $sql);
$totalFiltered = mysqli_num_rows($query);

$orderColumnIndex = isset($request['order'][0]['column']) ? $request['order'][0]['column'] : 0;
$orderDirection = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc';
$start = isset($request['start']) ? $request['start'] : 0;
$length = isset($request['length']) ? $request['length'] : 10;

$sql .= " ORDER BY " . $columns[$orderColumnIndex] . " " . $orderDirection . " LIMIT " . $start . ", " . $length;
$query = mysqli_query($conn, $sql);

if (!$query) {
    die('Error in query: ' . mysqli_error($conn));
}

$data = array();
while ($row = mysqli_fetch_assoc($query)) {
    $nestedData = array();
    $nestedData['id'] = $row["id"];
    $nestedData['first_name'] = $row["first_name"];
    $nestedData['last_name'] = $row["last_name"];
    $nestedData['email'] = $row["email"];
    $nestedData['created_at'] = $row["created_at"];
    $data[] = $nestedData;
}

$draw = isset($request['draw']) ? intval($request['draw']) : 0;

$json_data = array(
    "draw" => $draw,
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);
?>