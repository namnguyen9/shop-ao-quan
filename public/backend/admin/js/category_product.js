var category_product = {} || category_product;

//Hàm hiển thị danh sách
category_product.showData = function() {
    $('#cate-Id').val(0);
    $('#tr_category').show();
    $('#btn_add-category').show();
    $('#btn_remove-all').show();
    $('#tr_seo-meta-caregory').hide();
    $('#btn_add-seo-meta').hide();
    $.ajax({
        type: "GET",
        url: "/category-product/json-data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $('#tb_category tbody').empty();
            $.each(data, function(i, category) {
                $('#tb_category tbody').append(`
                <tr class = "status">
                    <td><input class="category" type="checkbox" name="check[]" value="${category.id}"></td>
                    <td>${++i}</td>
                    <td>${category.name}</td>
                    <td>${category.desc}</td>
                    <td id = "td3"></td>
                    <td>${ new Date(category.created_at).getDate()+'-'+(new Date(category.created_at).getMonth()+1)+'-'+new Date(category.created_at).getFullYear()+'   ('+ new Date(category.created_at).getHours() + ":" + new Date(category.created_at).getMinutes() + ":" + new Date(category.created_at).getSeconds()+')'}</td>
                    <td><a  href="javascript:;" onclick="category_product.showDataSeoMeta(${category.id})">Seo meta</a></td>
                    <td>
                        <a  href="javascript:;" onclick="category_product.getDetail(${category.id})"><i title="Chỉnh sửa" style="color:blue" class="fa fa-edit"></i></a>
                        <a  href="javascript:;"onclick="category_product.remove(${category.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                    </td>
                </tr>
                `);
                if (category.status == 1) {
                    $('.status #td3').replaceWith(`<td><a href="javascript:;" id="show" onclick="category_product.status(${category.id})"><i class="fas fa-eye"></i></a></td>`);
                    // return;
                } else {
                    $('.status #td3').replaceWith(`<td><a href="javascript:;" id="hide" onclick="category_product.status(${category.id})"><i class="fas fa-eye-slash"></i></a></td>`);
                }
            })
        }
    });
}

category_product.status = function(id) {
        $.ajax({
            type: "GET",
            url: "/category-product/" + id,
            dataType: "json",
            success: function(category) {
                if (category.status == 1) {
                    var id = category.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "PUT",
                        url: "/category-product/hide-category/" + id,
                        dataType: "json",
                        contentType: "application/json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã ẩn danh mục',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            category_product.showData();
                        }
                    });
                } else {
                    var id = category.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "PUT",
                        url: "/category-product/show-category/" + id,
                        dataType: "json",
                        contentType: "application/json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã hiển thị danh mục',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            category_product.showData();
                        }
                    });
                }
            }
        });
    }
    //Hàm lấy về đối tượng theo id
category_product.getDetail = function(id) {
        category_product.resetForm();
        $.ajax({
            type: "GET",
            url: "/category-product/" + id,
            dataType: "json",
            success: function(category) {
                $('#category_productId').val(category.id);
                $('#category_name').val(category.name);
                $('#category_desc').val(category.desc);
                $('#category_status').val(category.status);
                $(".modal-footer").find("a").text("Cập nhật");
                $('#div_status').hide();
                $('#category_status').val(category.status).hide();
                $("#div_name").attr('class', 'form-group col-md-12');
                $("#modal").modal('show');
            }
        });
    }
    //Hàm lưu khi thêm và cập nhật
category_product.save = function() {
        let category_productId = $('#category_productId').val();
        if (category_productId == 0) {
            var objectAdd = {};
            objectAdd.name = $('#category_name').val();
            objectAdd.desc = $('#category_desc').val();
            objectAdd.status = $('#category_status').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                method: "POST",
                url: "/category-product/create",
                data: JSON.stringify(objectAdd),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Thêm thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modal").modal("hide");
                    category_product.showData();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        $(`.errors-${key}`).text(value);
                    });
                }
            });
        } else {
            var objectEdit = {};
            objectEdit.id = $("#category_productId").val();
            objectEdit.name = $('#category_name').val();
            objectEdit.desc = $('#category_desc').val();
            objectEdit.status = $('#category_status').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "PUT",
                url: "/category-product/" + objectEdit.id,
                data: JSON.stringify(objectEdit),
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Cập nhật thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modal").modal("hide");
                    category_product.showData();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        $(`.errors-${key}`).text(value)
                    });
                }
            });

        }
    }
    // Hàm xóa dữ liệu theo id
