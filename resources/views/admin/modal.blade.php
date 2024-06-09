<!-- Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Thông báo đơn hàng mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="notification-list" class="list-group">
                    @foreach($payments as $payment)
                    @if($payment->notification == 0)
                    <li class="text-danger item-notification" style="cursor: pointer; padding-left: 4px;margin-bottom: 12px; ">
                        <a href="/admin/payments/notification/{{$payment->id}}">
                            Đơn hàng từ {{ $payment->phone }} địa chỉ nhận {{$payment->address}}
                        </a>
                    </li>
                    @else
                    <li class="item-notification" style="cursor: pointer; padding-left: 4px;margin-bottom: 12px; ">Đơn hàng từ {{ $payment->phone }} địa chỉ nhận {{$payment->address}}</li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
