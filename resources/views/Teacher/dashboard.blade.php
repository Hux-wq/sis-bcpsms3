<x-app-layout>

    <x-page-title header="Teacher Dashboard" :links="['teacher.dashboard' => '/teacher/dashboard']"/>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="row">  
                    <!-- Sections Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sections-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-chalkboard-teacher text-dark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>Sections</h5>
                                        <h6>{{ $sectionsCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card students-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-user-graduate text-dark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5>Students</h5>
                                        <h6>{{ $studentsCount }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students List -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card info-card">
                            <div class="card-body">
                                <h5>Students in Your Sections</h5>
                                @if($students->isEmpty())
                                    <p>No students found in your sections.</p>
                                @else
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Student Number</th>
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>{{ $student->student_number }}</td>
                                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                    <td>{{ $student->program ? $student->program->name : 'N/A' }}</td>
                                                    <td>{{ $student->section ? $student->section->name : 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
