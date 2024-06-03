                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Email</strong>

                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{Auth::user()->location}}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Number Phone</strong>

                        <p class="text-muted">
                            +84 {{ Auth::user()->phone_number }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> History Orders</strong>

                        <p class="text-muted">
                            <a href="{{ route('orders.index') }}" class="btn btn-warning text-white m-t-4">View History</a>
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
