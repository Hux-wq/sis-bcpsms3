<div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="programModalLabel">Programs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="programSearchInput" onkeyup="filterPrograms()" placeholder="Search for programs..." class="form-control mb-3" />
        <table class="table table-striped" id="programTable">
          <thead>
            <tr>
              <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTablePrograms(0)">Program Code &#x25B2;&#x25BC;</button></th>
              <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTablePrograms(1)">Program Name &#x25B2;&#x25BC;</button></th>
            </tr>
          </thead>
          <tbody>
            @foreach($programs as $program)
            <tr>
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

<script>
  let sortDirectionPrograms = Array(2).fill(true); // true = ascending, false = descending

  function sortTablePrograms(columnIndex) {
    const table = document.getElementById("programTable");
    let switching = true;
    let shouldSwitch;
    let i;
    let rows;
    let switchcount = 0;
    let dir = sortDirectionPrograms[columnIndex] ? "asc" : "desc";

    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        let x = rows[i].getElementsByTagName("TD")[columnIndex];
        let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

        let xContent = x.textContent || x.innerText;
        let yContent = y.textContent || y.innerText;

        if (!isNaN(xContent) && !isNaN(yContent)) {
          xContent = Number(xContent);
          yContent = Number(yContent);
        }

        if (dir === "asc") {
          if (xContent > yContent) {
            shouldSwitch = true;
            break;
          }
        } else if (dir === "desc") {
          if (xContent < yContent) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount++;
      } else {
        if (switchcount === 0 && dir === "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
    sortDirectionPrograms[columnIndex] = !sortDirectionPrograms[columnIndex];
  }

  window.sortTablePrograms = sortTablePrograms; // expose to global scope for inline onclick

  function filterPrograms() {
    const input = document.getElementById('programSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('programTable');
    const trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
      const tds = trs[i].getElementsByTagName('td');
      let show = false;
      for (let j = 0; j < tds.length; j++) {
        if (tds[j]) {
          const textValue = tds[j].textContent || tds[j].innerText;
          if (textValue.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
      }
      trs[i].style.display = show ? '' : 'none';
    }
  }
</script>
