$(document).ready(function() {
    $('#comparisonTable').DataTable({
      paging: false,
      searching: false,
      info: false,
      ordering: false,
      columnDefs: [
        { className: 'text-center', targets: '_all' }
      ]
    });
  });