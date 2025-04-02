<?php
require_once '../../controllers/UserController.php';
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $userController->createUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
    } elseif (isset($_POST['update'])) {
        $userController->updateUser($_POST['id'], $_POST['username'], $_POST['email'], $_POST['role']);
    } elseif (isset($_POST['delete'])) {
        $userController->deleteUser($_POST['id']);
    }
}

$users = $userController->readUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .table-responsive {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .form-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .form-inline .form-group {
            margin-bottom: 0;
            flex: 1;
            min-width: 200px;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .btn-update {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-delete:hover {
            background-color:rgb(249, 23, 7);
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1 class="h4 mb-0">Manage Users</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="role" class="form-select" required>
                                        <option value="admin">Admin</option>
                                        <option value="guest">Guest</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="create" class="btn btn-primary w-100">Create User</button>
                                </div>
                            </div>
                        </form>

                        <h2 class="h5 mb-3">Existing Users</h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['role']; ?></td>
                                            <td class="action-buttons">
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control form-control-sm">
                                                        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control form-control-sm">
                                                        <select name="role" class="form-select form-select-sm">
                                                            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                            <option value="guest" <?php if ($user['role'] == 'guest') echo 'selected'; ?>>Guest</option>
                                                            <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                                                        </select>
                                                        <button type="submit" name="update" class="btn btn-update btn-sm text-white">Update</button>
                                                        
                                                        <button type="submit" name="delete" class="btn btn-delete btn-sm text-white">Delete</button>
                                                    </div>
                                                </form>
                                                <form method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                    <!-- <button type="submit" name="delete" class="btn btn-delete btn-sm text-white">Delete</button> -->
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>