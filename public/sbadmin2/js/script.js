// menmbuat menu (menentukan icon sesuai parent_id)
$(function () {
    $("#parent_id").change(function () {
        console.log($("#id_parent option:selected").val());
        if ($("#parent_id option:selected").val() != 0) {
            $('#icon').prop('readonly', true);
            // $('#icon-input').prop('hidden', true);
            $('#icon').val('# (Tidak ada)');
        } else {
            $('#icon').prop('readonly', false);
            $('#icon').val('');
            // $('#icon-input').prop('hidden', false);
        }
    });
});
