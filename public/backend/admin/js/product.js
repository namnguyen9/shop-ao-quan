var product = {} || product;
var data = new Array();

//Hàm hiển thị danh sách
product.showData = function() {
        $('#tb_product tbody').empty();
        $('#tr_product').show();
        $('#btnProduct').show();
        $('#btn-select_all_pro').show();
        $('#tr_image').hide();
        $('#comback').hide();
        $('#btn-select_all_img').hide();
        $.ajax({
            type: "GET",
            url: "/product/json-data",
            data: "data",
            dataType: "json",
            success: function(data) {
                $.each(data, function(i, product) {
                    $('#tb_product tbody').append(`
                        <tr class = "status">
                            <td><input class="product" type="checkbox" name="check[]" value="${product.id}"></td>
                            <td>${++i}</td>
                            <td>${product.name}</td>
                            <td>${product.desc}</td>
                            <td>${product.fabric_material}</td>
                            <td>${product.style}</td>
                            <td><a  href="javascript:;" onclick="product.get_images_ById(${product.id})">Hình ảnh</a></td>
                            <td>${product.color}</td>
                            <td> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(product.price)}</td>
                            <td>${product.size}</td>
                            <td>${product.origin}</td>
                            <td id = "td3"></td>
                            <td>${product.category.name}</td>
                            <td>${product.brand.name}</td>
                            <td>${ new Date(product.created_at).getDate()+'-'+(new Date(product.created_at).getMonth()+1)+'-'+new Date(product.created_at).getFullYear()+'   ('+ new Date(product.created_at).getHours() + ":" + new Date(product.created_at).getMinutes() + ":" + new Date(product.created_at).getSeconds()+')'}</td>
                            <td>
                                <a  href="javascript:;" onclick="product.getDetail(${product.id})"><i title="Chỉnh sửa" style="color:blue" class="fa fa-edit"></i></a>
                                <a  href="javascript:;"onclick="product.remove(${product.id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    `);
                    if (product.status == 1) {
                        $('.status #td3').replaceWith(`<td><a href="javascript:;" id="show" onclick="product.Show_and_Hiden(${product.id})"><i class="fas fa-eye"></i></a></td>`);
                        // return;
                    } else {
                        $('.status #td3').replaceWith(`<td><a href="javascript:;" id="hide" onclick="product.Show_and_Hiden(${product.id})"><i class="fas fa-eye-slash"></i></a></td>`);
                    }
                })
            }

        });
    }
    //Hàm lấy về tất cả các tên của danh mục
product.getAll_Category = function() {
    $.ajax({
        type: "GET",
        url: "/category-product/json-data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, value) {
                $('#category_id').append(`
                        <option value="${value.id}">${value.name}</option>
                    `)
            })
        }
    });
}

//Hàm lấy về tất cả các tên của thương hiệu
product.getAll_Brand = function() {
    $.ajax({
        type: "GET",
        url: "/brand-product/json-data",
        data: "data",
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, value) {
                $('#brand_id').append(`
                        <option value="${value.id}">${value.name}</option>
                    `)
            })
        }
    });
}

product.Show_and_Hiden = function(id) {
        $.ajax({
            type: "GET",
            url: "/product/" + id,
            dataType: "json",
            success: function(data) {
                if (data.status == 1) {
                    var id = data.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        method: "PUT",
                        url: "/product/hide-product/" + id,
                        dataType: "json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã ẩn sản phẩm',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#modal").modal("hide");
                            product.showData();
                        },

                    });
                } else {
                    var id = data.id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        method: "PUT",
                        url: "/product/show-product/" + id,
                        dataType: "json",
                        success: function(data) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Đã hiển thị sản phẩm',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#modal").modal("hide");
                            product.showData();
                        },

                    });
                }
            }
        });
    }
    //Hàm lấy về đối tượng theo id
