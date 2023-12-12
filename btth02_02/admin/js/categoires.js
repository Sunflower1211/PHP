var categoryData = $('#categoryList').DataTable({
    "lengthChange": false,
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
        url: "manage_categories.php",
        type: "POST",
        data: { action: 'categoryListing' },
        dataType: "json"
    },
    "columnDefs": [
        {
            "targets": [0, 2, 3],
            "orderable": false,
        },
    ],
    "pageLength": 10
});	