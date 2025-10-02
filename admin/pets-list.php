<?php 
include __DIR__ . '/../include/auth_guard.php';
include __DIR__ . '/../include/header.php';
require_once __DIR__ . '/../include/db_connection.php';

// Fetch pets
$pets = [];
if (isset($conn) && $conn instanceof mysqli) {
	$sql = "SELECT pet_id, name, type, breed, age, gender, size, status, created_at, shelter_id, owner_id FROM pets ORDER BY pet_id DESC";
	if ($res = $conn->query($sql)) {
		while ($row = $res->fetch_assoc()) {
			$pets[] = $row;
		}
		$res->free();
	}
}
?>
<div class="body-wrapper">
	<header class="app-header">
		<nav class="navbar navbar-expand-lg navbar-light">
			<ul class="navbar-nav">
				<li class="nav-item d-block d-xl-none">
					<a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
						<i class="ti ti-menu-2"></i>
					</a>
				</li>
			</ul>
		</nav>
	</header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title mb-3">Pets</h3>
						<?php if (empty($pets)): ?>
							<p class="mb-0 text-muted">No pets found.</p>
						<?php else: ?>
							<div class="table-responsive">
								<table class="table align-middle">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Type</th>
											<th>Breed</th>
											<th>Age</th>
											<th>Gender</th>
											<th>Size</th>
											<th>Status</th>
											<th>Owner</th>
											<th>Shelter</th>
											<th>Created</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($pets as $p): ?>
											<tr>
												<td><?php echo (int)$p['pet_id']; ?></td>
												<td><?php echo htmlspecialchars($p['name']); ?></td>
												<td><?php echo htmlspecialchars($p['type']); ?></td>
												<td><?php echo htmlspecialchars($p['breed'] ?? ''); ?></td>
												<td><?php echo htmlspecialchars($p['age'] !== null ? (string)$p['age'] : ''); ?></td>
												<td><?php echo htmlspecialchars($p['gender'] ?? ''); ?></td>
												<td><?php echo htmlspecialchars($p['size'] ?? ''); ?></td>
												<td>
													<?php 
														$status = (string)$p['status'];
														$badge = 'bg-secondary';
														if ($status === 'available') $badge = 'bg-success';
														elseif ($status === 'adopted') $badge = 'bg-info';
														elseif ($status === 'archived') $badge = 'bg-dark';
													?>
													<span class="badge <?php echo $badge; ?> text-uppercase"><?php echo htmlspecialchars($status); ?></span>
												</td>
												<td><?php echo htmlspecialchars((string)$p['owner_id']); ?></td>
												<td><?php echo htmlspecialchars($p['shelter_id'] !== null ? (string)$p['shelter_id'] : ''); ?></td>
												<td><?php echo htmlspecialchars($p['created_at']); ?></td>
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

