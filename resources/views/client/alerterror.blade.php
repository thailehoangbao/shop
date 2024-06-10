<div class="container" style="position: fixed; margin-top: 100px; z-index: 100;">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button>
        </div>
        @endif
</div>
