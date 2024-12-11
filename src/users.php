<?php
session_start();
include 'db.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtener los usuarios
$result = $conn->query("SELECT username FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Usuarios</h2>

    <a href="logout.php" class="btn btn-danger mb-3">Cerrar sesión</a>

    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['username']); ?></h5>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
