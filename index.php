<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataTable Server-Side</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <h2 class="my-4 text-primary text-center">DataTable Server-Side</h2>
        <div class="px-3">
            <h4 class="my-4">User Data</h4>
            <table id="userTable" class="table border table-responsive" style="width:100%">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-head-center">ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#userTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "./server_processing_pdo.php",
            responsive: true,
            columns: [{
                    data: "id",
                    className: 'dt-body-center'
                },
                {
                    data: "first_name"
                },
                {
                    data: "last_name"
                },
                {
                    data: "email"
                },
                {
                    data: "created_at"
                },
            ],
        });
    });
    </script>
</body>

</html>