<!--===============================================================================================-->
<script src="/template/client/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/bootstrap/js/popper.js"></script>
<script src="/template/client/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="/template/client/vendor/daterangepicker/moment.min.js"></script>
<script src="/template/client/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/slick/slick.min.js"></script>
<script src="/template/client/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="/template/client/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="/template/client/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="/template/client/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<!--===============================================================================================-->
<script src="/template/client/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="/template/client/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('fade-out');
            }, 2000); // 2 seconds before fade out
            setTimeout(() => {
                alert.remove();
            }, 2500); // 2.5 seconds before removing from DOM
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert-danger');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('fade-out');
            }, 2000); // 2 seconds before fade out
            setTimeout(() => {
                alert.remove();
            }, 2500); // 2.5 seconds before removing from DOM
        }
    });
</script>

</script>
<script>
    function animateCounter(element, start, end, duration) {
        let startTime = null;

        function updateCounter(currentTime) {
            if (!startTime) startTime = currentTime;
            const progress = Math.min((currentTime - startTime) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value;
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        }

        requestAnimationFrame(updateCounter);
    }

    document.addEventListener('DOMContentLoaded', () => {
        animateCounter(document.querySelector('#counter__year .counter__content'), 0, 5, 5000);
        animateCounter(document.querySelector('#counter__team .counter__content'), 0, 25, 5000);
        animateCounter(document.querySelector('#counter__client .counter__content'), 0, 500, 5000);
    });
</script>