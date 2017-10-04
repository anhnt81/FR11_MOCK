<div id='remove-modal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h3>Cảnh báo</h3>
            </div>

            <div class='modal-body alert-warning'>
                Xóa mục này có thể những mục liên quan cũng sẽ bị xóa hoặc không hoạt động.
                Hãy chắc chắn bạn muốn xóa !!!
            </div>
            <div class='modal-footer'>
                <form method='post' style='float:left;'>
                    {{ csrf_field() }}
                    <input name='id' type='hidden' value='' id='del-id'>
                    <button type="submit" class='btn btn-danger'>Xóa</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
