<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            
            <span class="d-none d-md-block drop-down  p-2 "><i class="fa-regular fa-bell fs-3"></i></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile shadow-lg" style="width: 320px; max-height: 400px; overflow-y: auto; z-index: 1055;">
            <li class="dropdown-header px-3 py-2 border-bottom bg-light">
              <h6 class="mb-0 text-primary fw-bold">Notifications</h6>
            </li>

            @if(Auth::check() && Auth::user()->role === 'student')
              @if(isset($requestedDocuments) && isset($recentExpenses) && isset($recentActivities))
                <li class="dropdown-header px-3 py-2 mt-2 text-secondary small">
                  Requested Documents to Submit
                </li>
                @forelse($requestedDocuments as $doc)
                <li>
                  <a class="dropdown-item d-flex align-items-start gap-3 py-2 px-3 hover-bg-light rounded" href="#" style="text-decoration:none;">
                    <i class="bi bi-file-earmark-text fs-4 text-info flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <div class="fw-semibold text-truncate" style="max-width: 230px;">{{ $doc->document }}</div>
                      <small class="text-muted">Status: {{ ucfirst($doc->status) }}</small>
                      <br>
                      <small class="text-muted fst-italic">{{ $doc->created_at ? $doc->created_at->diffForHumans() : '' }}</small>
                    </div>
                  </a>
                </li>
                @empty
                <li class="px-3 py-2 text-center text-muted small">
                  No requested documents
                </li>
                @endforelse

                <li class="dropdown-header px-3 py-2 mt-3 text-secondary small">
                  Recent Expenses
                </li>
                @forelse($recentExpenses as $expense)
                <li>
                  <a class="dropdown-item d-flex align-items-start gap-3 py-2 px-3 hover-bg-light rounded" href="#" style="text-decoration:none;">
                    <i class="bi bi-cash fs-4 text-warning flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <div class="fw-semibold text-truncate" style="max-width: 230px;">{{ $expense['title'] }}</div>
                      <small class="text-muted">Amount: ₱{{ number_format($expense['amount'], 2) }}</small>
                      <br>
                      <small class="text-muted fst-italic">{{ \Carbon\Carbon::parse($expense['date'])->diffForHumans() }}</small>
                    </div>
                  </a>
                </li>
                @empty
                <li class="px-3 py-2 text-center text-muted small">
                  No recent expenses
                </li>
                @endforelse

                <li class="dropdown-header px-3 py-2 mt-3 text-secondary small">
                  Recent Activities
                </li>
                @forelse($recentActivities as $activity)
                <li>
                  <a class="dropdown-item d-flex align-items-start gap-3 py-2 px-3 hover-bg-light rounded" href="#" style="text-decoration:none;">
                    <i class="bi bi-list-check fs-4 text-primary flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <div class="fw-semibold text-truncate" style="max-width: 230px;">{{ $activity['activity'] }}</div>
                      <small class="text-muted fst-italic">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</small>
                    </div>
                  </a>
                </li>
                @empty
                <li class="px-3 py-2 text-center text-muted small">
                  No recent activities
                </li>
                @endforelse
              @else
                <li class="px-3 py-2 text-center text-muted small">
                  No student notification data available.
                </li>
              @endif
            @elseif(Auth::check() && Auth::user()->role === 'admin')
              <li class="dropdown-header px-3 py-2 mt-2 text-secondary small">
                Recent Uploaded Documents
              </li>
              @forelse($recentUploads as $upload)
              <li>
                <a class="dropdown-item d-flex align-items-start gap-3 py-2 px-3 hover-bg-light rounded" href="#" style="text-decoration:none;">
                  <i class="bi bi-file-earmark-text fs-4 text-info flex-shrink-0"></i>
                  <div class="flex-grow-1">
                    <div class="fw-semibold text-truncate" style="max-width: 230px;">{{ $upload->file_name }}</div>
                    <small class="text-muted">Uploaded by {{ $upload->user ? $upload->user->first_name . ' ' . $upload->user->last_name : 'Unknown' }}</small>
                    <br>
                    <small class="text-muted fst-italic">{{ $upload->created_at ? $upload->created_at->diffForHumans() : '' }}</small>
                  </div>
                </a>
              </li>
              @empty
              <li class="px-3 py-2 text-center text-muted small">
                No recent uploads
              </li>
              @endforelse

              <li class="dropdown-header px-3 py-2 mt-3 text-secondary small">
                Recent Enrolled Students
              </li>
              @forelse($recentEnrolledStudents as $student)
              <li>
                <a class="dropdown-item d-flex align-items-start gap-3 py-2 px-3 hover-bg-light rounded" href="{{ url('/student/profile/' . $student->id) }}" style="text-decoration:none;">
                  <i class="bi bi-person-plus fs-4 text-success flex-shrink-0"></i>
                  <div class="flex-grow-1">
                    <div class="fw-semibold text-truncate" style="max-width: 230px;">{{ $student->first_name }} {{ $student->last_name }}</div>
                    <small class="text-muted">Enrolled</small>
                    <br>
                    <small class="text-muted fst-italic">{{ $student->created_at ? $student->created_at->diffForHumans() : '' }}</small>
                  </div>
                </a>
              </li>
              @empty
              <li class="px-3 py-2 text-center text-muted small">
                No recent enrollments
              </li>
              @endforelse

              <li class="dropdown-header px-3 py-2 mt-3 text-secondary small">
                Payments Made
              </li>
              <li class="px-3 py-2 text-center text-muted small">
                No payment data available
              </li>
            @else
              <li class="px-3 py-2 text-center text-muted small">
                No notifications available
              </li>
            @endif

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav>


  </header>