product.getDetail = function(id) {
    product.resetForm();
    $.ajax({
        type: "GET",
        url: "/product/" + id,
        dataType: "json",
        success: function(product) {
            $('#productId').val(product.id);
            $('#name').val(product.name);
            CKEDITOR.instances.desc.setData(product.desc);
            $('#fabric_material').val(product.fabric_material);
            $('#style').val(product.style);
            $('#size').val(product.size);
            $('#origin').val(product.origin);
            $('#color').val(product.color);
            $('#price').val(product.price);
            $('#status').val(product.status);
            $('#category_id').val(product.category_id).trigger("change");
            $('#brand_id').val(product.brand_id).trigger("change");
            $(".modal-footer").find("a").text("Cập nhật");
            $('#div_status').hide();
            $('#back').hide();
            $('#status').val(product.status).hide();
            $("#div_name").attr('class', 'form-group col-md-12');
            $("#modal").modal('show');
        }
    });
}

product.save = function() {
    let productId = $('#productId').val();
    if (productId == 0) {
        var form_data = new FormData();
        var name = $('#name').val();
        var desc = CKEDITOR.instances.desc.getData();
        var fabric_material = $('#fabric_material').val();
        var style = $('#style').val();
        var size = $('#size').val();
        var origin = $('#origin').val();
        var color = $('#color').val();
        var price = $('#price').val().replace(/,/g, "");
        var status = $('#status').val();
        var category_id = $('#category_id').val();
        var brand_id = $('#brand_id').val();
        form_data.append('name', name);
        form_data.append('desc', desc);
        form_data.append('fabric_material', fabric_material);
        form_data.append('style', style);
        form_data.append('size', size);
        form_data.append('origin', origin);
        form_data.append('color', color);
        form_data.append('price', price);
        form_data.append('status', status);
        form_data.append('category_id', category_id);
        form_data.append('brand_id', brand_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "POST",
            url: "/product/create",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function(response) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Thêm sản phẩm thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#modal").modal("hide");
                product.showData();
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });

    } else {
        var form_data = new FormData();
        var id = $("#productId").val();
        var name = $('#name').val();
        var desc = CKEDITOR.instances.desc.getData();
        var size = $('#size').val();
        var origin = $('#origin').val();
        var fabric_material = $('#fabric_material').val();
        var style = $('#style').val();
        var color = $('#color').val();
        var price = $('#price').val().replace(/,/g, "");
        var status = $('#status').val();
        var category_id = $('#category_id').val();
        var brand_id = $('#brand_id').val();
        form_data.append('id', id);
        form_data.append('name', name);
        form_data.append('desc', desc);
        form_data.append('size', size);
        form_data.append('origin', origin);
        form_data.append('fabric_material', fabric_material);
        form_data.append('style', style);
        form_data.append('color', color);
        form_data.append('price', price);
        form_data.append('status', status);
        form_data.append('category_id', category_id);
        form_data.append('brand_id', brand_id);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "POST",
            url: "/product/" + id,
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function(data) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Cập nhật sản phẩm thành công',
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#modal").modal("hide");
                product.showData();
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    $(`.errors-${key}`).text(value)
                });
            }
        });

    }
};
// }
// Hàm xóa dữ liệu theo id
product.remove = function(id) {
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
                    url: "/product/" + id,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response);
                        swal("Xóa sản phẩm thành công", {
                            icon: "success",
                        });
                        product.showData();
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}

product.get_images_ById = function(product_id) {
    $('#tb_product tbody').empty();
    $('#product-Id').val(product_id);
    $('#tr_product').hide();
    $('#btnProduct').hide();
    $('#btn-select_all_pro').hide();
    $('#tr_image').show();
    $('#comback').show();
    $('#btn-select_all_img').show();
    $.ajax({
        type: "GET",
        url: "/library/" + product_id,
        dataType: "json",
        success: function(data) {
            $.each(data, function(i, v) {
                $('#tb_product tbody').append(`
                    <tr>
                        <td hidden><input id="id-pro"  type="hidden" value="${product_id}"></td>
                        <td><input class="image" type="checkbox" name="check[]" value="${v.id}"></td>
                        <td>${++i}</td>
                        <td contenteditable class="edit_img_name" id ="${v.id}">${v.name}</td>
                        <td><img src="/uploads/images/${v.name}" width = "100px" height="110px"> <input type="file" id="up_img-${v.id}" value="" onchange ="product.update_image(${v.id},${v.product_id})"></td>
                        <td><a  href="javascript:;"onclick="product.remove_file(${v.id},${v.product_id})"><i style="color:red" title="Xóa" class="fa fa-trash"></i></a></td>
                    </tr>
                    `);
            })

        }
    });
}


