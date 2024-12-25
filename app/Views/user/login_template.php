<!DOCTYPE html>
<html lang="en">

<head>
	<title>Ticket Management System</title>
	<meta charset="utf-8" />
	<meta name="description"
		content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords"
		content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title"
		content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
	<meta property="og:site_name" content="Ticket Management System" />
	<link rel="shortcut icon" href="<?= base_url('public/assets/media/auth/logo-corporate-5.png') ?>" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<?= link_tag("public/assets/plugins/global/plugins.bundle.css") ?>
	<?= link_tag("public/assets/css/style.bundle.css") ?>
	<?= link_tag("public/assets/js/toastr/jquery.toast.css") ?>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
	<script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<style>
			body {
				background-image: url('<?= base_url('public/assets/media/auth/bg2.jpg') ?>');
			}

			[data-bs-theme="dark"] body {
				background-image: url('<?= base_url('public/assets/media/auth/bg10-dark.jpeg') ?>');
			}
		</style>
		<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-10">
			<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-500px p-10"
				style="margin-top: 35px;margin-right: 35px;">
				<div class="d-flex flex-center flex-column align-items-stretch h-lg-100" style="width: 400px;">

					<div class="d-flex flex-center flex-column flex-column-fluid">
						<form class="form w-100" method="post" action="<?= base_url('login') ?>">

							<div class="text-center mb-3">
								<h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
								<div class="text-gray-500 fw-semibold fs-6">Ticket Management System</div>
							</div>
							<div class="text-center">
								<img class="theme-light-show mx-auto mw-100 w-150px w-lg-150px"
									src="<?= base_url('public/assets/media/auth/logo-corporate-5.png') ?>" alt="" />
							</div>
							<div class="separator separator-content my-8">
								<span class="w-200px text-gray-500 fw-semibold fs-7">Fill Your Credentials</span>
							</div>
							<div class="fv-row mb-8">
								<input type="text" placeholder="Phone Number" value="<?= old('userid'); ?>"
									maxlength="10" name="userid" class="form-control " />
								<div class="text-danger">
									<?= session()->get('errors')['userid'] ?? '' ?>
								</div>
							</div>
							<div class="fv-row mb-3">
								<input type="password" placeholder="Password" value="<?= old('password'); ?>"
									name="password" class="form-control " />
								<div class="text-danger">
									<?= session()->get('errors')['password'] ?? '' ?>
								</div>
							</div>
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
								<div></div>
								<a href="#" class="link-primary">Forgot Password ?</a>
							</div>
							<div class="d-grid mb-5">
								<button type="submit" class="btn btn-primary"><span class="indicator-label">Login
										Now</span></button>
							</div>
							<div class="text-gray-500 text-center fw-semibold fs-6">License No. -1.0.0</div>
							<div class="text-gray-500 text-center fw-semibold mt-3"><img
									class="theme-light-show mx-auto" style="height: 30px;margin-top: -10px;"
									src="<?= base_url('public/assets/media/gif/giphy.gif') ?>" alt="" />Tips : <span
									id="textcontent">Use the correct priority level for tickets to ensure timely
									handling.</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('public/assets/plugins/global/plugins.bundle.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/scripts.bundle.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/custom/authentication/sign-in/general.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/jquery-3.6.0.min.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/toastr/jquery.toast.js') ?>"></script>
</body>

</html>
<script>
	<?php if (session()->getFlashdata('msg')) {
		$msg = session()->getFlashdata('msg');
		if ($msg["status"] == 1) {
			?>
			$.toast({
				heading: "Success",
				text: "<?= $msg['message'] ?>",
				showHideTransition: "fade",
				position: "top-right",
				icon: "success",
				loader: true,
				hideAfter: 3000
			});
		<?php } else { ?>
			$.toast({
				heading: "Warning",
				text: "<?= $msg['message'] ?>",
				showHideTransition: "fade",
				position: "top-right",
				icon: "error",
				loader: true,
				hideAfter: 3000
			});
		<?php } ?>
	<?php } ?>
</script>