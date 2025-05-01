<x-app-layout>
<x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>
      
    <section class="section dashboard">

        <div class="card">

            <div class="row m-0">

                <div class="col-12">
            
                    <div class="row   p-3">
            
            
                        <div class="col-12 col-lg-8">
            
                            <div class="d-flex pt-4 mb-2">
                                <h3 class="me-1 fw-bolder"><span><i class="fa-solid fa-user"></i></span> {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </h3>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Program</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{$student->program->name ?? ''}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">School ID</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{$student->student_number}}</div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Year Level</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $latestAcademicRecord->year_level ?? '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Section</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $latestAcademicRecord->section->section ?? '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Age</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $student->age ?? '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Gender</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $student->gender ?? '' }}</div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Date of Birth</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $student->birthdate ?? '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Place of Birth</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $student->place_of_birth ?? '' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Email</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{ $student->email_address ?? '' }}</div>
                            </div>
            
                            
            
            
                        </div>
                    </div>
                </div>
            
                
            </div>
        </div>
      
    </section>

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
                <button type="button" class="btn btn-sidenav mt-3" data-bs-toggle="modal" data-bs-target="#makePaymentModal" style="background-color: #0d6efd; color: white; border: none;">Make Payment</button>

                <!-- Make Payment Modal -->
                <div class="modal fade" id="makePaymentModal" tabindex="-1" aria-labelledby="makePaymentModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="makePaymentModalLabel">Make Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form id="makePaymentForm">
                          <div class="mb-3">
                            <label for="paymentFor" class="form-label">Payment For</label>
                            <input type="text" class="form-control" id="paymentFor" name="paymentFor" required>
                          </div>
                          <div class="mb-3">
                            <label for="paymentDetails" class="form-label">Details (Optional)</label>
                            <textarea class="form-control" id="paymentDetails" name="paymentDetails" rows="3"></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="paymentAmount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" min="0" step="0.01" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="makePaymentForm" class="btn btn-primary">Submit Payment</button>
                      </div>
                    </div>
                  </div>
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
                    @php
                  if (!isset($courses) || $courses->count() == 0) {
                    $courses = collect([
                      (object)['course_code' => 'CS101', 'title' => 'Introduction to Computer Science'],
                      (object)['course_code' => 'MATH101', 'title' => 'Calculus I'],
                      (object)['course_code' => 'ENG101', 'title' => 'English Composition'],
                      (object)['course_code' => 'HIST101', 'title' => 'World History']
                    ]);
                  }
                  $attendancePercentages = [98, 92, 95, 90];
                @endphp
                @foreach($courses as $course)
                <tr>
                  <td>{{ $course->course_code }}</td>
                  <td>
                    @php
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
                    @php
                  if (!isset($courses) || $courses->count() == 0) {
                    $courses = collect([
                      (object)['course_code' => 'CS101', 'title' => 'Introduction to Computer Science'],
                      (object)['course_code' => 'MATH101', 'title' => 'Calculus I'],
                      (object)['course_code' => 'ENG101', 'title' => 'English Composition'],
                      (object)['course_code' => 'HIST101', 'title' => 'World History']
                    ]);
                  }
                  $absencePercentages = [5, 8, 4, 10];
                  $absenceDates = [
                    ['2023-01-10', '2023-01-15'],
                    ['2023-02-05'],
                    ['2023-01-20', '2023-02-10', '2023-02-15'],
                    ['2023-03-01']
                  ];
                @endphp
                @foreach($courses as $course)
                <tr>
                  <td>{{ $course->course_code }}</td>
                  <td>
                    @php
                      $index = $loop->index % count($absencePercentages);
                    @endphp
                    {{ $absencePercentages[$index] }}%
                  </td>
                  <td>
                    @php
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
                    @php
                  if (!isset($courses) || $courses->count() == 0) {
                    $courses = collect([
                      (object)['course_code' => 'CS101', 'title' => 'Introduction to Computer Science'],
                      (object)['course_code' => 'MATH101', 'title' => 'Calculus I'],
                      (object)['course_code' => 'ENG101', 'title' => 'English Composition'],
                      (object)['course_code' => 'HIST101', 'title' => 'World History']
                    ]);
                  }
                  $latePercentages = [3, 5, 2, 4];
                  $lateDates = [
                    ['2023-01-12', '2023-01-18'],
                    ['2023-02-07'],
                    ['2023-01-22', '2023-02-12', '2023-02-17'],
                    ['2023-03-03']
                  ];
                  $lateTimes = [
                    ['08:05 AM', '08:10 AM'],
                    ['08:15 AM'],
                    ['08:07 AM', '08:12 AM', '08:20 AM'],
                    ['08:03 AM']
                  ];
                @endphp
                @foreach($courses as $course)
                <tr>
                  <td>{{ $course->course_code }}</td>
                  <td>
                    @php
                      $index = $loop->index % count($latePercentages);
                    @endphp
                    {{ $latePercentages[$index] }}%
                  </td>
                  <td>
                    @php
                      $dateIndex = $loop->index % count($lateDates);
                    @endphp
                    {{ implode(', ', $lateDates[$dateIndex]) }}
                  </td>
                  <td>
                    @php
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

    <div class="card p-3 mt-4">
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
                $yearAverages = [];
              @endphp
            @foreach ($semesters as $semester)
              <h6>{{ $semester }} Semester</h6>
              @php
                // Use $courses if available, else fallback to dummy courses
                if (isset($courses) && $courses->count() > 0) {
                  $shuffledCourses = $courses->shuffle()->take(3);
                } else {
                  $shuffledCourses = collect([
                    (object)['course_code' => 'CS101', 'title' => 'Introduction to Computer Science'],
                    (object)['course_code' => 'MATH101', 'title' => 'Calculus I'],
                    (object)['course_code' => 'ENG101', 'title' => 'English Composition']
                  ]);
                }
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
                      // Fixed dummy grades for demonstration
                      $fixedDummyGrades = [
                        '1st' => ['1.25', '1.5', '1.75'],
                        '2nd' => ['1.5', '1.75', '2.0']
                      ];
                      $grade = $fixedDummyGrades[$semester][$loop->index % 3];
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
</x-app-layout>