// product.save = function() {
product.loadFile = function() {
    $('#errors-images').empty();
    $('#Image_preview').empty();
    var images = $('#images').prop('files');
    if (images && images[0]) {
        var type = ['image/jpeg', 'image/png', 'image/jpg', 'image/jpeg'];
        if (images.length <= 6) {
            data.length = 0
            for (let i = 0; i < images.length; i++) {
                if (images[i].type == type[0] || images[i].type == type[1] || images[i].type == type[2] || images[i].type == type[3]) {
                    data.push(images[i]);
                    $('#err').hide();
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#Image_preview').append(`<a  id="img-${i}" onclick =" product.delete(${i})" href="javascript:;" ><img src="${e.target.result}" alt="Cinque Terre" width="100" height="110"></a>`);
                    }
                    reader.readAsDataURL(images[i]);
                    $('#msg').show();
                } else {
                    $('#errors-images').append(`<em style="color:red" id="err" class="errors-images">Hình ảnh phải có đuôi gif, png, jpg, jpeg</em >`);
                    $('#image').val('');
                }
            }
        } else {
            $('#errors-images').append(`<em style="color:red" id="err" class="errors-images">Chọn được tối đa là 6 hình ảnh</em >`);
        }
    }
}

product.delete = function(index) {
    $(`#img-${index}`).remove();
    data[index] = 0
    if (data.length == 0) {
        $("#images").val("");
        $('#msg').hide();
    }
}

product.save_file = function() {
    var product_id = $('#product-Id').val();
    var datafile = data.filter((el) => {
        return el != 0;
    });
    if (datafile.length != 0) {
        var form_data = new FormData();
        for (let i = 0; i < datafile.length; i++) {
            form_data.append('images' + i, datafile[i]);
        }
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            method: "POST",
            url: "/library/create/" + product_id,
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function(response) {
                if (response == 200) {
                    $('#msg').hide();
                    $("#modal-file").modal('hide');
                    data.length = 0;
                    product.get_images_ById(product_id);
                    Swal.fire('Số lượng ảnh vượt quá quy định');
                } else {
                    $('#msg').hide();
                    $("#modal-file").modal('hide');
                    data.length = 0;
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Thêm hình ảnh thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    product.get_images_ById(product_id);
                }
            },
        });
    } else {
        $('#errors-images').empty();
        $('#errors-images').append(`<em style="color:red" id="err" class="errors-images">Vui lòng chọn hình ảnh !</em >`);
    }
}


$(document).on('blur', '.edit_img_name', function() {
    var img_id = $(this)[0].id;
    var img_name = $(this).text();
    var name = img_name.replace(/[?`~[;':\/>àảãáạăằẳẵắặâầẩẫấậÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬđĐèẻẽéẹêềểễếệÈẺẼÉẸÊỀỂỄẾỆìỉĩíịÌỈĨÍỊòỏõóọôồổỗốộơờởỡớợÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢùủũúụưừửữứựÙỦŨÚỤƯỪỬỮỨỰỳỷỹýỵỲỶỸÝỴ<"!@#$%^&*()|,=_+-]/g, "")
    var obj = {};
    obj.name = name;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "POST",
        url: "/library/update-name/" + img_id,
        data: JSON.stringify(obj),
        dataType: "json",
        contentType: "application/json",
        success: function(product_id) {
            product.get_images_ById(product_id);
        },
    });
})

product.update_image = function(id, product_id) {
    var new_file = $(`#up_img-${id}`).prop('files');
    if (new_file.length > 0) {
        var type = ['image/jpeg', 'image/png', 'image/jpg', 'image/jpeg'];
        var ext = new_file[0].type;
        if (ext == type[0] || ext == type[1] || ext == type[2] || ext == type[3]) {
            var form_data = new FormData();
            form_data.append('file', new_file[0]);
            swal({
                    title: "Bạn có chăc chắn không ?",
                    text: "Thêm hình ảnh mới sẽ mất hình ảnh cũ!",
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
                            type: "POST",
                            url: "/library/update-file/" + id,
                            data: form_data,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(response) {
                                swal("Cập nhật thành công", {
                                    icon: "success",
                                });
                                product.get_images_ById(product_id);
                            }
                        });
                    } else {
                        swal("Bạn đã hủy cập nhật");
                    }
                });
        } else {
            swal("Hình ảnh không hợp lệ", "Hình ảnh phải có đuôi gif, png, jpg, jpeg", "error");
        }
    } else {
        swal("Hình ảnh không tồn tại", "", "error");
    }
}


