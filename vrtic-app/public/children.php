<?php
require_once '../classes/Child.php';
require_once 'header.php';

$child = new Child();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        
        if ($_POST['action'] == 'delete' && isset($_POST['id'])) {
            if ($child->delete($_POST['id'])) {
                $message = '<div class="alert alert-success">🗑️ Dete je uspešno obrisano!</div>';
            } else {
                $message = '<div class="alert alert-danger">❌ Greška pri brisanju!</div>';
            }
        } 
        elseif (($_POST['action'] == 'create' || $_POST['action'] == 'update') && isset($_POST['full_name'])) {
            $data = [
                'full_name'    => $_POST['full_name'],
                'birth_date'   => $_POST['birth_date'] ?? '',
                'parent_phone' => $_POST['parent_phone'] ?? '',
                'group_name'   => $_POST['group_name'] ?? '',
                'notes'        => $_POST['notes'] ?? ''
            ];

            if ($_POST['action'] == 'create') {
                if ($child->create($data)) {
                    $message = '<div class="alert alert-success">🎉 Dete je uspešno dodato!</div>';
                }
            } else { // update
                if (isset($_POST['id']) && $child->update($_POST['id'], $data)) {
                    $message = '<div class="alert alert-success">✏️ Podaci su izmenjeni!</div>';
                }
            }
        }
    }
}

$children = $child->read();
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">👦 Naša Deca u Vrtiću 🌈</h2>
    <?= $message ?>

    <button class="btn btn-success btn-lg mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        ➕ Dodaj novo dete
    </button>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>👤 Ime i prezime</th>
                        <th>📅 Rođenje</th>
                        <th>📱 Roditelj</th>
                        <th>🏠 Grupa</th>
                        <th>🔧 Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $children->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($row['full_name']) ?></strong></td>
                        <td><?= $row['birth_date'] ?></td>
                        <td><?= htmlspecialchars($row['parent_phone'] ?? '') ?></td>
                        <td><span class="badge bg-info"><?= htmlspecialchars($row['group_name'] ?? '') ?></span></td>
                        <td>
                            <button class="btn btn-warning btn-sm me-1" 
                                    onclick="editChild(<?= $row['id'] ?>, 
                                    '<?= addslashes($row['full_name']) ?>', 
                                    '<?= $row['birth_date'] ?>', 
                                    '<?= addslashes($row['parent_phone'] ?? '') ?>', 
                                    '<?= addslashes($row['group_name'] ?? '') ?>', 
                                    '<?= addslashes($row['notes'] ?? '') ?>')">
                                ✏️ Izmeni
                            </button>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('🗑️ Da li sigurno želite da obrišete ovo dete?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Obriši</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal za dodavanje/izmenu -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">👶 Dodaj / Izmeni dete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="create" id="modalAction">
                    <input type="hidden" name="id" id="editId">

                    <div class="mb-3">
                        <label>👤 Ime i prezime</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>📅 Datum rođenja</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>📱 Telefon roditelja</label>
                        <input type="text" name="parent_phone" id="parent_phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>🏠 Grupa</label>
                        <input type="text" name="group_name" id="group_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>📝 Napomene</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">💾 Sačuvaj</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editChild(id, name, birth, phone, group, notes) {
    document.getElementById('modalAction').value = 'update';
    document.getElementById('editId').value = id;
    document.getElementById('full_name').value = name;
    document.getElementById('birth_date').value = birth;
    document.getElementById('parent_phone').value = phone;
    document.getElementById('group_name').value = group;
    document.getElementById('notes').value = notes;
    new bootstrap.Modal(document.getElementById('addModal')).show();
}
</script>
</body>
</html>