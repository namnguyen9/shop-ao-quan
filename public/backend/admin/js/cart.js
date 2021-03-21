var cart = {} || cart;

cart.show = function() {
    $('.badge').text('');
    $.ajax({
        type: "GET",
        url: "/cart/show",
        dataType: "json",
        success: function(data) {
            $('#cart tbody').empty();
            $('#btn-cart').empty();
            $('#btn-pay').empty();
            if (data.length != 0) {
                $('#btn-cart').append(`
					<a class="btn btn-default update" href="/checkout">Mua ngay</a>
                `);
                $('#btn-pay').append(`
				    <a  href="/checkout" ><i class="fa fa-crosshairs"></i> Thanh Toán</a>
                `);
                $.each(data, function(i, value) {
                    $('#cart tbody').append(`
                    <tr>
                    <td class="cart_product">
                        <a href="/product/detail/${value.id}"><img src="/uploads/images/${value.options.image}" alt="" width="80" height ="80"></a>
                    </td>
                    <td class="cart_description">
                        <h5><a style="margin:65px;font-size:12px" href="/product/detail/${value.id}">${value.name}</a></h5>
                    </td>
                    <td class="cart_price">
                        <p style="font-size:15px">${value.options.size}</p>
                    </td>
                    <td class="cart_price">
                        <p  style="font-size:15px">${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price)}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button" >
                            <a class="cart_quantity_up" href="javascript:;" onclick ="cart.quantity_up(${value.qty},${value.id})"> + </a>
                            <input class="cart_quantity_input" type="text" onchange="cart.update_qty(${value.id})" id="cart-${value.id}" value="${value.qty}" autocomplete="off" size="2">
                            <a class="cart_quantity_down" href="javascript:;" onclick ="cart.quantity_down(${value.qty},${value.id})"> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p style="font-size:15px" class="cart_total_price">${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price*value.qty)}</p>
                    </td>
                    <td class="cart_delete">
                        <input type="hidden" id="rowId-${value.id}"  value="${value.rowId}">
                        <a class="cart_quantity_delete" href="javascript:;" onclick ="cart.delete(${value.id})"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                `);
                });
            } else {
                $('#cart thead').append(`
					<th id="shopping-cart" colspan="6" style="text-align:center"> <a href="/trang-chu" > <i  style="font-size:10rem" class="fa fa-shopping-cart"></i>Mua ngay</a></th>
               `);
                $('#btn-cart').append(`
               <a class="btn btn-default update" href="javascript:;" onclick="cart.message()" >Mua ngay</a>
           `);
                $('#btn-pay').append(`
                <a  href="javascript:;" onclick="cart.message()" ><i class="fa fa-crosshairs"></i> Thanh Toán</a>
            `);
            }
        }

    });
    cart.total();
};


cart.quantity_up = function(qty, id) {
    var rowId = $(`#rowId-${id}`).val();
    update = {};
    update.qty = ++qty;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        method: "POST",
        url: "/cart/quantity-up/" + rowId,
        data: JSON.stringify(update),
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            if (response == 100) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'Số lượng sản phẩm còn lại không đủ',
                    showConfirmButton: false,
                    timer: 1500
                });
                cart.show();
            };
            cart.show();
        }
    });
}


cart.update_qty = function(id) {
    var rowId = $(`#rowId-${id}`).val();
    var qty = $(`#cart-${id}`).val();
    if (!isNaN(qty) && qty >= 1) {
        if (qty < 200) {
            var update = {};
            update.qty = qty;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                method: "POST",
                url: "/cart/update-qty/" + rowId,
                data: JSON.stringify(update),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    cart.show();
                }
            });
        } else {
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'Số lượng sản phẩm còn lại không đủ',
                showConfirmButton: false,
                timer: 1500
            })
        }
    } else {
        Swal.fire({
            position: 'top-center',
            icon: 'info',
            title: 'Số lượng ít nhất là 1 sản phẩm',
            showConfirmButton: false,
            timer: 1500
        })
    }
}

cart.quantity_down = function(qty, id) {
    var rowId = $(`#rowId-${id}`).val();
    update = {};
    update.qty = --qty;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        method: "POST",
        url: "/cart/quantity-down/" + rowId,
        data: JSON.stringify(update),
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            if (response == 100) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'Số lượng ít nhất là 1 sản phẩm',
                    showConfirmButton: false,
                    timer: 1500
                })
                cart.show();
            }
            cart.show();
        }
    });
}

cart.delete = function(id) {
    var rowId = $(`#rowId-${id}`).val();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        method: "DELETE",
        url: "/cart/delete/" + rowId,
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Xóa sản phẩm thành công',
                showConfirmButton: false,
                timer: 1500
            })
            cart.show();
        }
    });
}

cart.total = function() {
    $.ajax({
        type: "GET",
        url: "/cart/total",
        dataType: "json",
        success: function(data) {
            $('#subtotal').text(new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(data.subtotal));
            $('#tax').text(data.tax + "đ");
            $('#total').text(new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(data.total));
        }
    });
}

cart.message = function() {
    Swal.fire('Bạn chưa có sản phẩm nào')
}

cart.init = function() {
    cart.show();
}

$(document).ready(function() {
    cart.init();
});