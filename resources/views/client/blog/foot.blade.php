<script src="/template/client/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="/template/client/js/templatemo-script.js"></script>
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

