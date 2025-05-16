<div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="programModalLabel">Programs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover datatable" id="programTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Program Code</th>
              <th>Program Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach($programs as $index => $program)
            <tr>
              <td>{{$index + 1}}</td>
              <td>{{ $program->code }}</td>
              <td>{{ $program->name }}</td>
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
