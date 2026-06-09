<?php
require_once '../classes/User.php';
require_once '../classes/Child.php';

$user = new User();
if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$child = new Child();
$childrenResult = $child->read();
$totalChildren = $childrenResult->num_rows;   // broji koliko dece ima
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="display-4">🌈 Dobrodošli u Vrtić Sunce! 🌈</h1>
        <p class="lead">Dragi <?= htmlspecialchars($_SESSION['username']); ?>, hajde da pratimo naše mališane! 🥰</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 text-center border-0" style="background: #a8e6cf;">
                <div class="card-body py-5">
                    <h1 class="display-1">👦</h1>
                    <h3>Upravljanje decom</h3>
                    <a href="children.php" class="btn btn-success btn-lg mt-3">Idi na Decu →</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0" style="background: #ffd93d;">
                <div class="card-body py-5">
                    <h1 class="display-1">👨‍👩‍👧‍👦</h1>
                    <h3>Broj dece u vrtiću</h3>
                    <h2 class="mt-3 display-2 fw-bold text-danger"><?= $totalChildren ?></h2>
                    <p class="text-muted">mališana trenutno</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 text-center border-0" style="background: #ff6b6b;">
                <div class="card-body py-5">
                    <h1 class="display-1">🚪</h1>
                    <h3>Odjava</h3>
                    <a href="logout.php" class="btn btn-light btn-lg mt-3">Odjavi se</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>