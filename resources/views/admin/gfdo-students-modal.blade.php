<div class="modal fade" id="gfdoStudentsModal" tabindex="-1" aria-labelledby="gfdoStudentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gfdoStudentsModalLabel">Anual Outcomes table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover datatable" id="gfdoStudentsTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Student Number</th>
              <th>Name</th>
              <th>Age</th>
              <th>Gender</th>
              <th>Email</th>
              <th>Contact Number</th>
              <th>Status</th>
              <th>Program</th>
            </tr>
          </thead>
          <tbody>
            @foreach($studentsGFDO as $index => $student)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $student->student_number }}</td>
              <td class="text-capitalize">
                        {{ $student->last_name ?? 'N/A'}},
                        {{ $student->first_name ?? 'N/A'}}
                        {{ $student->middle_name ?? 'N/A'}}
                        {{ $student->suffix_name ?? ''}}   
                    </td>
              <td>{{ $student->age }}</td>
              <td>{{ $student->gender }}</td>
              <td>{{ $student->email_address }}</td>
              <td>{{ $student->contact_number }}</td>
              <td>{{ $student->enrollment_status }}</td>
              <td>{{ $student->program->name ?? 'N/A' }}</td>
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
</script>

<style>
  table tr td, table tr th {
  white-space: nowrap; /* Prevent text wrapping */
  overflow: hidden;    /* Hide overflow text */
  text-overflow: ellipsis; /* Show ellipsis (...) for overflow text */
}

</style>