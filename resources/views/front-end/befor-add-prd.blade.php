<!-- login befor add to cart -->
<div id='befor-add-modal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>

            <div class='modal-body alert-warning'>
                Hãy đăng nhập hoặc đăng ký để mua hàng!!!
            </div>
            <div class='modal-footer'>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.add-to-cart').click(function (e) {
            e.preventDefault();

            @if(Auth::check())
            var qty = $('#qty-prd-card').val();
            if (!qty) {
                qty = 1;
            }
            $.ajax({
                url: $(this).attr('href'),
                data: {qty: qty},
                success: function (responce) {
                    $('#add-cart-success').modal('show');
                    $('#cart-modal').html(responce);
                    $('.beta-select').click(function () {
                        var drop = $(this).parent().find('.beta-dropdown');

                        drop.slideToggle('slow');
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
            @else
            $('#befor-add-modal').modal('show');
            @endif
        });
    })
</script>