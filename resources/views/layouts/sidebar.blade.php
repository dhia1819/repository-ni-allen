<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="/images/archive.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link {{($page['name'] == "Dashboard") ? 'active' : ''}}" href="/home">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
						<i class="fa fa-chart-bar"></i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			<li class="nav-item mt-3">
					<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Inventory</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link {{($page['name'] == "Equipment") ? 'active' : ''}}" href="/equipment">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
						<i class="fa fa-toolbox"></i>
					</div>
					<span class="nav-link-text ms-1"> All Equipment</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{($page['name'] == "Borrowed") ? 'active' : ''}}" href="{{ route('return') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
						<i class="fa fa-reply"></i>
					</div>
					<span class="nav-link-text ms-1">Borrowed</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{($page['name'] == "History") ? 'active' : ''}}" href="{{ route('history') }}">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
						<i class="fa fa-scroll"></i>
					</div>
					<span class="nav-link-text ms-1">History</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">REFERENCE LIBRARY</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link {{($page['name'] == "Category") ? 'active' : ''}}" href="/category">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
						<i class="fa fa-folder"></i>
					</div>
					<span class="nav-link-text ms-1">Equipment Category</span>
				</a>
				<li class="nav-item">
					<a class="nav-link {{($page['name'] == "Office") ? 'active' : ''}}" href="/office">
						<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
							<i class="fa fa-building"></i>
						</div>
						<span class="nav-link-text ms-1">Office</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{($page['name'] == "Employees") ? 'active' : ''}}" href="/employee">
						<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
							<i class="fa fa-id-badge"></i>
						</div>
						<span class="nav-link-text ms-1">Employees</span>
					</a>
				</li>
			</li>
			

			@if(in_array(Auth::user()->classification_id, [1,2]))
				<li class="nav-item mt-3">
					<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ADMINISTRATION</h6>
				</li>

				<li class="nav-item">
					<a class="nav-link {{($page['name'] == "Users") ? 'active' : ''}}" href="/users">
						<div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-info text-center me-2 pb-3 d-flex align-items-center justify-content-center">
							<i class="fa fa-users"></i>
						</div>
						<span class="nav-link-text ms-1">Users</span>
					</a>
				</li>
				
				
			@endif

		</ul>
    </div>
    <div class="sidenav-footer mx-3 ">
		<div class="card card-background shadow-none card-background-mask-info" id="sidenavCard">

			<div class="full-background" style="background-image: url('/vendor/soft_ui/assets/img/curved-images/curved14.jpg')">
				<span class="mask bg-gradient-info" style="border-radius: 12px"></span>
			</div>
			<div class="card-body text-start p-3 w-100">
				<img src="/images/laguna_logo.png" class="navbar-brand-img mb-3" alt="main_logo" aria-hidden="true" id="sidenavCardIcon">

				<div class="docs-info">
					<p class="text-white up mb-0">Copyright 2023</p>
					<p class="text-xs">All Rigts Reserved.</p>
					<a href="https://laguna.gov.ph" target="_blank" class="btn btn-white btn-sm w-100 mb-0">PGL-MISO</a>
				</div>
			</div>
			
		</div>
    </div>
</aside>