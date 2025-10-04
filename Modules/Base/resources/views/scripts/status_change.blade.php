<script>
    $(document).on('change', '.toggle-status', function() {
        const id = $(this).data('id');
        const value = $(this).is(':checked') ? 'active' : 'inactive';

        $.post($(this).data('url'), {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id,
                value
            })
            .done(response => {
                if (response.success) {
                    toastr.success(response.message);
                } else {
                    toastr.error('Failed to update status.');
                }
            })
            .fail(xhr => {
                console.error('Error:', xhr);
                toastr.error('An error occurred. Please try again.');
            });
    });
</script>
