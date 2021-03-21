var home = {} || home;

home.add_cart = function(id) {
        var quantity = $('#qty').val();
        if (quantity >= 1 && quantity < 200) {
            cart = {};
            cart.id = id;
            cart.qty = quantity;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/cart/save",
                data: JSON.stringify(cart),
                dataType: "json",
                contentType: "application/json",
                success: function(response) {
                    console.log(response['data']);
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Thêm thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('.badge').text(`${response['count']}`);
                }
            });
        } else {
            Swal.fire('Chọn ít nhất 1 sản phẩm')
        }
    }
    //Hàm lấy tất cả danh mục sản phẩm
home.getAll_category = function() {
    $.ajax({
        type: "GET",
        url: "/category-product/json-data",
        dataType: "json",
        success: function(categorys) {
            $('#accordian').empty();
            $.each(categorys, function(i, value) {
                if (value.status == 1) {
                    $('#accordian').append(`
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span><a href="javascript:;" onclick ="home.getPro_by_category(${value.id})">${value.name}</a></
                                    </a>
                                </h4>
                            </div>
                        </div>
                    `);
                }
            });
        }

    });
}

//Hàm lấy sản phảm thuộc từng danh mục
home.getPro_by_category = function(id) {
    $.ajax({
        type: "GET",
        url: "/category-product/home/" + id,
        dataType: "json",
        success: function(category) {
            $('#products').empty();
            $('#category_title').text(category.name);
            $('#title').text(category.name);
            //seo meta
            try {
                $('meta[name="description"]').attr('content', category.seo_meta_category.meta_desc);
                $('meta[name="keywords"]').attr('content', category.seo_meta_category.meta_keywords);
            } catch (error) {

            }
            $.each(category.products, function(i, value) {
                if (value.status == 1 && value.photo_librarys[0]) {
                    $('#products').append(`
                    <a href="/product/detail/${value.id}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/uploads/images/${value.photo_librarys[0].name}" alt="" />
                                        <h2> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price)}</h2>
                                        <p>${value.name}</p>
                                    </div>
                                </div>
                                
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="javascript:;" onclick="home.add_favorite_product(${value.id})"><i style="color: pink" class="fas fa-heart"></i></i>Thêm yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                    `);
                }
            });

        }

    });
}

//Hàm lấy tất cả thương hiệu sản phẩm
home.getAll_brand = function() {
    $.ajax({
        type: "GET",
        url: "/brand-product/json-data",
        dataType: "json",
        success: function(brands) {
            $('#brands').empty();
            $.each(brands, function(i, value) {
                if (value.status == 1) {
                    $('#brands').append(`
                    <li><a href="javascript:;" onclick ="home.getPro_by_brand(${value.id})"> <span class="pull-right">(50)</span>${value.name}</a></li>
                    `);
                }
            });
        }
    });
}


//Hàm lấy sản phảm thuộc từng thương hiệu
home.getPro_by_brand = function(id) {
    $.ajax({
        type: "GET",
        url: "/brand-product/home/" + id,
        dataType: "json",
        success: function(brand) {
            $('#products').empty();
            $('#category_title').text(brand.name);
            $('#title').text(brand.name);
            //seo meta
            try {
                $('meta[name="description"]').attr('content', brand.seo_meta_brand.meta_desc);
                $('meta[name="keywords"]').attr('content', brand.seo_meta_brand.meta_keywords);
            } catch (error) {

            }
            $.each(brand.products, function(i, value) {
                if (value.status == 1 && value.photo_librarys[0]) {
                    $('#products').append(`
                        <a href="/product/detail/${value.id}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="/uploads/images/${value.photo_librarys[0].name}" alt="" />
                                                <h2> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price)}</h2>
                                                <p>${value.name}</p>
                                            </div>
                                    </div>
                                    
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="javascript:;" onclick="home.add_favorite_product(${value.id})"><i style="color: pink" class="fas fa-heart"></i></i>Thêm yêu thích</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `);
                }
            });

        }
    });
}

// Lấy ra 6 sản phẩm mới nhất
home.getAll_product = function() {
    $.ajax({
        type: "GET",
        url: "/trang-chu/json-data",
        dataType: "json",
        success: function(products) {
            $('#products').empty();
            $.each(products, function(i, value) {
                if (value.status == 1 && value.photo_librarys[0]) {
                    $('#products').append(`
                    <a href="/product/detail/${value.id}" >
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img id="img-${value.id}" src="/uploads/images/${value.photo_librarys[0].name}" alt="" />
                                        <h2 id="price-${value.id}"> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price)}</h2>
                                        <p id="name-${value.id}">${value.name}</p>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="javascript:;" onclick="home.add_favorite_product(${value.id})"><i style="color: pink" class="fas fa-heart"></i></i>Thêm yêu thích</a></li>
                                        <li><a href="javascript:;" ><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>	
                    </a>
                    `);
                }
            });
        }

    });
}


home.search = function() {
    var key1 = $('#search').val();
    var key = key1.replace(/ +/g, "")
    if (key) {
        object = {};
        object.key = key;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            type: "POST",
            url: "/trang-chu/search",
            data: JSON.stringify(object),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                $('#products').empty();
                if (data.length > 0) {
                    $('#category_title').text("Kết quả tìm kiếm");
                    $.each(data, function(i, value) {
                        if (value.status == 1 && value.photo_librarys[0]) {
                            $('#products').append(`
                            <a href="/product/detail/${value.id}">
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="/uploads/images/${value.photo_librarys[0].name}"  width="255" height="255" alt="" />
                                                <h2> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.price)}</h2>
                                                <p>${value.name}</p>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="javascript:;" onclick="home.add_favorite_product(${value.id})"><i style="color: pink" class="fas fa-heart"></i></i>Thêm yêu thích</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>	
                            </a>
                    `);
                        }

                    });
                } else {
                    $('#category_title').text("Không tìm thấy kết quả");
                }
            }

        });
    }
    var key1 = $('#search').val("");
}

home.add_favorite_product = function(id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        type: "POST",
        url: "/product/favorite/" + id,
        data: "data",
        dataType: "json",
        success: function(status) {
            if (status['statusCode'] == 201) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Đã thêm vào danh sách yêu thích',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else if (status['statusCode'] == 200) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'Bạn đã thích sản phẩm này rồi',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                location.href = "/user/login";
            }

        }
    });
}

home.get_favorite_products = function() {
    $.ajax({
        type: "GET",
        url: "/product/favorite/getAll",
        data: "data",
        dataType: "json",
        success: function(data) {
            if (data['data'] != null) {
                $('#products').empty();
                if (data['data'].length > 0) {
                    $('#category_title').text("Sản phẩm yêu thích ");
                    $.each(data['data'], function(i, value) {
                        if (value.product.status == 1 && value.product.photo_librarys[0]) {
                            $('#products').append(`
                        <a href="/product/detail/${value.product.id}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/uploads/images/${value.product.photo_librarys[0].name}"  width="255" height="255" alt="" />
                                            <h2> ${new Intl.NumberFormat('vi', { style: 'currency', currency: 'VND' }).format(value.product.price)}</h2>
                                            <p>${value.product.name}</p>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>	
                        </a>
                `);
                        }

                    });
                } else {
                    $('#category_title').text("Bạn chưa thích sản phẩm nào");
                }
            } else {
                location.href = "/user/login";
            }
        }
    });
}



home.init = function() {
    home.getAll_category();
    home.getAll_brand();
    home.getAll_product();
}

$(document).ready(function() {
    home.init();

});