<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h1 class="text-center mb-4">Manage Users</h1>
    
    <div class="card p-4 shadow-sm mb-4">
        <h4 class="mb-3">Create User</h4>
        <form method="POST" class="row g-3">
            <input type="hidden" name="id" value="">
            <div class="col-md-4">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="col-md-4">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="col-md-4">
                <select name="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="guest">Guest</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" name="create" class="btn btn-success">Create User</button>
            </div>
        </form>
    </div>
    
    <h2 class="text-center mb-3">Existing Users</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                            <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                            <select name="role" class="form-select">
                                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="guest" <?php if ($user['role'] == 'guest') echo 'selected'; ?>>Guest</option>
                                <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                            </select>
                            <button type="submit" name="update" class="btn btn-warning btn-sm mt-1">Update</button>
                        </form>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
