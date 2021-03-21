var brand_product = {} || brand_product;

//Hàm hiển thị danh sách
brand_product.showData = function() {
    $('#bra-Id').val(0);
    $('#tr_brand').show();
    $('#btn_add-brand').show();
    $('#btn_remove-all-brand').show();
    $('#tr_seo-meta-brand').hide();
    $('#btn_add-seo-meta').hide();
    $.ajax({
        type: "GET",
        url: "/brand-product/json-data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $('#tb_brand tbody').empty();
            $.each(data, function(i, brand) {
                $('#tb_brand tbody').append(`
                <tr class = "status">
                    <td><input class="brands" type="checkbox" name="" value="${brand.id}"></td>
                    <td>${++i}</td>
                    <td>${brand.name}</td>
                    <td>${brand.desc}</td>
                    <td id = "td3"></td>
                    <td>${ new Date(brand.created_at).getDate()+'-'+(new Date(brand.created_at).getMonth()+1)+'-'+new Date(brand.created_at).getFullYear()+'   ('+ new Date(brand.created_at).getHours() + ":" + new Date(brand.created_at).getMinutes() + ":" + new Date(brand.created_at).getSeconds()+')'}</td>
                    <td><a  href="javascript:;" onclick="brand_product.showDataSeoMeta(${brand.id})">Seo meta</a></td>
                    <td>
                        <a  href="javascript:;" onclick="brand_product.getDetail(${brand.id})"><i title="Chỉnh sửa" style="color:blue" class="fa fa-edit"></i></a>
                        <a  href="javascript:;"onclick="brand_product.remove(${brand.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                    </td>
                </tr>
                `);
                if (brand.status == 1) {
                    $('.status #td3').replaceWith(`<td><a href="javascript:;" id="show" onclick="brand_product.status(${brand.id})"><i class="fas fa-eye"></i></a></td>`);
                    // return;
                } else {
                    $('.status #td3').replaceWith(`<td><a href="javascript:;" id="hide" onclick="brand_product.status(${brand.id})"><i class="fas fa-eye-slash"></i></a></td>`);
                }
            })
        }

    });
}

brand_product.status = function(id) {
        $.ajax({
            type: "GET",
            url: "/brand-product/" + id,
            dataType: "json",
            success: function(brand) {
                if (brand.status == 1) {
                    var id = brand.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "PUT",
                        url: "/brand-product/hide-brand/" + id,
                        dataType: "json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã ẩn thương hiệu',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            brand_product.showData();
                        }
                    });
                } else {
                    var id = brand.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "PUT",
                        url: "/brand-product/show-brand/" + id,
                        dataType: "json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã hiển thị thương hiệu',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            brand_product.showData();
                        }
                    });
                }
            }
        });
    }
    //Hàm lấy về đối tượng theo id
brand_product.getDetail = function(id) {
        brand_product.resetForm();
        $.ajax({
            type: "GET",
            url: "/brand-product/" + id,
            dataType: "json",
            success: function(brand) {
                $('#brand_productId').val(brand.id);
                $('#brand_name').val(brand.name);
                $('#brand_desc').val(brand.desc);
                $(".modal-footer").find("a").text("Cập nhật");
                $('#div_status').hide();
                $('#brand_status').val(brand.status).hide();
                $("#div_name").attr('class', 'form-group col-md-12');
                $("#modal").modal('show');
            }
        });
    }
    //Hàm lưu khi thêm và cập nhật
