const books = document.getElementById('books');

if (books) {
    books.addEventListener('click', function(e) {
        if (e.target.className === 'btn btn-danger') {
            if (confirm('Are you sure to delete this item ?')) {
                let code = e.target.getAttribute('data-id');

                fetch(`/searchForm/remove/${code}`, {
                    method: "DELETE"
                }).then(function(res){
                    window.location.reload();
                });
            }
        }
    });

    books.addEventListener('click', function (e) {
        if (e.target.className === 'btn btn-success') {
            if (confirm('Are you sure to export these items ?')) {
                let code = e.target.getAttribute('data-id');

                fetch(`/searchForm/export/${code}`, {
                    method: "POST"
                }).then(function(res) {
                    window.location.reload();
                });
            }
        }
    });
}

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
