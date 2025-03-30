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

<h1>Manage Users</h1>
<form method="POST">
    <input type="hidden" name="id" value="">
    <input type="text" name="username" placeholder="Username">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <select name="role">
        <option value="admin">Admin</option>
        <option value="guest">Guest</option>
        <option value="staff">Staff</option>
    </select>
    <button type="submit" name="create">Create User</button>
</form>

<h2>Existing Users</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="text" name="username" value="<?php echo $user['username']; ?>">
                    <input type="email" name="email" value="<?php echo $user['email']; ?>">
                    <select name="role">
                        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="guest" <?php if ($user['role'] == 'guest') echo 'selected'; ?>>Guest</option>
                        <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                    </select>
                    <button type="submit" name="update">Update</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>