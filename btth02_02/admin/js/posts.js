var postsData = $('#postsList').DataTable({
    "lengthChange": false,
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
        url: "manage_posts.php",
        type: "POST",
        data: { action: 'postListing' },
        dataType: "json"
    },
    "columnDefs": [
        {
            "targets": [0, 6, 7],
            "orderable": false,
        },
    ],
    "pageLength": 10
});	