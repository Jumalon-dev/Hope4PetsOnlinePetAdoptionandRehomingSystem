<?php 
include __DIR__ . '/../include/auth_guard.php';
include __DIR__ . '/../include/header.php';
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
						<h3 class="card-title mb-0">Reports</h3>
						<p class="mb-0 text-muted">Coming soon: adoption stats, appointments, and donations overview.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include __DIR__ . '/../include/footer.php'; ?>

