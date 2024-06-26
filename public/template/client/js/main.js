(function ($) {
    "use strict";

    // function saveUserToLocalStorage(user, token) {
    //     localStorage.setItem("user", JSON.stringify(user));
    // }

    $(document).ready(function () {
        // Thiết lập token CSRF cho tất cả các yêu cầu AJAX
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });


        // $("#login-form").on("submit", function (e) {
        //     e.preventDefault();

        //     var formData = {
        //         email: $("#l-email").val(),
        //         password: $("#l-password").val(),
        //     };

        //     $.ajax({
        //         type: "POST",
        //         url: "/client/login",
        //         data: formData,
        //         dataType: "json",
        //         success: function (response) {
        //             if (response.success) {
        //                 const newUser = {
        //                     ...response.user,
        //                     token: response.token,
        //                 };
        //                 saveUserToLocalStorage(newUser);
        //                 window.location.href = response.redirect_url;
        //                 // Thêm đoạn script để reload lại trang

        //                 window.addEventListener("load", function () {
        //                     location.reload();
        //                 });
        //             } else {
        //                 $("#error-message").text(response.message);
        //             }
        //         },
        //         error: function (xhr) {
        //             var errors = xhr.responseJSON.errors;
        //             var errorMessage = "";
        //             for (var error in errors) {
        //                 if (errors.hasOwnProperty(error)) {
        //                     errorMessage += errors[error] + "\n";
        //                 }
        //             }
        //             $("#error-message").text(errorMessage);
        //         },
        //     });
        // });
    });

    function deleteUser() {
        localStorage.removeItem("user");
    }

    $(document).ready(function () {
        $("#logout-link").on("click", function () {
            deleteUser();
        });
    });

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: "fade-in",
        outClass: "fade-out",
        inDuration: 1500,
        outDuration: 800,
        linkElement: ".animsition-link",
        loading: true,
        loadingParentElement: "html",
        loadingClass: "animsition-loading-1",
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ["animation-duration", "-webkit-animation-duration"],
        overlay: false,
        overlayClass: "animsition-overlay-slide",
        overlayParentElement: "html",
        transition: function (url) {
            window.location.href = url;
        },
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css("display", "flex");
        } else {
            $("#myBtn").css("display", "none");
        }
    });

    $("#myBtn").on("click", function () {
        $("html, body").animate({ scrollTop: 0 }, 300);
    });

    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $(".container-menu-desktop");
    var wrapMenu = $(".wrap-menu-desktop");

    if ($(".top-bar").length > 0) {
        var posWrapHeader = $(".top-bar").height();
    } else {
        var posWrapHeader = 0;
    }

    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass("fix-menu-desktop");
        $(wrapMenu).css("top", 0);
    } else {
        $(headerDesktop).removeClass("fix-menu-desktop");
        $(wrapMenu).css("top", posWrapHeader - $(this).scrollTop());
    }

    $(window).on("scroll", function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass("fix-menu-desktop");
            $(wrapMenu).css("top", 0);
        } else {
            $(headerDesktop).removeClass("fix-menu-desktop");
            $(wrapMenu).css("top", posWrapHeader - $(this).scrollTop());
        }
    });

    /*==================================================================
    [ Menu mobile ]*/
    $(".btn-show-menu-mobile").on("click", function () {
        $(this).toggleClass("is-active");
        $(".menu-mobile").slideToggle();
    });

    var arrowMainMenu = $(".arrow-main-menu-m");

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on("click", function () {
            $(this).parent().find(".sub-menu-m").slideToggle();
            $(this).toggleClass("turn-arrow-main-menu-m");
        });
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($(".menu-mobile").css("display") == "block") {
                $(".menu-mobile").css("display", "none");
                $(".btn-show-menu-mobile").toggleClass("is-active");
            }

            $(".sub-menu-m").each(function () {
                if ($(this).css("display") == "block") {
                    console.log("hello");
                    $(this).css("display", "none");
                    $(arrowMainMenu).removeClass("turn-arrow-main-menu-m");
                }
            });
        }
    });

    /*==================================================================
    [ Show / hide modal search ]*/
    $(".js-show-modal-search").on("click", function () {
        $(".modal-search-header").addClass("show-modal-search");
        $(this).css("opacity", "0");
    });

    $(".js-hide-modal-search").on("click", function () {
        $(".modal-search-header").removeClass("show-modal-search");
        $(".js-show-modal-search").css("opacity", "1");
    });

    $(".container-search-header").on("click", function (e) {
        e.stopPropagation();
    });

    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $(".isotope-grid");
    var $filter = $(".filter-tope-group");

    // filter items on button click
    $filter.each(function () {
        $filter.on("click", "button", function () {
            var filterValue = $(this).attr("data-filter");
            $topeContainer.isotope({ filter: filterValue });
        });
    });

    // init Isotope
    $(window).on("load", function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: ".isotope-item",
                layoutMode: "fitRows",
                percentPosition: true,
                animationEngine: "best-available",
                masonry: {
                    columnWidth: ".isotope-item",
                },
            });
        });
    });

    var isotopeButton = $(".filter-tope-group button");

    $(isotopeButton).each(function () {
        $(this).on("click", function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass("how-active1");
            }

            $(this).addClass("how-active1");
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $(".js-show-filter").on("click", function () {
        $(this).toggleClass("show-filter");
        $(".panel-filter").slideToggle(400);

        if ($(".js-show-search").hasClass("show-search")) {
            $(".js-show-search").removeClass("show-search");
            $(".panel-search").slideUp(400);
        }
    });

    $(".js-show-search").on("click", function () {
        $(this).toggleClass("show-search");
        $(".panel-search").slideToggle(400);

        if ($(".js-show-filter").hasClass("show-filter")) {
            $(".js-show-filter").removeClass("show-filter");
            $(".panel-filter").slideUp(400);
        }
    });

    /*==================================================================
    [ Cart ]*/
    $(".js-show-cart").on("click", function () {
        $(".js-panel-cart").addClass("show-header-cart");
    });

    $(".js-hide-cart").on("click", function () {
        $(".js-panel-cart").removeClass("show-header-cart");
    });

    /*==================================================================
    [ Cart ]*/
    $(".js-show-sidebar").on("click", function () {
        $(".js-sidebar").addClass("show-sidebar");
    });

    $(".js-hide-sidebar").on("click", function () {
        $(".js-sidebar").removeClass("show-sidebar");
    });

    /*==================================================================
    [ +/- num product ]*/
    $(".btn-num-product-down").on("click", function () {
        var numProduct = Number($(this).next().val());
        if (numProduct > 0)
            $(this)
                .next()
                .val(numProduct - 1);
    });

    $(".btn-num-product-up").on("click", function () {
        var numProduct = Number($(this).prev().val());
        $(this)
            .prev()
            .val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $(".wrap-rating").each(function () {
        var item = $(this).find(".item-rating");
        var rated = -1;
        var input = $(this).find("input");
        $(input).val(0);

        $(item).on("mouseenter", function () {
            var index = item.index(this);
            var i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass("zmdi-star-outline");
                $(item[i]).addClass("zmdi-star");
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass("zmdi-star-outline");
                $(item[j]).removeClass("zmdi-star");
            }
        });

        $(item).on("click", function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on("mouseleave", function () {
            var i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass("zmdi-star-outline");
                $(item[i]).addClass("zmdi-star");
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass("zmdi-star-outline");
                $(item[j]).removeClass("zmdi-star");
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $(".js-show-modal1").on("click", function (e) {
        e.preventDefault();
        var product = $(this).closest(".isotope-item").data("product");
        var total_price =
            product.price - (product.price * product.price_sale) / 100;
        // Set the product details in the modal
        $(".js-modal1 .js-name-detail").text(product.name);

        if (product.price_sale == 0) {
            $(".js-modal1 .mtext-106").text(
                "Giá: " + product.price.toLocaleString("vi-VN") + " VND"
            );
        } else {
            // Giả định total_price được tính toán ở đâu đó trong mã của bạn
            $(".js-modal1 .mtext-106").text(
                "Giá: " +
                    total_price.toLocaleString("vi-VN") +
                    " VND - " +
                    "Sale off " +
                    product.price_sale +
                    " %"
            );
        }
        $(".js-modal1 .stext-102").text(product.description);
        $(".js-modal1 .wrap-pic-w img").attr(
            "src",
            "/storage/uploads/" + product.thumb
        );
        if (product.price_sale != 0) {
            product.price =
                product.price - (product.price * product.price_sale) / 100;
            product.price_s =
                product.price_s - (product.price_s * product.price_sale) / 100;
            product.price_l =
                product.price_l - (product.price_l * product.price_sale) / 100;
        }

        // Set the values for the select options
        $("#price_choice .price__m").text(
            "Size M - " + product.price.toLocaleString("vi-VN") + " VND"
        );
        $("#price_choice .price__s").text(
            "Size S - " + product.price_s.toLocaleString("vi-VN") + " VND"
        );
        $("#price_choice .price__l").text(
            "Size L - " + product.price_l.toLocaleString("vi-VN") + " VND"
        );

        // Set the values for the select options
        $("#price_choice .price_default").val(product.price);
        $("#price_choice .price__m").val(product.price);
        $("#price_choice .price__s").val(product.price_s);
        $("#price_choice .price__l").val(product.price_l);

        $(".js-modal1").addClass("show-modal1");

        // Lưu product hiện tại vào modal để sử dụng khi Add to cart
        $(".js-modal1").data("product", product);
    });

    $(".js-hide-modal1").on("click", function () {
        $(".js-modal1").removeClass("show-modal1");
        location.reload();
    });

    $(".js-addcart-detail").on("click", function (e) {
        e.preventDefault();

        var product = $(".js-modal1").data("product");
        var form = $(this).closest("form");
        var amount = form.find('input[name="num-product"]').val();
        var price_choice = form.find('select[name="price_choice"]').val();

        // Thêm thông tin sản phẩm vào form trước khi submit
        $("<input>")
            .attr({
                type: "hidden",
                name: "product_id",
                value: product.id,
            })
            .appendTo(form);

        $("<input>")
            .attr({
                type: "hidden",
                name: "amount",
                value: amount,
            })
            .appendTo(form);
        $("<input>")
            .attr({
                type: "hidden",
                name: "price_choice",
                value: price_choice,
            })
            .appendTo(form);
        form.submit();
    });

   
})(jQuery);
