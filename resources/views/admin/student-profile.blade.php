<x-app-layout>

    <x-page-title header="{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}" :links='["student" => "/student", "profile" => "/student/profile/{$student->id}"]'/>

    <div class="row m-0">

        <div class="col-12 card">
    
            <div class="row p-3">
    
                <div class="col-12 col-lg-4">
    
                    <div class="pt-2">
    
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            
                            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h1 class="text-capitalize fs-5  fw-bold">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</h1>
                            <h6>{{$student->student_number}}</h6>
                            <div>
                              
                              <form id="createAccountForm">
                                @csrf
                                <input type="hidden" name="email" value="{{$student->student_number . '@student.com'}}">
                                <input type="hidden" name="password" value="{{$student->last_name . '1234!'}}">
                                <input type="hidden" name="id" value="{{$student->id}}">
                                <button type="button" class="btn btn-success" id="createAccountButton">Create Account</button>
                                <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#requestDocumentModal">Request Document</button>

                                <!-- Modal -->
                                <div class="modal fade" id="requestDocumentModal" tabindex="-1" aria-labelledby="requestDocumentModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="requestDocumentModalLabel">Request Document</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form id="requestDocumentForm" class="modal-body">
                                        <div class="mb-4">
                                          <label for="documentType" class="form-label">What Document</label>
                                          <input type="text" class="form-control" id="documentType" name="documentType" placeholder="Enter document name" required>
                                        </div>
                                        <div class="mb-4">
                                          <label for="documentFormat" class="form-label">Document Format</label>
                                          <select class="form-select" id="documentFormat" name="documentFormat" required>
                                            <option value="">Select format</option>
                                            <option value="Original">Original</option>
                                            <option value="Xerox">Xerox</option>
                                            <option value="Photocopy">Photocopy</option>
                                          </select>
                                        </div>
                                        <div class="mb-4">
                                          <label for="copies" class="form-label">How Many Copies</label>
                                          <input type="number" class="form-control" id="copies" name="copies" min="1" value="1" required>
                                        </div>
                                        <div class="mb-4">
                                          <label for="submitDate" class="form-label">Date to be Submitted</label>
                                          <input type="date" class="form-control" id="submitDate" name="submitDate" required>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Submit Request</button>
                                        </div>
                                      </form>
                                      <!-- Toast Notification -->
                                      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                        <div id="requestToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                          <div class="d-flex">
                                            <div class="toast-body">
                                              Request submitted successfully!
                                            </div>
                                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                          </div>
                                        </div>
                                      </div>
                                      <script>
                                        document.getElementById('requestDocumentForm').addEventListener('submit', function(event) {
                                          event.preventDefault();
                                          console.log('Form submitted');
                                          var toastEl = document.getElementById('requestToast');
                                          if (!toastEl) {
                                            console.error('Toast element not found');
                                            return;
                                          }
                                          var toast = bootstrap.Toast.getInstance(toastEl);
                                          if (!toast) {
                                            toast = new bootstrap.Toast(toastEl);
                                          }
                                          toast.show();
                                          this.reset();
                                        });
                                      </script>
                                    </div>
                                  </div>
                                </div>

                              <script>
                                document.getElementById('createAccountButton').addEventListener('click', function(event) {
                                    event.preventDefault(); // Prevent default form submission
                            
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "Do you want to create this account?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, create it!',
                                        cancelButtonText: 'No, cancel!',
                                        reverseButtons: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // If user confirms, send AJAX request
                                            const formData = new FormData(document.getElementById('createAccountForm'));
                            
                                            fetch("{{ route('studentUserAccount.create') }}", {
                                                method: 'POST',
                                                body: formData,
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.status === 'success') {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success!',
                                                        text: data.message,
                                                        showConfirmButton: true
                                                    }).then(() => {
                                                        // Optionally, redirect after success
                                                        // window.location.href = "";
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Oops...',
                                                        text: data.message,
                                                        showConfirmButton: true
                                                    });
                                                }
                                            })
                                            .catch(error => {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'An error occurred while creating the account. Please try again.',
                                                    showConfirmButton: true
                                                });
                                            });
                                        } else {
                                            Swal.fire('Cancelled', 'The account creation has been cancelled.', 'error');
                                        }
                                    });
                                });
                              </script>
                            </div>
                                    
                        </div>
            
                    </div>
    
                </div>

                <!-- Left column: other profile details except the specified fields -->
                <div class="col-12 col-lg-4">
                    <div class="d-flex pt-4 mb-6">
                        <h5 class="me-1 fw-bolder">Profile Details</h5>
                        <h5><a class="pb-2 link underline text-primary" href="http://127.0.0.1:8000/Students/Profile/View/{students.id}/EditProfile">Edit <i class="fa-solid fa-pen-to-square"></i></a></h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Last Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->last_name}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">First Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->first_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->middle_name}}</div>
                    </div>
    
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8">{{$student->age}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Gender</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->gender}}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                        <div class="col-lg-9 col-md-8">{{$student->birthdate}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Birth of Place</div>
                        <div class="col-lg-9 col-md-8">{{$student->place_of_birth}}</div>
                    </div>
                </div>

                <!-- Right column: move year level, semester, school year, program, email, and section here -->
                <div class="col-12 col-lg-4 d-flex flex-column justify-content-start" style="margin-top: 60px;">
                    @php
                        $latestAcadRecord = collect($acad_records)->sortByDesc('year_level')->first();
                    @endphp

                    <div class="d-flex mb-2">
                        <div class="label col-4">Year Level</div>
                        <div class="col-8" style="min-height: 38px; display: flex; align-items: center;">{{ $latestAcadRecord['year_level'] ?? 'N/A' }}</div>
                    </div>

                    <div class="d-flex mb-2">
                        <div class="label col-4">Semester</div>
                        <div class="col-8" style="min-height: 38px; display: flex; align-items: center;">{{ $latestAcadRecord['semester'] ?? 'N/A' }}</div>
                    </div>

                    <div class="d-flex mb-2">
                        <div class="label col-4">School Year</div>
                        <div class="col-8" style="min-height: 38px; display: flex; align-items: center;">{{ $latestAcadRecord['school_year'] ?? 'N/A' }}</div>
                    </div>

                    <div class="d-flex mb-2">
                        <div class="label col-4">Program</div>
                        <div class="col-8 text-capitalize" style="min-height: 38px; display: flex; align-items: center;">{{$student->program->name ?? 'N/A'}}</div>
                    </div>

                    <div class="d-flex mb-2">
                        <div class="label col-4">Email</div>
                        <div class="col-8" style="min-height: 38px; display: flex; align-items: center;">{{$student->email_address ?? 'N/A'}}</div>
                    </div>

                    <div class="d-flex mb-2">
                        <div class="label col-4">Section</div>
                        <div class="col-8 text-capitalize" style="min-height: 38px; display: flex; align-items: center;">{{$student->sections ?? 'N/A'}}</div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="card p-3 mt-4">
            <h5 class="card-title">Billing Liquidation</h5>
            <div class="row">
                <div class="col-6">
                    <div class="d-flex">
                        <div class="label col-6">Remaining Balance</div>
                        <div class="col-6" style="min-height: 38px; display: flex; align-items: center;">
                            ₱{{ number_format(15000.00, 2) }}
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6>Breakdown of Expenses</h6>
                        <ul>
                            <li>Tuition Fee: ₱{{ number_format(7000.00, 2) }}</li>
                            <li>Miscellaneous Fee: ₱{{ number_format(3000.00, 2) }}</li>
                            <li>Library Fee: ₱{{ number_format(2000.00, 2) }}</li>
                            <li>Laboratory Fee: ₱{{ number_format(3000.00, 2) }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex">
                        <div class="label col-6">Paid Balance</div>
                        <div class="col-6" style="min-height: 38px; display: flex; align-items: center;">
                            ₱{{ number_format(35000.00, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div>

<div class="card p-3">

  <h5 class="card-title">Attendance Overview</h5>

    <div class="row">

      <div class="col-xxl-3 col-md-6">
        <div class="alert alert-success p-0" id="presentCard" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#presentModal">

          <div class="card-body">
            

            <div class="d-flex align-items-center p-1" style="cursor: pointer;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div>
                <h5>95%</h5>
                <h6>Present</h6>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="presentModal" tabindex="-1" aria-labelledby="presentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="presentModalLabel">Attendance</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Course code</th>
                    <th>Present (%)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($courses as $course)
                  <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>
                      @php
                        // Dummy attendance percentage for demonstration
                        $attendancePercentages = [98, 92, 95, 90];
                        $index = $loop->index % count($attendancePercentages);
                      @endphp
                    {{ $attendancePercentages[$index] }}%
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.getElementById('presentCard').addEventListener('click', function() {
          var details = document.getElementById('presentDetails');
          if (details.style.display === 'none') {
            details.style.display = 'block';
          } else {
            details.style.display = 'none';
          }
        });
      </script>

      <div class="col-xxl-3 col-md-6">
        <div class="alert alert-danger p-0" id="absentCard" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#absentModal">

          <div class="card-body">
            

            <div class="d-flex align-items-center p-1" style="cursor: pointer;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div>
                <h5>3%</h5>
                <h6>Absent</h6>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="absentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="absentModalLabel">Absence Breakdown by Course</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Course code</th>
                    <th>Absent (%)</th>
                    <th>Date(s) Absent</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($courses as $course)
                  <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>
                      @php
                        // Dummy absence percentage for demonstration
                        $absencePercentages = [5, 8, 4, 10];
                        $index = $loop->index % count($absencePercentages);
                      @endphp
                      {{ $absencePercentages[$index] }}%
                    </td>
                    <td>
                      @php
                        // Dummy absence dates for demonstration
                        $absenceDates = [
                          ['2023-01-10', '2023-01-15'],
                          ['2023-02-05'],
                          ['2023-01-20', '2023-02-10', '2023-02-15'],
                          ['2023-03-01']
                        ];
                        $dateIndex = $loop->index % count($absenceDates);
                      @endphp
                      {{ implode(', ', $absenceDates[$dateIndex]) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-3 col-md-6">
        <div class="alert alert-warning p-0" id="lateCard" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#lateModal">

          <div class="card-body">
            

            <div class="d-flex align-items-center p-1" style="cursor: pointer;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center pe-2">
                <i class="fa-solid fa-user"></i>
              </div>
              <div>
                <h5>2%</h5>
                <h6>Late</h6>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="lateModal" tabindex="-1" aria-labelledby="lateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="lateModalLabel">Late Breakdown by Course</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Course code</th>
                    <th>Late (%)</th>
                    <th>Date(s) Late</th>
                    <th>Time(s) Late</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($courses as $course)
                  <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>
                      @php
                        // Dummy late percentage for demonstration
                        $latePercentages = [3, 5, 2, 4];
                        $index = $loop->index % count($latePercentages);
                      @endphp
                      {{ $latePercentages[$index] }}%
                    </td>
                    <td>
                      @php
                        // Dummy late dates for demonstration
                        $lateDates = [
                          ['2023-01-12', '2023-01-18'],
                          ['2023-02-07'],
                          ['2023-01-22', '2023-02-12', '2023-02-17'],
                          ['2023-03-03']
                        ];
                        $dateIndex = $loop->index % count($lateDates);
                      @endphp
                      {{ implode(', ', $lateDates[$dateIndex]) }}
                    </td>
                    <td>
                      @php
                        // Dummy late times for demonstration
                        $lateTimes = [
                          ['08:05 AM', '08:10 AM'],
                          ['08:15 AM'],
                          ['08:07 AM', '08:12 AM', '08:20 AM'],
                          ['08:03 AM']
                        ];
                        $timeIndex = $loop->index % count($lateTimes);
                      @endphp
                      {{ implode(', ', $lateTimes[$timeIndex]) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-3 col-md-6">
        <div class="alert alert-info p-0" id="totalDaysCard" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#totalDaysModal">

          <div class="card-body">
            

            <div class="d-flex align-items-center p-1" style="cursor: pointer;">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-currency-dollar"></i>
              </div>
              <div>
                @php
                  $totalPresent = 95;
                  $totalAbsent = 3;
                  $totalLate = 2;
                  $totalDays = $totalPresent + $totalAbsent + $totalLate;
                @endphp
                <h5>{{ $totalDays }}</h5>
                <h6>Total Days</h6>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="totalDaysModal" tabindex="-1" aria-labelledby="totalDaysModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="totalDaysModalLabel">Attendance Summary</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul>
                <li>Present Days: {{ $totalPresent }}</li>
                <li>Absent Days: {{ $totalAbsent }}</li>
                <li>Late Days: {{ $totalLate }}</li>
                <li>Total Days: {{ $totalDays }}</li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>

</div>

</div>

<div>
<div class="card">
<div class="card-body">
  <h5 class="card-title">Semestral Grade Overview</h5>

  <!-- Bordered Tabs -->
  <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
    @for ($year = 1; $year <= 4; $year++)
      <li class="nav-item" role="presentation">
        <button class="nav-link @if($year == 1) active @endif" id="year-{{ $year }}-tab" data-bs-toggle="tab" data-bs-target="#year-{{ $year }}" type="button" role="tab" aria-controls="year-{{ $year }}" aria-selected="{{ $year == 1 ? 'true' : 'false' }}">
          {{ $year }}{{ ['st', 'nd', 'rd', 'th'][$year - 1] }} Year
        </button>
      </li>
    @endfor
  </ul>
  <div class="tab-content pt-2" id="borderedTabContent">
    @for ($year = 1; $year <= 4; $year++)
      <div class="tab-pane fade @if($year == 1) show active @endif" id="year-{{ $year }}" role="tabpanel" aria-labelledby="year-{{ $year }}-tab">
          @php
            $semesters = ['1st', '2nd'];
            $dummyGrades = ['1.0', '1.25', '1.5', '1.75', '2.0', '2.25', '2.5', '2.75', '3.0', '4.0'];
          @endphp
        @foreach ($semesters as $semester)
          <h6>{{ $semester }} Semester</h6>
          @php
            // Shuffle courses differently for each year and semester
            $shuffledCourses = $courses->shuffle()->take(3);
            $semesterGrades = [];
          @endphp
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Grade</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($shuffledCourses as $course)
                @php
                  $grade = $dummyGrades[array_rand($dummyGrades)];
                  $semesterGrades[] = floatval($grade);
                @endphp
                <tr>
                  <td>{{ $course->course_code }}</td>
                  <td>{{ $course->title }}</td>
                  <td>{{ $grade }}</td>
                  @php
                    $status = floatval($grade) <= 3.0 ? 'Passed' : 'Failed';
                    $statusClass = $status === 'Passed' ? 'text-success' : 'text-danger';
                  @endphp
                  <td class="{{ $statusClass }}">{{ $status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @php
            $semesterAverage = count($semesterGrades) > 0 ? array_sum($semesterGrades) / count($semesterGrades) : 0;
            $yearAverages[$semester] = $semesterAverage;
          @endphp
          @php
            $semesterStatus = $semesterAverage <= 3.0 ? 'Passed' : 'Failed';
            $semesterStatusClass = $semesterStatus === 'Passed' ? 'text-success' : 'text-danger';
          @endphp
          <p>
            <strong>Average for {{ $semester }} Semester: </strong>{{ number_format($semesterAverage, 2) }}
            <span class="{{ $semesterStatusClass }}">{{ $semesterStatus }}</span>
          </p>
        @endforeach
        @php
          $totalAverage = count($yearAverages) > 0 ? array_sum($yearAverages) / count($yearAverages) : 0;
          $totalStatus = $totalAverage <= 3.0 ? 'Passed' : 'Failed';
          $totalStatusClass = $totalStatus === 'Passed' ? 'text-success' : 'text-danger';
        @endphp
        <p>
          <strong>Total Average for Year {{ $year }}: </strong>{{ number_format($totalAverage, 2) }}
          <span class="{{ $totalStatusClass }}">{{ $totalStatus }}</span>
        </p>
      </div>
    @endfor
  </div><!-- End Bordered Tabs -->

</div>
</div>
</div>

<div class="row m-0">

<div class="col-12 card">
    

    <div class="row p-3">
    </div>
</div>


</div>

</x-app-layout>
