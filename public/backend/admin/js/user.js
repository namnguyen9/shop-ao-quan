var user = {} || user;
//Admin
user.showData = function() {
    $.ajax({
        type: "GET",
        url: "/user/data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $("#tb_user tbody").empty();
            $.each(data, function(index, user) {
                $("#tb_user tbody").append(`
                <tr>
                    <td><input class="user" type="checkbox" name="check[]" value="${user.id}"></td>
                    <td>${++index}</td>
                    <td>${user.name}</td>
                    <td>${user.phone}</td>
                    <td>${user.email}</td>
                    <td>${user.birthday}</td>
                    <td>${user.gender}</td>
                     <td>
                        <a  href="javascript:;"onclick="user.delete(${user.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                    </td>
                </tr>
            `);
            });
        },
    });
};



user.delete = function(id) {
    swal({
            title: "Bạn chắc chắc muốn xóa?",
            text: "Nếu bạn xóa sản phẩm sẽ biến mất",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    method: "DELETE",
                    url: "/user/delete/" + id,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response);
                        swal("Xóa sản phẩm thành công", {
                            icon: "success",
                        });
                        user.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}

user.select_all_users = function() {
    $(".user").prop('checked', $('#select_all_users').prop("checked"));
}

user.delete_checkbox_users = function() {
    var all_checkbox_users = $('.user');
    var list_id = Array();
    $.each(all_checkbox_users, function(i, element) {
        if (element.checked) {
            list_id.push(parseInt(element.value));
        }
    });
    if (list_id.length > 0) {
        swal({
                title: "Bạn chắc chắc muốn xóa?",
                text: "Nếu bạn xóa sản phẩm sẽ biến mất",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var object = {};
                    object.list_id = list_id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        method: "POST",
                        url: "/user/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            console.log(response);
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            user.showData();
                        }
                    });
                } else {
                    swal("Bạn đã hủy xóa sản phẩm");
                }
            });
    } else {
        Swal.fire('Bạn chưa chọn sản phẩm nào');
    }

}

//User
user.show = function() {
    $('#address_manage').hide();
    $('#manage_order').hide();
    $('#manage_favorite_products').hide();
    $.ajax({
        type: "GET",
        url: "/user/show",
        data: "data",
        dataType: "json",
        success: function(user) {
            $("#data-profile").empty();
            $("#data-profile").append(`
                    <table>
                    <tr>
                        <th>Tên</th>
                        <td>
							<input id="user_name" type="text" value="${user.name}">
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>
                            <input id="email" type="text" value="${user.email}">
                        </td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td>
                            <input id="phone" type="text" value="${user.phone}">
                        </td>
                    </tr>
                    <tr>
                        <th>Giới tính</th>
                        <td>
				            <input  type="hidden" value="${user.gender}" id="gender">
                            <input type="radio" id="gender-Nam" onclick="user.gender(1)" name="gender">Nam
                            <input type="radio" style ="margin-left: 39px;" id="gender-Nữ" onclick="user.gender(2)" name="gender">Nữ
                            <input type="radio" style ="margin-left: 39px;" id="gender-Khác"  onclick="user.gender(3)" name="gender">Khác
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày sinh</th>
                        <td>
                            <input id="birthday"   type="date" value="${user.birthday}">
                        </td>
                    </tr>
                    <tr>
						<th></th>
						<td>
							<a href="javascript:;" style="background-color: orangered" class="btn btn-success" onclick="user.update()">Lưu</a>        
						</td>
					</tr>
                </table>
            `);
            try {
                $(`#gender-${user.gender}`)[0].checked = true
            } catch (error) {

            }
        },
    });

};


user.gender = function(num) {

    $("#gender").val(num);

}

user.update = function() {
    var check_gender = $("#gender").val();
    var data = {};
    data.name = $("#user_name").val();
    data.email = $("#email").val();
    data.phone = $("#phone").val();
    data.birthday = $("#birthday").val();
    if (check_gender.length == 1) {

        if (check_gender == 1) {
            data.gender = "Nam"
        } else if (check_gender == 2) {
            data.gender = "Nữ"
        } else if (check_gender == 3) {
            data.gender = "Khác"
        } else {
            data.gender = null
        }
    } else {
        data.gender = check_gender;

    }
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "/user/update",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Cập nhật thành công",
                showConfirmButton: false,
                timer: 1500,
            });
            user.show();
        },
    });
};

