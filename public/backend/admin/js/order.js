var order = {} || order;

//Hàm hiển thị danh sách
order.showData = function() {
    $.ajax({
        type: "GET",
        url: "/order/json-data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $('#tb_order tbody').empty();
            $.each(data, function(i, order) {
                $('#tb_order tbody').append(`
                <tr class = "status">
                    <td><input class="order" type="checkbox" name="check[]" value="${order.id}"></td>
                    <td>${++i}</td>
                    <td>${order.shipping.name}</td>
                    <td>${order.user_id}</td>
                    <td>${order.shipping.phone}</td>
                    <td>${order.shipping.street_names + order.shipping.wards_and_communes + order.shipping.district.name + order.shipping.province_and_city.name}</td>
                    <td>${order.payment.method}</td>
                    <td>${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(order.total)}</td>
                    <td>${order.status}</td>
                    <td>${order.note}</td>
                    <td>
                        <a  href="javascript:;" onclick="order.details(${order.id})">Xem chi tiết</a>
                    </td>
                    <td>
                        <a  href="javascript:;"onclick="order.remove(${order.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                    </td>
                </tr>
                `);
            })
        }
    });
}

order.details = function(id) {
    $("#btn-back").show();
    $("#order").hide();
    $("#view_order").show();
    $.ajax({
        type: "GET",
        url: "/order/details/" + id,
        data: "data",
        dataType: "json",
        success: function(data) {
            $("#tb_shipping tbody").empty();
            $("#tb_order_details tbody").empty();
            $("#tb_shipping tbody").append(`
            <tr>
                <td>${data.shipping.name}</td>
                <td>${data.shipping.phone}</td>
                <td>${data.shipping.street_names},${data.shipping.wards_and_communes},${data.shipping.district.name},${data.shipping.province_and_city.name}</td>
            </tr>
        `);
            $.each(data.order_details, function(i, value) {
                $("#tb_order_details tbody").append(`
                    <tr>
                        <td>${++i}</td>
                        <td>${value.product.name}</td>
                        <td>${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.product.price)}</td>
                        <td>${value.product_sales_quantity}</td>
                        <td>${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.product.price * value.product_sales_quantity)}</td>
                    </tr>
                `);
            });
        }
    });
}

order.back = function() {
    $("#order").show();
    $("#view_order").hide();
    $("#btn-back").hide();
}

order.remove = function(id) {
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
                    url: "/order/destroy/" + id,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Xóa thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        order.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}



order.select_all_orders = function() {
    $(".order").prop('checked', $('#select_all_orders').prop("checked"));
}

order.delete_checkbox_orders = function() {
    var all_checkbox_orders = $('.order');
    var list_id = Array();
    $.each(all_checkbox_orders, function(i, element) {
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
                        url: "/order/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            order.showData();
                            $('#select_all_orders').attr('checked', false);
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

order.init = function() {
    order.showData();
}

$(document).ready(function() {
    order.init();
});