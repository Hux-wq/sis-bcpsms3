<div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="departmentModalLabel">Departments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<table class="table table-striped datatable" id="departmentTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Code</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departments as $index => $department)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $department->code }}</td>
              <td>{{ $department->name }}</td>       
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
