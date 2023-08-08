@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div></div>
        <div class="row align-items-center">
            <form action="{{ route('admin.order.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keyname" id="inputEmail6" class="form-control" placeholder="Nhập tên khách hàng"
                        value="{{ isset($keyname) ? $keyname : '' }}">
                </div>
                <div class="col-auto">
                    <input type="date" name="keydate" id="inputEmail6" class="form-control"
                        placeholder="Tìm kiếm theo ngày" value="{{ isset($keydate) ? $keydate : '' }}">
                </div>
                <div class="col-auto">
                    <select class="form-control" id="" name="keystatus">

                        <option value="">Trạng thái</option>
                        <option @if (isset($keystatus) && $keystatus == 1) selected @endif value="1">Chờ thanh toán</option>
                        <option @if (isset($keystatus) && $keystatus == 2) selected @endif value="2">Đã thanh toán</option>
                        <option @if (isset($keystatus) && $keystatus == 3) selected @endif value="3">Đã hủy</option>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th class="">STT</th>
                <th class="text-center">Khách hàng</th>


                <th class="text-center">Mã hóa đơn</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Ngày thanh toán</th>
                <th class="text-center">Tổng tiền</th>
                <th class=""></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    <td class="text-center" style="font-weight: bold">{{ $order->user->name }}</td>


                    <td class="text-center" style="font-weight: bold">{{ $order->order_code }}</td>
                    <td class="text-center">
                        @if ($order->status == 1)
                       
                            <button type="button" class="btn btn-primary"
                                style="width:140px ; font-size: 14px ; font-weight:bold"><i class="far fa-clock"></i> Chờ
                                thanh toán</button>
                        @elseif ($order->status == 2)
                           
                            <button type="button" class="btn btn-success"
                                style="width:140px ; font-size: 14px ; font-weight:bold"><i class="fas fa-check"></i> Đã
                                thanh toán</button>
                        @elseif ($order->status == 3)
                       
                            <button type="button" class="btn btn-danger"
                                style="width:140px ; font-size: 14px ;font-weight:bold"><i class="fas fa-times"></i> Đã
                                hủy</button>
                        @endif
                    </td>
                    <td class="text-center" style="font-weight: bold">{{ $order->created_at }}</td>
                    <td class="text-center" style="font-weight: bold">{{ number_format($order->total) }} VND</td>
                    <td class="text-center" style="width:200px ; display: flex;    justify-content: space-around">
                        @if ($order->status == 3)
                        @else
                            <form action="{{ route('admin.order.cancel', $order->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" onclick='return confirm("Bạn có muốn hủy không")'
                                    class="btn btn-warning">
                                    Hủy Đơn
                                </button>
                            </form>
                        @endif
                        <a href="" class="btn btn-primary ticket-detail" data-toggle="modal"
                            data-target="#exampleModalScrollable" data-ticket={{ $order->id }}>Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Chi tiết vé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="order-id" value="">
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tên phim</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control " id="movie-name" style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Thời lượng</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="movie-times"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Ngày chiếu</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="time-date"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Giờ chiếu</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="times"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Phòng chiếu</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="room"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Ghế</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="seats"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tổng tiền</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="total"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Combo</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="combo"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Voucher</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="voucher"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Điểm sử dụng</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="point"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Phương thức
                            thanh toán</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="payment"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Trạng thái
                            thanh toán</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="status"
                                style="font-weight: bold">
                        </div>
                    </div>
                    <div class="form-group row" id="status-ticket-group">
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Trạng thái
                            sử dụng</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status-ticket">

                                <option value="1">Chưa sử dụng </option>
                                <option value="2">Đã sử dụng</option>

                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary save-button">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.ticket-detail', function(e) {
            var orderId = $(this).data('ticket');
            // console.log(orderId);
            $.ajax({
                url: '/admin/order/show/' + orderId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#order-id').val(data.order_id);
                    $('#movie-name').val(data.movie_name);
                    $('#movie-times').val(data.movie_time);
                    $('#time-date').val(data.datePart);
                    $('#times').val(data.timePart);
                    $('#room').val(data.room_name);
                    $('#seats').val(data.seatNames);
                    $('#total').val(data.total);
                    $('#combo').val(data.productNames);
                    $('#voucher').val(data.discount);
                    $('#point').val(data.point);
                    $('#payment').val(data.payment);
                    $('#status').val(data.status);
                    if (data.status == 1) {
                        $('#status').val("Chờ thanh toán");
                        $('.save-button').css('display', 'none');
                    } else if (data.status == 2) {
                        $('#status').val("Thanh toán thành công");
                        $('.save-button').css('display', '');
                    } else if (data.status == 3) {
                        $('#status').val("Đã hủy");
                        $('.save-button').css('display', 'none');
                        $('#status-ticket-group').css('display', 'none');
                    }
                    if (data.status_ticket == 1) {
                        $('#status-ticket').val(1);
                        $('#status-ticket-group').css('display', '');
                    } else if (data.status_ticket == 2) {
                        $('#status-ticket').val(2);
                        $('#status-ticket-group').css('display', '');
                    } else if (data.status_ticket == null) {
                        $('#status-ticket-group').css('display', 'none');
                    }
                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
        $(document).on('click', '.save-button', function(e) {
            e.preventDefault();
            var orderId = $('#order-id').val();
            var data = {
                'status_ticket': $('#status-ticket').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/order/updateStatusTicket/' + orderId,
                type: 'PUT',
                data: data,
                // dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Cập nhật dữ liệu thành công.',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
                    }).then(function() {
                        // Sau khi popup đóng, load lại trang
                        location.reload();
                    });


                }
            });
        })
    </script>
@endsection