product.remove_file = function(id, product_id) {
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
                    url: "/library/destroy/" + id,
                    dataType: "json",
                    contentType: "application/json",
                    success: function(response) {
                        swal("Xóa sản phẩm thành công", {
                            icon: "success",
                        });
                        product.get_images_ById(product_id);
                    }
                });
            } else {
                swal("Bạn đã hủy xóa sản phẩm");
            }
        });
}

product.select_all_products = function() {
    $(".product").prop('checked', $('#select_all_products').prop("checked"));
}

product.delete_checkbox_products = function() {
    var all_checkbox_products = $('.product');
    var list_id = Array();
    $.each(all_checkbox_products, function(i, element) {
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
                        url: "/product/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            product.showData();
                            $('#select_all_products').attr('checked', false);
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


product.select_all_images = function() {
    $(".image").prop('checked', $('#select_all_images').prop("checked"));
}

product.delete_checkbox_images = function() {
    var all_checkbox_images = $('.image');
    var list_id = Array();
    $.each(all_checkbox_images, function(i, element) {
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
                    var pro_id = $('#id-pro').val();
                    var object = {};
                    object.list_id = list_id;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        method: "POST",
                        url: "/library/delete-multiple",
                        data: JSON.stringify(object),
                        dataType: "json",
                        contentType: "application/json",
                        success: function(response) {
                            swal("Xóa sản phẩm thành công", {
                                icon: "success",
                            });
                            product.get_images_ById(pro_id);
                            $('#select_all_images').attr('checked', false);
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

// Hàm reset form về mặc định
product.resetForm = function() {
        $('em').empty();
        $('#msg').hide();
        $('#errors-images').empty();
        $('#productId').val('0');
        $('#name').val("");
        CKEDITOR.instances.desc.setData();
        $('#size').val("");
        $('#origin').val("");
        $('#fabric_material').val("");
        $('#style').val("");
        $('#images').val("");
        $('#color').val("");
        $('#price').val("");
        $('#Image_preview').empty();
        $('#category_id').val(null).trigger("change");
        $('#status').val(null).trigger("change");
        $('#brand_id').val(null).trigger("change");
        $('#status').val("").show();
        $('#div_status').show();
        $('#upload').show();
        $("#div_name").attr('class', 'form-group col-md-8');
        $("#save").text("Lưu");
    }
    // Hàm hiển thị modal
product.showModal = function() {
    product.resetForm();
    $("#modal").modal('show');
}

product.showModalFile = function() {
    $("#modal-file").modal('show');
    $('#images').val(null).trigger('change');
    $('#msg').hide();
}

product.format_money = function() {
    // Jquery Dependency
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        },
    });

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        // get input value
        var input_val = input.val();
        // don't validate empty input
        if (input_val === "") {
            return;
        }
        // original length
        var original_len = input_val.length;
        // initial caret position
        var caret_pos = input.prop("selectionStart");
        // check for decimal
        if (input_val.indexOf(".") >= 0) {
            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");
            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);
            // add commas to left side of number
            left_side = formatNumber(left_side);
            // validate right side
            right_side = formatNumber(right_side);
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
                right_side;
            }
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);
            // join number by .
            input_val = left_side + "." + right_side;
        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;
            // final formatting
            if (blur === "blur") {
                input_val;
            }
        }
        // send updated string to input
        input.val(input_val);
        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
}

//Hàm khởi tạo
product.init = function() {
    $('#status').select2({
        placeholder: "--Vui lòng chọn---",
        dropdownParent: $('#Form')
    });
    $('#category_id').select2({
        placeholder: "--Vui lòng chọn---",
        dropdownParent: $('#Form')
    });
    $('#brand_id').select2({
        placeholder: "--Vui lòng chọn---",
        dropdownParent: $('#Form')
    });
    product.format_money();
    product.showData();
    product.getAll_Category();
    product.getAll_Brand();
}
$(document).ready(function() {
    product.init();
});