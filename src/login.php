<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: users.php");
            exit;
        } else {
            $_SESSION['message'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['message'] = "Usuario no encontrado.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Iniciar sesión</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
</div>
</body>
</html>