user.form_password = function() {
    $("#data-profile").empty();
    $('#address_manage').hide();
    $('#manage_order').hide();
    $('#manage_favorite_products').hide();
    $('#data-profile').append(`
        <form id="form-password" action="" >
            <label>Đổi mật khẩu</label><br>
            <input type="password" value="" id="old_password" placeholder="Mật khẩu cũ"><br>
            <span id="error-old_password" style="color:red"></span><br>
            
            <input type="password" onchange="user.check_password()" value="" id="new_password" placeholder="Mật khẩu mới"><br>
            <span id="error-new_password" style="color:red"></span><br>

            <input type="password" value="" id="confirm_new_password" onchange="user.check_password()" placeholder="Xác nhận mật khẩu mới"><br>
            <span id="error-confirm_new_password" style="color:red"></span><br>
            <a id="trash" href="javascript:;" class="btn btn-info" onclick="user.save_password()">Đổi mật khẩu</a>
        </form>
    `)
};

user.check_password = function() {
    $('#error-old_password').empty();
    $('#error-new_password').empty();
    $('#error-confirm_new_password').empty();
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_new_password = $('#confirm_new_password').val();
    if (old_password) {
        if (user.check_whitespace(old_password)) {
            if (old_password != new_password) {
                if (new_password) {
                    if (user.check_whitespace(new_password)) {
                        if (confirm_new_password) {
                            if (new_password == confirm_new_password) {
                                $('#error-confirm_new_password').empty();
                                return true;
                            } else {
                                $('#error-confirm_new_password').text('Mật khẩu mới không giống nhau !');
                                return false
                            }
                        }
                    } else {
                        $('#error-new_password').text('Mật khẩu không được chứa khoảng trắng !');
                    }
                } else {
                    $('#error-new_password').text('Bạn chưa nhập mật khẩu !');
                }
            } else {
                $('#error-new_password').text('Mật mới không được giống mật khẩu cũ !');
            }
        } else {
            $('#error-old_password').text('Mật khẩu không được chứa khoảng trắng !');
        }
    } else {
        $('#error-old_password').text('Bạn chưa nhập mật khẩu !');
    }
}

user.check_whitespace = function(password) {
    var length1 = password.length;
    var check_password = password.replace(/\s/g, '');
    var length2 = check_password.length;
    if (length1 > length2) {
        return false;
    } else {
        return true;
    }
}

user.save_password = function() {
    var old_password = $('#old_password').val();
    var new_password = $('#new_password').val();
    var confirm_new_password = $('#confirm_new_password').val();
    if (old_password && new_password && confirm_new_password) {
        if (user.check_password() == true) {
            $('#err').empty();
            var data = {};
            data.old_password = old_password;
            data.new_password = new_password;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                url: "/user/update-password",
                data: JSON.stringify(data),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    console.log(response);
                    if (response) {
                        user.resetForm_password();
                        $('#error-confirm_new_password').text('Thay đổi mật khẩu thành công');
                    } else {
                        $('#error-old_password').text('Sai mật khẩu');
                    }
                }
            });
        }
    } else {
        $('#err').text('Vui lòng điền mật khẩu');
    }
}

user.manage_address = function() {
    $("#data-profile").empty();
    $('#manage_order').hide();
    $('#manage_favorite_products').hide();
    $('#address_manage').show();
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
            if (data['statusCode'] != 404) {
                $('#tbl_address tbody').empty();
                $.each(data['shippings'], function(index, value) {
                    $('#tbl_address tbody').append(`
                <tr>
                    <td>${++index}</td>               
                    <td>${value.name}-(+84)${value.phone}-${value.street_names},${value.wards_and_communes},${value.district.name},${value.province_and_city.name}</td>    
                    <td><a href="javascript:;"  onclick="checkout.get_details_shipping(${value.id})" style="color:blue" > Thay đổi</a></td>   
                    <td><a href="javascript:;"  onclick="checkout.delete_address(${value.id})"  style="padding-right:50px;color:red"> Xóa</a></td>               
                </tr>
                   
            `);
                });
            } else {
                $('#tbl_address tbody').empty();
            }
        }

    });
}