brand_product.save = function() {
        let brand_productId = $('#brand_productId').val();
        if (brand_productId == 0) {
            var objectAdd = {};
            objectAdd.name = $('#brand_name').val();
            objectAdd.desc = $('#brand_desc').val();
            objectAdd.status = $('#brand_status').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                method: "POST",
                url: "/brand-product/create",
                data: JSON.stringify(objectAdd),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Thêm thàng công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modal").modal("hide");
                    brand_product.showData();
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        $(`.errors-${key}`).text(value)
                    });
                }
            });
        } else {
            var objectEdit = {};
            objectEdit.id = $("#brand_productId").val();
            objectEdit.name = $('#brand_name').val();
            objectEdit.desc = $('#brand_desc').val();
            objectEdit.status = $('#brand_status').val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "PUT",
                url: "/brand-product/" + objectEdit.id,
                data: JSON.stringify(objectEdit),
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Cập nhật thàng công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modal").modal("hide");
                    brand_product.showData();
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
brand_product.remove = function(id) {
    swal({
            title: "Bạn chắc chắc muốn xóa?",
            text: "Nếu bạn xóa tất cả sản phẩm thuộc thương hiệu này sẽ biến mất",
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
                    url: "/brand-product/" + id,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Xóa thành công',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        brand_product.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}


brand_product.select_all_brands = function() {
    $(".brands").prop('checked', $('#select_all_brands').prop("checked"));
}

brand_product.delete_checkbox_brands = function() {
    var all_checkbox_brands = $('.brands');
    var list_id = Array();
    $.each(all_checkbox_brands, function(i, element) {
        if (element.checked) {
            list_id.push(parseInt(element.value));
        }
    });
    if (list_id.length > 0) {
        swal({
                title: "Bạn chắc chắc muốn xóa?",
                text: "Nếu bạn xóa tất cả sản phẩm thuộc thương hiệu này sẽ biến mất.",
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
                        url: "/brand-product/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            brand_product.showData();
                            $('#select_all_brands').attr('checked', false);
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
brand_product.showDataSeoMeta = function(id) {
    $('#bra-Id').val(id);
    $.ajax({
        type: "GET",
        url: "/brand-product/data-seo-meta/" + id,
        dataType: "json",
        success: function(data) {
            $('#tr_brand').hide();
            $('#btn_add-brand').hide();
            $('#btn_remove-all-brand').hide();
            $('#tr_seo-meta-brand').show();
            $('#btn_add-seo-meta').show();
            $('#tb_brand tbody').empty();
            $.each(data, function(i, value) {
                $('#tb_brand tbody').append(`
                    <tr>
                        <td>${++i}</td>                    
                        <td>${value.meta_keywords}</td>                    
                        <td>${value.meta_desc}</td>         
                        <td>
                        <a  href="javascript:;" onclick="brand_product.getDetailSeoMeta(${value.id})"><i title="Chỉnh sửa" style="color:blue" class="fa fa-edit"></i></a>
                        <a  href="javascript:;"onclick="brand_product.removeSeoMeta(${value.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                        </td>           
                    </tr>

                    `);

            })
        }
    });
}

brand_product.getDetailSeoMeta = function(id) {
    $.ajax({
        type: "GET",
        url: "/brand-product/get-detail/" + id,
        dataType: "json",
        success: function(seo) {
            console.log(seo);
            $('#brand_seo_Id').val(seo.id);
            $('#brand-meta_keywords').val(seo.meta_keywords);
            CKEDITOR.instances.brand_meta_desc.setData(seo.meta_desc);
            $(".modal-footer").find("a").text("Cập nhật");
            $('#brand-SeoMetaModal').modal('show');

        }
    });
}

brand_product.save_SeoMeta = function() {
    let brand_id = $('#bra-Id').val();
    let seo_meta_id = $('#brand_seo_Id').val();
    if (seo_meta_id == 0) {
        let data = {};
        data.meta_keywords = $('#brand-meta_keywords').val();
        data.meta_desc = CKEDITOR.instances.brand_meta_desc.getData();
        data.brand_id = brand_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "POST",
            url: "/brand-product/save-seo-meta",
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
                $("#brand-SeoMetaModal").modal("hide");
                brand_product.showDataSeoMeta(brand_id);
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });
    } else {
        let data = {};
        data.meta_keywords = $('#brand-meta_keywords').val();
        data.meta_desc = CKEDITOR.instances.brand_meta_desc.getData();
        data.brand_id = brand_id;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "PUT",
            url: "/brand-product/update-seo-meta/" + seo_meta_id,
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
                $("#brand-SeoMetaModal").modal("hide");
                brand_product.showDataSeoMeta(brand_id);
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });
    }
}

brand_product.removeSeoMeta = function(id) {
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
                    url: "/brand-product/delete-seo-meta/" + id,
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
                        brand_product.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa seo meta");
            }
        });
}

brand_product.showModalSeoMeta = function() {
    $(".modal-footer").find("a").text("Lưu");
    brand_product.resetFormSeoMeta();
    $('#brand-SeoMetaModal').modal('show');
}

brand_product.resetFormSeoMeta = function() {
    $('em').empty();
    $('#brand_seo_Id').val(0);
    CKEDITOR.instances.brand_meta_desc.setData();
    $('#brand-meta_keywords').val("");
}

// Hàm reset form về mặc định
brand_product.resetForm = function() {
        $('em').empty();
        $('#brand_status').val(null).trigger("change");
        $('#brand_productId').val('0');
        $('#brand_name').val("");
        $('#brand_desc').val("");
        $('#brand_status').val("").show();
        $('#div_status').show();
        $("#div_name").attr('class', 'form-group col-md-8');
        $("#add").text("Lưu");
    }
    // Hàm hiển thị modal
brand_product.showModal = function() {
        brand_product.resetForm();
        $("#modal").modal('show');
    }
    //Hàm khởi tạo
brand_product.init = function() {
    brand_product.showData();
}
$(document).ready(function() {
    brand_product.init();
});