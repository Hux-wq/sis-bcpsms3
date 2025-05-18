<x-app-layout>

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0">Teacher Profile: {{ $teacher->name }}</h1>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.teachers.updateProfile', $teacher->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                            <label for="name">Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h3 class="h5 mb-0">Sections Handled</h3>
    </div>
    <div class="card-body">
        @php
            $teacherSectionIds = $sections->pluck('id')->toArray();

            // Get unique years and semesters from academicRecords
            $years = $academicRecords->pluck('year_level')->unique()->sort()->values();
            $semesters = $academicRecords->pluck('semester')->unique()->sort()->values();

            $sectionsByYear = $academicRecords->groupBy('year_level');
        @endphp

        <div class="row mb-3">
            <div class="col-md-4 mb-2">
                <label for="year" class="form-label">Year Level</label>
                @php
                    $teacherYear = $academicRecords->first() ? $academicRecords->first()->year_level : '';
                    $teacherSectionName = $academicRecords->first() ? $academicRecords->first()->section->section : '';
                @endphp
                <select id="year" name="year" class="form-select" onchange="filterSections()">
                    <option value="">Select Year Level</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $year == old('year', $teacherYear) ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label for="section" class="form-label">Section</label>
                <select id="section" name="section_id" class="form-select" onchange="filterSemesters()" {{ old('year', $teacherYear) ? '' : 'disabled' }}>
                    <option value="">Select Section</option>
                </select>
            </div>

            <div class="col-md-4 mb-2">
                <label for="semester" class="form-label">Semester</label>
                <select id="semester" name="semester" class="form-select">
                    <option value="">Select Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester }}">{{ $semester }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @error('section_id')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
          <script>
            const academicRecords = @json($academicRecords);

            document.addEventListener('DOMContentLoaded', () => {
                // Initialize the section dropdown if a year is pre-selected
                const yearSelect = document.getElementById('year');
                const sectionSelect = document.getElementById('section');
                const teacherSectionName = @json(old('section_id', $teacherSectionName));

                if (yearSelect.value) {
                    filterSections();

                    // Set the section select value to the teacher's section name if exists
                    if (teacherSectionName) {
                        sectionSelect.value = teacherSectionName;
                        sectionSelect.disabled = false;
                    }
                }
            });

                function filterSections() {
                    const yearSelect = document.getElementById('year');
                    const sectionSelect = document.getElementById('section');
                    const semesterSelect = document.getElementById('semester');

                    const selectedYear = yearSelect.value;

                    // Reset section and semester selects
                    sectionSelect.innerHTML = '<option value="">Select Section</option>';
                    sectionSelect.disabled = !selectedYear;
                    semesterSelect.innerHTML = '<option value="">Select Semester</option>';
                    semesterSelect.disabled = true;

                    if (!selectedYear) return;

                    // Filter academicRecords by selected year_level
                    const filteredRecords = academicRecords.filter(r => r.year_level == selectedYear);

                    // Get unique section names for the dropdown
                    const uniqueSections = [...new Set(filteredRecords.map(r => r.section.section))];

                    uniqueSections.forEach(sectionName => {
                        const option = document.createElement('option');
                        option.value = sectionName;
                        option.textContent = sectionName;
                        sectionSelect.appendChild(option);
                    });
                }

                function filterSemesters() {
                    const yearSelect = document.getElementById('year');
                    const sectionSelect = document.getElementById('section');
                    const semesterSelect = document.getElementById('semester');

                    const selectedYear = yearSelect.value;
                    const selectedSection = sectionSelect.value;

                    // Reset semester select
                    semesterSelect.innerHTML = '<option value="">Select Semester</option>';
                    semesterSelect.disabled = !(selectedYear && selectedSection);

                    if (!(selectedYear && selectedSection)) return;

                    // Filter academicRecords by year_level and section name
                    const filteredRecords = academicRecords.filter(r => r.year_level == selectedYear && r.section.section == selectedSection);

                    // Get unique semesters for the dropdown
                    const uniqueSemesters = [...new Set(filteredRecords.map(r => r.semester))];

                    uniqueSemesters.forEach(semester => {
                        const option = document.createElement('option');
                        option.value = semester;
                        option.textContent = semester;
                        semesterSelect.appendChild(option);
                    });
                }
            </script>
</x-app-layout>
