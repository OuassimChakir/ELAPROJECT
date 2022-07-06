    		<!-- LEFT MAIN SIDEBAR -->
			<div class="ec-left-sidebar ec-bg-sidebar">
				<div id="sidebar" class="sidebar ec-sidebar-footer">
	
					<div class="ec-brand">
						<a href="{{ route('acceuil') }}" title="Medinata">
							<img class="ec-brand-icon" src="{{asset('images/Logo/logo.webp')}}" alt="" />
							<span class="ec-brand-name text-truncate">Easy Learn Academy</span>
						</a>
					</div>
	
					<!-- begin sidebar scrollbar -->
					<div class="ec-navigation" data-simplebar>
						<!-- sidebar menu -->
						<ul class="nav sidebar-inner" id="sidebar-menu">
							<!-- Dashboard -->
							<li class="active">
								<a class="sidenav-item-link" href="{{ route('acceuil') }}">
									<i class="bi bi-house-door-fill"></i>
									<span class="nav-text">Acceuil</span>
								</a>
								<hr>
							</li>
	
							<!-- Persons -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Professeurs</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="users" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="#">
												<span class="nav-text">Liste des Professeurs</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Etudiants</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="users" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="#">
												<span class="nav-text">Liste des Etudiants</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Staff</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="users" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="{{url('/staff')}}">
												<span class="nav-text">Liste des Staff</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
	
	
							{{-- School --}}
							<!-- Attendance -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-calendar2-check-fill"></i>
									<span class="nav-text">Presence</span><b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="#">
												<span class="nav-text">Main Category</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="#">
												<span class="nav-text">Sub Category</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Groupes -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-list-stars"></i>
									<span class="nav-text">Groupes</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="#">
												<span class="nav-text">Add</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Subjects -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-book-fill"></i>
									<span class="nav-text">Matières</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="{{route('subjects')}}">
												<span class="nav-text">Matières</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="{{route('courseType')}}">
												<span class="nav-text">Types de Formations</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Grades -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-list-ol"></i>
									<span class="nav-text">Niveaux</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="{{ route('grades') }}">
												<span class="nav-text">Niveaux Scolaires</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="{{ route('gradesCategory') }}">
												<span class="nav-text">Categories des Niveaux</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
	
							<!-- Expenses -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-wallet2"></i>
									<span class="nav-text">Dépenses</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="order-history.html">
												<span class="nav-text">Liste de Commandes</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="order-detail.html">
												<span class="nav-text">Detail du Commandes</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="invoice.html">
												<span class="nav-text">Factures</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Incomes -->
							<li class="has-sub">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-cash-stack"></i>
									<span class="nav-text">Revenus</span> <b class="caret"></b>
								</a>
								<div class="collapse">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="">
											<a class="sidenav-item-link" href="order-history.html">
												<span class="nav-text">Liste de Commandes</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="order-detail.html">
												<span class="nav-text">Detail du Commandes</span>
											</a>
										</li>
										<li class="">
											<a class="sidenav-item-link" href="invoice.html">
												<span class="nav-text">Factures</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
							
							<!-- Deconnexion -->
							<li>
								<a class="sidenav-item-link" href="review-list.html">
									<i class="bi bi-box-arrow-left"></i>
									<span class="nav-text">Deconnexion</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
	
	
	