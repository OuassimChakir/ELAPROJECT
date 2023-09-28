    		<!-- LEFT MAIN SIDEBAR -->
			<div class="ec-left-sidebar ec-bg-sidebar">
				<div id="sidebar" class="sidebar ec-sidebar-footer">
	
					<div class="ec-brand">
						<a href="{{ route('acceuil') }}" title="BMA">
							<img src="{{asset('images/Logo/icon.png')}}" id="brandlogo" alt="" />
							<span class="ec-brand-name text-truncate">BMA School</span>
						</a>
					</div>
	
					<!-- begin sidebar scrollbar -->
					<div class="ec-navigation" data-simplebar>
						<!-- sidebar menu -->
						<ul class="nav sidebar-inner" id="sidebar-menu">
							<!-- Dashboard -->
							<li class="{{ Route::is('acceuil') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{ route('acceuil') }}">
									<i class="bi bi-house-door-fill"></i>
									<span class="nav-text">Acceuil</span>
								</a>
								<hr>
							</li>
	
							@staff
							<!-- Persons -->
							<li class="{{ Route::is('teachers.liste') ||Route::is('teachers.profil') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('teachers.liste')}}">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Professeurs</span>
								</a>
							</li>
							<li class="{{ Route::is('student.liste') ||Route::is('student.profil') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('student.liste')}}">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Etudiants</span>
								</a>
							</li>
							@endstaff
							@notadmin
								@staff
								<li class="{{Route::is('staff.profil') ? 'active' : ''}}">
									<a class="sidenav-item-link" href="{{route('staff.profil',['idStaff' => auth()->user()->idStaff])}}">
										<i class="bi bi-people-fill"></i>
										<span class="nav-text">Espace Staff</span>
									</a>
								</li>
								@endstaff

								@onlyteacher
								<li class="{{Route::is('teachers.profil') ? 'active' : ''}}">
									<a class="sidenav-item-link" href="{{route('teachers.profil',['idProfesseur' => auth()->user()->idProfesseur])}}">
										<i class="bi bi-people-fill"></i>
										<span class="nav-text">Espace Enseignant</span>
									</a>
								</li>
								@endonlyteacher

								@onlystudent
								<li class="{{ Route::is('student.profil') ? 'active' : ''}}">
									<a class="sidenav-item-link" href="{{route('student.profil',['idStudent' => auth()->user()->idStudent])}}">
										<i class="bi bi-people-fill"></i>
										<span class="nav-text">Espace Etudiant</span>
									</a>
								</li>
								@endonlystudent
							@endnotadmin
							@admin
							<li class="has-sub {{ Route::is('staff.liste') || Route::is('specialite') || Route::is('specialite.update') || Route::is('staff.profil') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Staff</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('staff.liste') || Route::is('specialite') || Route::is('specialite.update') || Route::is('staff.profil') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
										<li class="{{ Route::is('staff.liste') || Route::is('staff.profil') ? 'active' : '' }}">
											<a class="sidenav-item-link" href="{{route('staff.liste')}}">
												<span class="nav-text">Staff Listes</span>
											</a>
										</li>
										<li class="{{ Route::is('specialite') || Route::is('specialite.update')  ? 'active' : '' }}">
											<a class="sidenav-item-link" href="{{route('specialite')}}">
												<span class="nav-text">Spécialitées</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="has-sub {{ Route::is('roles') || Route::is('users') ||
							Route::is('profile.show') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-people-fill"></i>
									<span class="nav-text">Utilisateurs</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('roles') || Route::is('users') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
										<li class="{{ Route::is('roles') ? 'active' : '' }}">
											<a class="sidenav-item-link" href="{{route('roles')}}">
												<span class="nav-text">Roles</span>
											</a>
										</li>
										<li class="{{ Route::is('users') ? 'active' : '' }}">
											<a class="sidenav-item-link" href="{{route('users')}}">
												<span class="nav-text">Listes des Utilisateurs</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							@endadmin
							<hr>
							<!-- Subjects -->
							
	
							{{-- School --}}
							<!-- Attendance -->
							<li class="{{ Route::is('absence')  ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('absence')}}">
									<i class="bi bi-calendar2-check-fill"></i>
									<span class="nav-text">Presence</span>
								</a>
							</li>
							<!-- Groupes -->
							<li class="{{ Route::is('groups') || Route::is('groups.profil')
							|| Route::is('groups.getData')  ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('groups')}}">
									<i class="bi bi-list-stars"></i>
									<span class="nav-text">Groupes</span>
								</a>
							</li>
							@staff
							<!-- Subjects -->
							<li class="has-sub {{ Route::is('subjects') || Route::is('courseType') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-book-fill"></i>
									<span class="nav-text">Matières</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('subjects') || Route::is('courseType') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
										<li class="{{ Route::is('subjects') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('subjects')}}">
												<span class="nav-text">Matières</span>
											</a>
										</li>
										<li class="{{ Route::is('courseType') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('courseType')}}">
												<span class="nav-text">Types de Formations</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Grades -->
							<li class="has-sub {{ Route::is('grades') || Route::is('gradesCategory') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-list-ol"></i>
									<span class="nav-text">Niveaux</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('grades') || Route::is('gradesCategory') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="{{Route::is('grades') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{ route('grades') }}">
												<span class="nav-text">Niveaux</span>
											</a>
										</li>
										<li class="{{Route::is('gradesCategory') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{ route('gradesCategory') }}">
												<span class="nav-text">Categories des Niveaux</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
							@endstaff
							<!-- Expenses -->
							@admin
							<li class="has-sub {{ Route::is('typeDepenses') || Route::is('factureDepenses') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-wallet2"></i>
									<span class="nav-text">Dépenses</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('typeDepenses') || Route::is('factureDepenses') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="{{ Route::is('typeDepenses') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('typeDepenses')}}">
												<span class="nav-text">Types de Dépenses</span>
											</a>
										</li>
										<li class="{{Route::is('factureDepenses') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('factureDepenses')}}">
												<span class="nav-text">Factures</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- Incomes -->
							<li class="has-sub {{ Route::is('typeIncome') || Route::is('incomePayment') || Route::is('incomes.stats') ? 'active expand' : ''}}">
								<a class="sidenav-item-link" href="javascript:void(0)">
									<i class="bi bi-cash-stack"></i>
									<span class="nav-text">Revenus</span> <b class="caret"></b>
								</a>
								<div class="collapse {{ Route::is('typeIncome') || Route::is('incomePayment') ? 'show' : 'collapsed'}}">
									<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
										<li class="{{ Route::is('typeIncome') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('typeIncome')}}">
												<span class="nav-text">Types de Revenus</span>
											</a>
										</li>
										<li class="{{Route::is('incomePayment') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('incomePayment')}}">
												<span class="nav-text">Reçus de Payment</span>
											</a>
										</li>
										<li class="{{Route::is('incomes.stats') ? 'active' : ''}}">
											<a class="sidenav-item-link" href="{{route('incomes.stats')}}">
												<span class="nav-text">Statistiques</span>
											</a>
										</li>
									</ul>
								</div>
								<hr>
							</li>
							@endadmin
							@onlystudent
							<hr>
							<li class="{{Route::is('student.incomes') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('student.incomes',['idStudent' => auth()->user()->idStudent])}}">
									<i class="mdi mdi-cash"></i>
									<span class="nav-text">Mes Paiements</span>
								</a>
							</li>
							<hr>
							@endonlystudent
							@onlyteacher
							<hr>
							<li class="{{Route::is('teachers.factures') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('teachers.factures',['idProfesseur' => auth()->user()->idProfesseur])}}">
									<i class="mdi mdi-cash"></i>
									<span class="nav-text">Mes Paiements</span>
								</a>
							</li>
							<hr>
							@endonlyteacher
							@staff
								<!-- ARCHIVE -->
								<li class="has-sub {{ Route::is('student.archive') || Route::is('teachers.archive') || Route::is('staff.archive') || Route::is('factureDepenses.archive')||Route::is('incomePayment.archive')
								 ? 'active expand' : ''}}">
									<a class="sidenav-item-link" href="javascript:void(0)">
										<i class="bi bi-archive-fill"></i>
										<span class="nav-text">Archive</span> <b class="caret"></b>
									</a>
									<div class="collapse {{ Route::is('student.archive') || Route::is('teachers.archive')
									|| Route::is('staff.archive') || Route::is('factureDepenses.archive')||Route::is('incomePayment.archive')
									  ? 'show' : 'collapsed'}}">
										<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
											<li class="{{Route::is('student.archive') ? 'active' : ''}}">
												<a class="sidenav-item-link" href="{{route('student.archive')}}">
													<span class="nav-text">Archive des Etudiants</span>
												</a>
											</li>
											@admin
											<li class="{{Route::is('teachers.archive') ? 'active' : ''}}">
												<a class="sidenav-item-link" href="{{route('teachers.archive')}}">
													<span class="nav-text">Archive des Professeurs</span>
												</a>
											</li>
											<li class="{{Route::is('staff.archive') ? 'active' : ''}}">
												<a class="sidenav-item-link" href="{{route('staff.archive')}}">
													<span class="nav-text">Archive des Staffs</span>
												</a>
											</li>
											<li class="{{Route::is('factureDepenses.archive') ? 'active' : ''}}">
												<a class="sidenav-item-link" href="{{route('factureDepenses.archive')}}">
													<span class="nav-text">Archive des Facture Dépenses</span>
												</a>
											</li>
											<li class="{{Route::is('incomePayment.archive') ? 'active' : ''}}">
												<a class="sidenav-item-link" href="{{route('incomePayment.archive')}}">
													<span class="nav-text">Archive des Reçus de Paiement</span>
												</a>
											</li>
											@endadmin
										</ul>
									</div>
									<hr>
								</li>
							@endstaff

							@admin
							<!-- Activities -->
							<li class="{{Route::is('activite') ? 'active' : ''}}">
								<a class="sidenav-item-link" href="{{route('activite')}}">
									<i class="mdi mdi-bell-outline"></i>
									<span class="nav-text">Activités</span>
								</a>
							</li>
							<hr>

								<!-- Setting -->
								<li class="{{Route::is('settings') ? 'active' : ''}}">
									<a class="sidenav-item-link" href="{{route('settings')}}">
										<i class="bi bi-gear"></i>
										<span class="nav-text">Paramètre</span>
									</a>
								</li>
								<hr>
							@endadmin
							<!-- Deconnexion -->
							<li>
								<a class="sidenav-item-link" href="javascript:void(0)" id="logoutSidebar">
									<i class="bi bi-box-arrow-left"></i>
									<span class="nav-text">Deconnexion</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
	
	
	