user.manage_order = function() {
    $("#data-profile").empty();
    $('#address_manage').hide();
    $('#manage_favorite_products').hide();
    $('#manage_order').show();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "GET",
        url: "/order/get-byId",
        dataType: "json",
        success: function(data) {
            console.log(data);
            $('#tbl_order tbody').empty();
            $.each(data, function(i, value) {
                $.each(value.order_details, function(index, element) {
                    if (element.product.photo_librarys[0]) {
                        $('#tbl_order tbody').append(`
                        <tr>
                            <td><input class="orders" type="checkbox" name="check[]" value="${element.id}"></td>
                            <td><a href="/product/detail/${element.product_id}"><img src="/uploads/images/${element.product.photo_librarys[0].name}" alt="" width="60px" height="60px">${element.product.name}</a></td>
                            <td>${value.id}</td>
                            <td>${element.product_sales_quantity}</td>
                            <td>${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(element.product.price)}</td>
                            <td><span style="color:red">${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(element.product.price * element.product_sales_quantity)}</span></td>
                            <td><a href="javascript:;" class="btn btn-danger" onclick="user.delete_order(${element.id})"  >Hủy đơn</a></td>
                        </tr>
                    `);
                    } else {
                        console.log('ko có ảnh')
                    }
                });
            });
        }
    });
}

user.delete_order = function(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        method: "DELETE",
        url: "/order/delete/" + id,
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            user.manage_order();
        }
    });

}

user.select_all_orders = function() {
    $(".orders").prop('checked', $('#btn-select_all_orders').prop("checked"));
}


user.delete_checkbox_orders = function() {
    var all_checkbox_orders = $('.orders');
    var list_id = Array();
    $.each(all_checkbox_orders, function(i, element) {
        if (element.checked) {
            list_id.push(parseInt(element.value));
        }
    });
    if (list_id.length > 0) {
        var object = {};
        object.list_id = list_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "DELETE",
            url: "/order/delete-multiple",
            data: JSON.stringify(object),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
                console.log(response);
            }
        });
        user.manage_order();
        $('#btn-select_all_orders').attr('checked', false);

    } else {
        Swal.fire('Bạn chưa chọn sản phẩm nào');
    }

}


user.manage_favorite_products = function() {
    $("#data-profile").empty();
    $('#address_manage').hide();
    $('#manage_order').hide();
    $('#manage_favorite_products').show();
    $.ajax({
        type: "GET",
        url: "/product/favorite/getAll",
        data: "data",
        dataType: "json",
        success: function(data) {
            $('#tbl_favorite_products tbody').empty();
            if (data['data'].length > 0) {
                $.each(data['data'], function(i, value) {
                    if (value.product.status == 1 && value.product.photo_librarys[0]) {
                        $('#tbl_favorite_products tbody').append(`
                        <tr>
                            <td><input class="products" type="checkbox" name="check[]" value="${value.id}"></td>
                            <td><a href="/product/detail/${value.product.id}"><img src="/uploads/images/${value.product.photo_librarys[0].name}" alt="" width="60px" height="60px">${value.product.name}</a></td>
                            <td><a href="javascript:;" class="btn btn-danger" onclick="user.delete_favorite_product(${value.id})">Bỏ thích</a></td>
                        </tr>
                    `);
                    }
                });
            }
        }
    });
}

user.delete_favorite_product = function(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        method: "DELETE",
        url: "/product/favorite/delete/" + id,
        dataType: "json",
        contentType: "application/json",
        success: function(response) {
            user.manage_favorite_products();
        }
    });
}



user.select_all_favorite_products = function() {
    $(".products").prop('checked', $('#btn-select_all_favorite_products').prop("checked"));
}


user.delete_checkbox_favorite_products = function() {
    var all_checkbox_products = $('.products');
    var list_id = Array();
    $.each(all_checkbox_products, function(i, element) {
        if (element.checked) {
            list_id.push(parseInt(element.value));
        }
    });
    if (list_id.length > 0) {
        var object = {};
        object.list_id = list_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "DELETE",
            url: "/product/favorite/delete-multiple",
            data: JSON.stringify(object),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
                user.manage_favorite_products();
                $('#btn-select_all_favorite_products').attr('checked', false);


            }
        });

    } else {
        Swal.fire('Bạn chưa chọn sản phẩm nào');
    }

}


user.resetForm_password = function() {
    $('#old_password').val("");
    $('#new_password').val("");
    $('#confirm_new_password').val("");
}

user.init = function() {
    user.showData();
    user.show();
};

$(document).ready(function() {
    user.init();
});