var usersData = $('#userList').DataTable({
    "lengthChange": false,
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
        url: "manage_user.php",
        type: "POST",
        data: { action: 'userListing' },
        dataType: "json"
    },
    "columnDefs": [
        {
            "targets": [0, 4, 5],
            "orderable": false,
        },
    ],
    "pageLength": 10
});