category_product.remove = function(id) {
    swal({
            title: "Bạn chắc chắc muốn xóa?",
            text: "Nếu bạn xóa sản phẩm thuộc danh mục này sẽ biến mất.",
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
                    url: "/category-product/" + id,
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
                        category_product.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}


category_product.select_all_categories = function() {
    $(".category").prop('checked', $('#select_all_categories').prop("checked"));
}

category_product.delete_checkbox_categories = function() {
    var all_checkbox_categories = $('.category');
    var list_id = Array();
    $.each(all_checkbox_categories, function(i, element) {
        if (element.checked) {
            list_id.push(parseInt(element.value));
        }
    });
    if (list_id.length > 0) {
        swal({
                title: "Bạn chắc chắc muốn xóa?",
                text: "Nếu bạn xóa sản phẩm thuộc danh mục này sẽ biến mất.",
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
                        url: "/category-product/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            category_product.showData();
                            $('#select_all_categories').attr('checked', false);
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

//seo_meta
category_product.showDataSeoMeta = function(id) {
    $('#cate-Id').val(id);
    $.ajax({
        type: "GET",
        url: "/category-product/data-seo-meta/" + id,
        dataType: "json",
        success: function(data) {
            $('#tr_category').hide();
            $('#btn_add-category').hide();
            $('#btn_remove-all').hide();
            $('#tr_seo-meta-caregory').show();
            $('#btn_add-seo-meta').show();
            $('#tb_category tbody').empty();
            $.each(data, function(i, value) {
                $('#tb_category tbody').append(`
                    <tr>
                        <td>${++i}</td>                    
                        <td>${value.meta_keywords}</td>                    
                        <td>${value.meta_desc}</td>         
                        <td>
                        <a  href="javascript:;" onclick="category_product.getDetailSeoMeta(${value.id})"><i title="Chỉnh sửa" style="color:blue" class="fa fa-edit"></i></a>
                        <a  href="javascript:;"onclick="category_product.removeSeoMeta(${value.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                        </td>           
                    </tr>

                    `);

            })
        }
    });
}

category_product.getDetailSeoMeta = function(id) {
    $.ajax({
        type: "GET",
        url: "/category-product/get-detail/" + id,
        dataType: "json",
        success: function(seo) {
            $('#seo-Id').val(seo.id);
            $('#meta_keywords').val(seo.meta_keywords);
            CKEDITOR.instances.category_meta_desc.setData(seo.meta_desc);
            $(".modal-footer").find("a").text("Cập nhật");
            $('#SeoMetaModal').modal('show');

        }
    });
}

category_product.save_SeoMeta = function() {
    let category_id = $('#cate-Id').val();
    let seo_meta_id = $('#seo-Id').val();
    if (seo_meta_id == 0) {
        let data = {};
        data.meta_keywords = $('#meta_keywords').val();
        data.meta_desc = CKEDITOR.instances.category_meta_desc.getData();
        data.category_id = category_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "POST",
            url: "/category-product/save-seo-meta",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
                if (response == 200) {
                    Swal.fire('Danh mục này đã có seo meta rồi');
                } else if (response == 201)
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Thêm thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                $("#SeoMetaModal").modal("hide");
                category_product.showDataSeoMeta(category_id);
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });
    } else {
        let data = {};
        data.meta_keywords = $('#meta_keywords').val();
        data.meta_desc = CKEDITOR.instances.category_meta_desc.getData();
        data.category_id = category_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "PUT",
            url: "/category-product/update-seo-meta/" + seo_meta_id,
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(response) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Cập nhật thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#SeoMetaModal").modal("hide");
                category_product.showDataSeoMeta(category_id);
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });
    }
}
category_product.removeSeoMeta = function(id) {
    swal({
            title: "Bạn chắc chắc muốn xóa?",
            text: "",
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
                    url: "/category-product/delete-seo-meta/" + id,
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
                        category_product.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa seo meta");
            }
        });
}

category_product.showModalSeoMeta = function() {
    $(".modal-footer").find("a").text("Lưu");
    category_product.resetFormSeoMeta();
    $('#SeoMetaModal').modal('show');
}

category_product.resetFormSeoMeta = function() {
    $('em').empty();
    $('#seo-Id').val(0);
    CKEDITOR.instances.category_meta_desc.setData();
    $('#meta_keywords').val("");
}


// Hàm reset form về mặc định
category_product.resetForm = function() {
        $('em').empty();
        $('#category_status').val(null).trigger("change");
        $('#category_productId').val('0');
        $('#category_name').val("");
        $('#category_desc').val("");
        $('#category_status').val("").show();
        $('#div_status').show();
        $("#div_name").attr('class', 'form-group col-md-8');
        $("#add").text("Lưu");
    }
    // Hàm hiển thị modal
category_product.showModal = function() {
        category_product.resetForm();
        $("#modal").modal('show');
    }
    //Hàm khởi tạo
category_product.init = function() {
    category_product.showData();
}
$(document).ready(function() {
    category_product.init();
});