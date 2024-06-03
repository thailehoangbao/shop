                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if(Auth::user()->avatar == null)
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/uploads/avatardefault.jpg') }}" alt="User profile picture">
                            @else
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/uploads/' . Auth::user()->avatar) }}" alt="User profile picture">
                            @endif
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>