var checkout = {} || checkout;
// Hàm đăng kí người dùng mới
checkout.new_user_signup = function() {
        var name = $('#new_name').val();
        var email = $('#new_email').val();
        var password = $('#new_password').val();
        var phone = $('#new_phone').val();

        var user = {};
        user.name = name;
        user.email = email;
        user.password = password;
        user.phone = phone;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/user/sign-up",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(data) {
                if (data['statusCode'] == 200) {
                    window.location = "/trang-chu";
                }
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.error-${key}`).text(value);
                });
            }
        });
    }
    // Hàm Đăng nhập
checkout.login = function() {
    var email = $('#email_account').val();
    var password = $('#password_account').val();
    account = {};
    account.email = email;
    account.password = password;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "POST",
        url: "/user/login",
        data: JSON.stringify(account),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data['statusCode'] == 201) {
                window.location = "/dashboard";
            } else if (data['statusCode'] == 200) {
                window.location = "/trang-chu";
            } else if (data['statusCode'] == 404) {
                $('#err_login').text('Sai tài khoản hoặc mật khẩu');
            }
        }
    });
}

checkout.logout = function() {
    $.ajax({
        type: "GET",
        url: "/user/logout",
        contentType: "application/json",
        success: function(data) {

            window.location = "/user/login";
        }
    });
}

checkout.provinces_and_cities = function() {
    $.ajax({
        type: "GET",
        url: "/shipping/data",
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, value) {
                $('#provinces_and_cities').append(`
                    <option  value="${value.id}">${value.name}</option>
                `);
            });
        }
    });

}

checkout.districts = function() {
    var key = $('#provinces_and_cities').val();
    if (key != -1) {
        $.ajax({
            type: "GET",
            url: "/shipping/data",
            dataType: "json",
            success: function(data) {
                $('#districts').empty();
                $.each(data, function(i, value) {
                    if (value.id == key) {
                        $.each(value.districts, function(index, v) {
                            $('#districts').append(`
                                 <option value="${v.id}">${v.name}</option>
                             `);
                        });
                    }
                });
            }
        });
    } else {
        $('#districts').empty();
        $('#districts').append(`
        <option value="">Quận/Huyện</option>
    `);
    }
}


checkout.getAll_address_byId = function() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "GET",
        url: "/shipping/get-byId",
        dataType: "json",
        success: function(data) {
            if (data['statusCode'] == 200) {
                $('#shippingId').val(data['shipping_id'])
                checkout.btn_payment(data['shipping_id']);
                $('#user_address').empty();
                $.each(data['shippings'], function(index, value) {
                    $('#user_address').append(`
                    <li>
                        <b><input  name="adrress"  type="radio" value="${value.id}" />${value.name}-(+84)${value.phone}-${value.street_names},${value.wards_and_communes},${value.district.name},${value.province_and_city.name}</b>
                        <a href="javascript:;"  onclick="checkout.delete_address(${value.id})"  style="padding-right:50px;color:red"> Xóa</a>
                        <a href="javascript:;"  onclick="checkout.get_details_shipping(${value.id})" style="color:blue" > Thay đổi</a>
                    </li>
                    `);
                });
                try {
                    $('input[name=adrress]')[0].checked = true;
                } catch (error) {

                }
            } else {
                $('#user_address').empty();
                checkout.btn_payment(null);
            }
        }
    });
}


checkout.save_address = function() {
    var shipping_id = $('#shipping-id').val();
    if (shipping_id == 0) {
        var province_and_city_id = $('#provinces_and_cities').val();
        data = {};
        data.name = $('#user-name').val();
        data.phone = $('#user-phone').val();
        data.street_names = $('#street_names').val();
        data.wards_and_communes = $('#wards_and_communes').val();
        data.district_id = $('#districts').val();
        if (province_and_city_id != -1) {
            data.province_and_city_id = province_and_city_id;
        } else {
            data.province_and_city_id = "";
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            url: "/shipping/create",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data['statusCode'] == 200) {
                    Swal.fire('Số lượng địa chỉ quá nhiều');
                } else if (data['statusCode'] == 201) {
                    $('#shippingId').val(data['shipping_id'])
                } else if (data['statusCode'] == 202) {
                    Swal.fire('Bạn đã có địa chỉ này rồi !');
                }
                $("#modal-address").modal('hide');
                checkout.getAll_address_byId();
                user.manage_address();
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.error-${key}`).text(value)
                });
            }
        });
    } else {
        data = {};
        data.name = $('#user-name').val();
        data.phone = $('#user-phone').val();
        data.street_names = $('#street_names').val();
        data.wards_and_communes = $('#wards_and_communes').val();
        data.district_id = $('#districts').val();
        data.province_and_city_id = $('#provinces_and_cities').val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            url: "/shipping/update/" + shipping_id,
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data['statusCode'] == 202) {
                    Swal.fire('Địa chỉ này đã tồn tại !');
                }
                checkout.getAll_address_byId();
                user.manage_address();
                $("#modal-address").modal('hide');
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.error-${key}`).text(value)
                });
            }
        });

    }
}


checkout.delete_address = function(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "DELETE",
        url: "/shipping/delete/" + id,
        dataType: "json",
        success: function(response) {
            if (response['amount']) {
                Swal.fire(`Địa chỉ này đang chứa ${response['amount']} đơn hàng.Vui lòng xóa đơn hàng trước !`);
            }
            checkout.getAll_address_byId();
            user.manage_address();
        }
    });
}

checkout.get_details_shipping = function(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "GET",
        url: "/shipping/details/" + id,
        dataType: "json",
        success: function(data) {
            $('#shipping-id').val(data['shipping'].id);
            $('#user-name').val(data['shipping'].name);
            $('#user-phone').val(data['shipping'].phone);
            $('#street_names').val(data['shipping'].street_names);
            $('#wards_and_communes').val(data['shipping'].wards_and_communes);
            $('#districts').val(data['shipping'].district_id);
            $('#provinces_and_cities').val(data['shipping'].province_and_city_id);
            checkout.districts();
            $("#modal-address").modal('show');
        }
    });
}
checkout.btn_payment = function(shipping_id) {
    $('#btn-payment').empty();
    if (shipping_id != null) {
        $('#btn-payment').append(`
        <a class="btn btn-default update" href="javascript:;" onclick="checkout.order_place()">Mua ngay</a>
    `);
    } else {
        $('#btn-payment').append(`
        <a class="btn btn-default update" href="javascript:;" onclick="checkout.showModalAddress()">Mua ngay</a>
    `);
    }
}

$('#user_address').on('change', function() {
    $('#shippingId').val(0);
    shipping_id = $('input[name=adrress]:checked', '#user_address').val();
    $('#shippingId').val(shipping_id);
});
$('#payment_method').on('change', function() {
    $('#payment-method').val(0);
    payment_method = $('input[name=payment_method]:checked', '#payment_method').val();
    $('#payment-method').val(payment_method);

});

checkout.order_place = function() {
    var shipping_id = $('#shippingId').val();
    var payment_method = $('#payment-method').val();
    var note = $('#note').val();
    var order = {};
    order.shipping_id = shipping_id;
    order.payment_method = payment_method;
    order.note = note;
    if (payment_method != 0) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            url: "/checkout/order-place",
            data: JSON.stringify(order),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data['payment_method'] == 3) {
                    window.location = "/checkout/hand-cash";

                } else if (data['payment_method'] == 1 || data['payment_method'] == 2) {
                    window.location = "/checkout/online-payment";
                }
            }
        });
    } else {
        Swal.fire('Vui lòng  chọn hình thức thanh toán .')

    }
}

checkout.resetModal = function() {
    $('#shipping-id').val(0);
    $('#user-name').val("");
    $('#user-phone').val("");
    $('#provinces_and_cities').val(-1);
    $('#districts').empty();
    $('#districts').append(`
    <option value="">Quận/Huyện</option>
`);
    $('#wards_and_communes').val("")
    $('#street_names').val("")

}

checkout.showModalAddress = function() {
    $('em').empty();
    checkout.resetModal();
    $("#modal-address").modal('show');
}

checkout.resetErr = function() {
    $('#err_login').empty();
}


checkout.resetForm = function() {
    $('#email_account').val("");
    $('#password_account').val("");
    $('#new_name').val("");
    $('#new_email').val("");
    $('#new_password').val("");
    $('#new_phone').val("");
}

checkout.init = function() {
    checkout.getAll_address_byId();
    checkout.provinces_and_cities();
    checkout.resetForm();
}

$(document).ready(function() {
    checkout.init();
});