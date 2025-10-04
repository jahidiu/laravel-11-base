<script>
    $(document).on('click', '.img-thumbnail', function() {
        var src = $(this).attr('src');
        $('#myModal').modal('show');
        $('#myModal img').attr('src', src);
    });
    $(document).on('click', '.close', function() {
        $('#myModal').modal('hide');
    });
</script>
