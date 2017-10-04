<div id='remove-modal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h3>Cảnh báo</h3>
            </div>

            <div class='modal-body alert-warning'>
                Xóa mục này có thể những mục liên quan cũng sẽ bị xóa hoặc không hoạt động.
                Hãy chăc chắn bạn muốn xóa !!!
            </div>
            <div class='modal-footer'>
                <button type="submit" class='btn btn-success' id='btn-del'>Xóa</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#btn-del').click(function () {
            $('#del-frm').submit();
        });
    })
</script>