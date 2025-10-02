<?php 
// Auth first, then emit any HTML via header include
include __DIR__ . '/../include/auth_guard.php';
include __DIR__ . '/../include/header.php';
require_once __DIR__ . '/../include/db_connection.php';

// Fetch shelters list
$shelters = [];
if (isset($conn) && $conn instanceof mysqli) {
    $res = $conn->query("SELECT shelter_id, name, location, contact_info, verification_status FROM shelters ORDER BY shelter_id DESC");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $shelters[] = $row;
        }
        $res->free();
    }
}
?>

<div class="body-wrapper">
    <?php include __DIR__ . '/../include/topbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Add Shelter</h3>

                        <?php if (!empty($_GET['success'])): ?>
                            <div class="alert alert-success">Shelter saved.</div>
                        <?php elseif (!empty($_GET['error'])): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="process_add_shelter.php" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" maxlength="150" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" maxlength="255">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_info" class="form-label">Contact Info</label>
                                    <input type="text" class="form-control" id="contact_info" name="contact_info" maxlength="255" placeholder="email/phone/website">
                                </div>
                                <div class="col-md-6">
                                    <label for="verification_status" class="form-label">Verification Status</label>
                                    <select class="form-select" id="verification_status" name="verification_status">
                                        <option value="pending" selected>pending</option>
                                        <option value="verified">verified</option>
                                        <option value="rejected">rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="ti ti-check me-1"></i>Save</button>
                                <a href="./shelter.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                        <hr class="my-5">
                        <h4 class="mb-3">Shelter List</h4>
                        <?php if (empty($shelters)): ?>
                            <p class="text-muted mb-0">No shelters found.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($shelters as $s): ?>
                                            <tr>
                                                <td><?php echo (int)$s['shelter_id']; ?></td>
                                                <td><?php echo htmlspecialchars($s['name']); ?></td>
                                                <td><?php echo htmlspecialchars($s['location'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($s['contact_info'] ?? ''); ?></td>
                                                <td>
                                                    <?php 
                                                        $status = (string)$s['verification_status'];
                                                        $badge = 'bg-secondary';
                                                        if ($status === 'verified') $badge = 'bg-success';
                                                        elseif ($status === 'pending') $badge = 'bg-warning';
                                                        elseif ($status === 'rejected') $badge = 'bg-danger';
                                                    ?>
                                                    <span class="badge <?php echo $badge; ?> text-uppercase"><?php echo htmlspecialchars($status); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../include/footer.php'; ?>
