<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#payments" data-toggle="tab">Payments</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name....">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="number" name="phone_number" class="form-control" id="phone_number" placeholder="Enter your phone...">
                            </div>
                            @error('number_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="location" id="location" placeholder="Enter your location...."></textarea>
                            </div>
                        </div>
                        <div class="form-control">
                            <label for="file">Upload Avatar</label>
                            <input type="file" name="avatar" id="avatar" placeholder="Enter your avatar...">
                            @error('avatar')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="payments">
                    @if(!isset($payments))
                        <p>Empty payments!</p>
                    @else
                        <p>List Payments is proceeding!</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>List</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $key => $payment)
                            <tr>
                                <td>{{ $payment['id'] }}</td>
                                <td>{{ $payment->phone }}</td>
                                <td>{{ $payment->address }}</td>
                                <td>
                                    {!! App\Helpers\Helpers::statusPayment($payment->status) !!}
                                </td>
                                <td>
                                    <form action="{{ url('/profile/show-detail') }}" method="get">
                                        @csrf
                                        <input type="hidden" name="list" value="{{ $payment['list'] }}">
                                        <button type="submit" class="text-primary"> show detail</button>
                                    </form>
                                </td>
                                <td>{{ $payment['updated_at'] }}</td>
                                <td class="d-flex">
                                    <form action="{{ url('/profile/destroy-payment') }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $payment['id'] }}">
                                        <button type="submit" class="btn btn-danger"> <i class="fa-solid fa-circle-xmark"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>


                    </table>
                    @endif
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
