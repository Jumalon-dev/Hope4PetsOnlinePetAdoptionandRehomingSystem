<?php 
// Require authenticated session and shared layout
include __DIR__ . '/../include/auth_guard.php';
include __DIR__ . '/../include/header.php';

require_once __DIR__ . '/../include/db_connection.php';
// --- Insert handling for Add Pet form ---

// Ensure CSRF token exists
if (empty($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Helper for optional text fields
function optional_text(?string $v): ?string {
	$v = isset($v) ? trim($v) : null;
	return ($v === '' ? null : $v);
}

// State
$errors = [];
$success = null;

// Default form model used to repopulate on validation errors
$form = [
	'shelter_id' => '',
	'name' => '',
	'type' => '',
	'breed' => '',
	'age' => '',
	'gender' => 'unknown',
	'size' => 'medium',
	'health_status' => '',
	'vaccination_status' => '',
	'special_needs' => '',
	'status' => 'available',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// CSRF
	if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
		$errors[] = 'Invalid CSRF token. Please refresh and try again.';
	}

	// Collect
	$form['shelter_id'] = isset($_POST['shelter_id']) ? trim($_POST['shelter_id']) : '';
	$form['name'] = isset($_POST['name']) ? trim($_POST['name']) : '';
	$form['type'] = isset($_POST['type']) ? trim($_POST['type']) : '';
	$form['breed'] = isset($_POST['breed']) ? trim($_POST['breed']) : '';
	$form['age'] = isset($_POST['age']) ? trim($_POST['age']) : '';
	$form['gender'] = isset($_POST['gender']) ? trim($_POST['gender']) : 'unknown';
	$form['size'] = isset($_POST['size']) ? trim($_POST['size']) : 'medium';
	$form['health_status'] = isset($_POST['health_status']) ? trim($_POST['health_status']) : '';
	$form['vaccination_status'] = isset($_POST['vaccination_status']) ? trim($_POST['vaccination_status']) : '';
	$form['special_needs'] = isset($_POST['special_needs']) ? trim($_POST['special_needs']) : '';
	$form['status'] = isset($_POST['status']) ? trim($_POST['status']) : 'available';

	// Validate required and enums
	if ($form['name'] === '') {
		$errors[] = 'Name is required.';
	} elseif (mb_strlen($form['name']) > 100) {
		$errors[] = 'Name must be at most 100 characters.';
	}

	if ($form['type'] === '') {
		$errors[] = 'Type is required.';
	} elseif (mb_strlen($form['type']) > 50) {
		$errors[] = 'Type must be at most 50 characters.';
	}

	$allowedGenders = ['male','female','unknown'];
	if (!in_array($form['gender'], $allowedGenders, true)) {
		$errors[] = 'Invalid gender selected.';
	}

	$allowedSizes = ['small','medium','large'];
	if (!in_array($form['size'], $allowedSizes, true)) {
		$errors[] = 'Invalid size selected.';
	}

	$allowedStatus = ['available','adopted','archived'];
	if (!in_array($form['status'], $allowedStatus, true)) {
		$errors[] = 'Invalid status selected.';
	}

	// Numeric checks
	$owner_id = (int)($_SESSION['user_id'] ?? 0);
	if ($owner_id <= 0) {
		$errors[] = 'Invalid session. Please log in again.';
	}

	$shelter_id = null;
	if ($form['shelter_id'] !== '') {
		if (!ctype_digit($form['shelter_id'])) {
			$errors[] = 'Shelter ID must be a positive number.';
		} else {
			$shelter_id = (int)$form['shelter_id'];
			if ($shelter_id <= 0) {
				$errors[] = 'Shelter ID must be greater than zero.';
			}
		}
	}

	$age = null;
	if ($form['age'] !== '') {
		if (!ctype_digit($form['age'])) {
			$errors[] = 'Age must be a non-negative integer.';
		} else {
			$age = (int)$form['age'];
		}
	}

	// Optional field lengths
	if ($form['breed'] !== '' && mb_strlen($form['breed']) > 100) {
		$errors[] = 'Breed must be at most 100 characters.';
	}
	if ($form['health_status'] !== '' && mb_strlen($form['health_status']) > 255) {
		$errors[] = 'Health status must be at most 255 characters.';
	}
	if ($form['vaccination_status'] !== '' && mb_strlen($form['vaccination_status']) > 255) {
		$errors[] = 'Vaccination status must be at most 255 characters.';
	}

	// Insert
	if (!$errors) {
		$name = $form['name'];
		$type = $form['type'];
		$breed = optional_text($form['breed']);
		$gender = $form['gender'];
		$size = $form['size'];
		$health_status = optional_text($form['health_status']);
		$vaccination_status = optional_text($form['vaccination_status']);
		$special_needs = optional_text($form['special_needs']);
		$status = $form['status'];

		$stmt = $conn->prepare("INSERT INTO pets (owner_id, shelter_id, name, type, breed, age, gender, size, health_status, vaccination_status, special_needs, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
		if (!$stmt) {
			$errors[] = 'Database error: failed to prepare statement.';
		} else {
			$stmt->bind_param(
				'iisssissssss',
				$owner_id,
				$shelter_id,
				$name,
				$type,
				$breed,
				$age,
				$gender,
				$size,
				$health_status,
				$vaccination_status,
				$special_needs,
				$status
			);

			if ($stmt->execute()) {
				$success = 'Pet added successfully.';
				// Reset form
				$form = [
					'shelter_id' => '',
					'name' => '',
					'type' => '',
					'breed' => '',
					'age' => '',
					'gender' => 'unknown',
					'size' => 'medium',
					'health_status' => '',
					'vaccination_status' => '',
					'special_needs' => '',
					'status' => 'available',
				];
			} else {
				$errors[] = 'Failed to add pet. Please try again.';
			}
			$stmt->close();
		}
	}
}
?>



<div class="body-wrapper">
	<?php 
		// Include topbar using an absolute path to avoid relative path issues
		include __DIR__ . '/../include/topbar.php';
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title mb-4">Add Pet</h3>

						<?php if ($success): ?>
							<div class="alert alert-success" role="alert"><?php echo htmlspecialchars($success); ?></div>
						<?php endif; ?>
						<?php if ($errors): ?>
							<div class="alert alert-danger" role="alert">
								<ul class="mb-0">
									<?php foreach ($errors as $e): ?>
										<li><?php echo htmlspecialchars($e); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<form method="post" action="" novalidate>
							<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

							<div class="row g-3">
								<div class="col-md-3">
									<label for="shelter_id" class="form-label">Shelter ID (optional)</label>
									<input type="number" min="1" class="form-control" id="shelter_id" name="shelter_id" value="<?php echo htmlspecialchars($form['shelter_id']); ?>" placeholder="e.g., 5">
								</div>
								<div class="col-md-5">
									<label for="name" class="form-label">Name<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" id="name" name="name" maxlength="100" required value="<?php echo htmlspecialchars($form['name']); ?>" placeholder="e.g., Bella">
								</div>
								<div class="col-md-4">
									<label for="type" class="form-label">Type<span class="text-danger"> *</span></label>
									<input type="text" class="form-control" id="type" name="type" maxlength="50" required value="<?php echo htmlspecialchars($form['type']); ?>" placeholder="e.g., Dog">
								</div>

								<div class="col-md-4">
									<label for="breed" class="form-label">Breed</label>
									<input type="text" class="form-control" id="breed" name="breed" maxlength="100" value="<?php echo htmlspecialchars($form['breed']); ?>" placeholder="e.g., Labrador Retriever">
								</div>
								<div class="col-md-2">
									<label for="age" class="form-label">Age (years)</label>
									<input type="number" min="0" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($form['age']); ?>" placeholder="e.g., 3">
								</div>
								<div class="col-md-3">
									<label for="gender" class="form-label">Gender</label>
									<select class="form-select" id="gender" name="gender">
										<?php foreach (['male'=>'Male','female'=>'Female','unknown'=>'Unknown'] as $val=>$label): ?>
											<option value="<?php echo $val; ?>" <?php echo ($form['gender']===$val? 'selected' : ''); ?>><?php echo $label; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-3">
									<label for="size" class="form-label">Size</label>
									<select class="form-select" id="size" name="size">
										<?php foreach (['small'=>'Small','medium'=>'Medium','large'=>'Large'] as $val=>$label): ?>
											<option value="<?php echo $val; ?>" <?php echo ($form['size']===$val? 'selected' : ''); ?>><?php echo $label; ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-md-6">
									<label for="health_status" class="form-label">Health Status</label>
									<input type="text" class="form-control" id="health_status" name="health_status" maxlength="255" value="<?php echo htmlspecialchars($form['health_status']); ?>" placeholder="e.g., Spayed/Neutered, Healthy">
								</div>
								<div class="col-md-6">
									<label for="vaccination_status" class="form-label">Vaccination Status</label>
									<input type="text" class="form-control" id="vaccination_status" name="vaccination_status" maxlength="255" value="<?php echo htmlspecialchars($form['vaccination_status']); ?>" placeholder="e.g., Up-to-date">
								</div>

								<div class="col-12">
									<label for="special_needs" class="form-label">Special Needs</label>
									<textarea class="form-control" id="special_needs" name="special_needs" rows="3" placeholder="Describe any special needs..."><?php echo htmlspecialchars($form['special_needs']); ?></textarea>
								</div>

								<div class="col-md-3">
									<label for="status" class="form-label">Status</label>
									<select class="form-select" id="status" name="status">
										<?php foreach (['available'=>'Available','adopted'=>'Adopted','archived'=>'Archived'] as $val=>$label): ?>
											<option value="<?php echo $val; ?>" <?php echo ($form['status']===$val? 'selected' : ''); ?>><?php echo $label; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="mt-4 d-flex gap-2">
								<button type="submit" class="btn btn-primary"><i class="ti ti-check me-1"></i>Save Pet</button>
								<a href="./pets-list.php" class="btn btn-secondary">Cancel</a>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include __DIR__ . '/../include/footer.php'; ?>
// End of add-pet.php

