$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  })
    });
  });

  $(function(){
    $('.form-update-status').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');

        Swal.fire({
            title: 'Are you sure?',
            text: "Update status for this transaction?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire(
                            'Updated!',
                            'The status has been updated.',
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an error updating the status.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
