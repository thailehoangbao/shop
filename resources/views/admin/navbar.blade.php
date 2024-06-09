        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="notification-icon">
                <!-- Notification Bell -->
                <button id="notificationBell" class="btn btn-outline-secondary" data-toggle="modal" data-target="#notificationModal">
                    <i class="fa fa-bell"></i>
                    <span id="notification-count" class="badge badge-danger">{{$sum}}</span>
                </button>
            </div>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- /.navbar -->
