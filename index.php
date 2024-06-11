<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DataTables Server-side Processing</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Server-side Processing with DataTables</h2>
        <table id="userTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "server_processing.php",
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "created_at"
                }
            ]
        });
    });
    </script>

</body>

</html>