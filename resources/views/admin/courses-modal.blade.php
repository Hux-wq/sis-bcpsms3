<div class="modal fade" id="coursesModal" tabindex="-1" aria-labelledby="coursesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coursesModalLabel">Courses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table  table-hover datatable" id="coursesTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Course Code</th>
              <th>Title</th>
              <th>Credits</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach($courses as $index => $course)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $course->course_code }}</td>
              <td>{{ $course->title }}</td>
              <td>{{ $course->credits }}</td>
              <td>{{ $course->description }}</td>
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
