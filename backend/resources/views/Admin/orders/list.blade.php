@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div></div>
        <div class="row align-items-center">
            <form action="{{route('admin.order.search')}}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keyname" id="inputEmail6" class="form-control" placeholder="Nhập tên khách hàng"  value="{{ isset($keyname) ? $keyname : '' }}">
                </div>
                <div class="col-auto">
                    <input type="date" name="keydate" id="inputEmail6" class="form-control" placeholder="Tìm kiếm theo ngày" value="{{ isset($keydate) ? $keydate : '' }}">
                </div>
                <div class="col-auto">
                    <select  class="form-control" id="" name="keystatus">
                       
                        <option value="">Trạng thái</option>
                        <option @if(isset($keystatus) && $keystatus ==1) selected @endif value="1">Chờ thanh toán</option>
                        <option @if(isset($keystatus) && $keystatus ==2) selected @endif value="2">Đã thanh toán</option>
                        <option @if(isset($keystatus) && $keystatus ==3) selected @endif value="3">Đã hủy</option>
                       
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
                <th class="">Khách hàng</th>
               
               
                <th class="">Mã thanh toán</th>
                <th class="">Trạng thái</th>
                <th class="">Ngày thanh toán</th>
                <th class="">Tổng tiền</th>
                <th class="">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    <td class="" style="font-weight: bold">{{ $order->user->name }}</td>
                    
                    
                    <td class="">{{ $order->order_code }}</td>
                    <td class="">
                        @if ($order->status === 1)
                            <button type="button" class="btn btn-primary" style="width:140px ; font-size: 13px ; font-weight:bold"><i class="far fa-clock"></i> Chờ thanh toán</button>
                        @elseif ($order->status === 2)
                           <button type="button" class="btn btn-success" style="width:140px ; font-size: 13px ; font-weight:bold"><i class="fas fa-check"></i> Đã thanh toán</button>
                        @elseif ($order->status === 3)
                            <button type="button" class="btn btn-danger" style="width:140px ; font-size: 13px ;font-weight:bold"><i class="fas fa-times"></i> Đã hủy</button>
                        @endif
                    </td>
                    <td class="">{{ $order->created_at }}</td>
                    <td class="" style="font-weight: bold">{{ number_format($order->total) }} VND</td>
                    <td class="" style="width:200px ; display: flex;    justify-content: space-around">
                        @if ($order->status === 3)

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
                        <a href="" class="btn btn-primary ticket-detail" data-toggle="modal" data-target="#exampleModalScrollable" data-ticket= {{$order->id}}>Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">Chi tiết vé</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tên phim</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control " id="movie-name" style="font-weight: bold">
                        </div>
                      </div>
                    <div class="form-group row" style="font-weight: bold">
                      <label for="inputPassword" class="col-sm-3 col-form-label">Thời lượng</label>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control" id="movie-times" style="font-weight: bold">
                      </div>
                    </div>
                    <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Ngày chiếu</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="time-date" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Giờ chiếu</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="times" style="font-weight: bold" >
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold"> 
                        <label for="inputPassword" class="col-sm-3 col-form-label">Phòng chiếu</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="room" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Ghế</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="seats" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tổng tiền</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="total" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Combo</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="combo" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Voucher</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="voucher" style="font-weight: bold">
                        </div>
                      </div>
                      <div class="form-group row" style="font-weight: bold">
                       <label for="inputPassword" class="col-sm-3 col-form-label">Điểm sử dụng</label>
                        <div class="col-sm-9">
                          <input type="text" readonly class="form-control" id="point" style="font-weight: bold">
                        </div>
                      </div> 
                      <div class="form-group row" >
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Phương thức thanh toán</label>
                         <div class="col-sm-9">
                           <input type="text" readonly class="form-control" id="payment" style="font-weight: bold">
                         </div>
                       </div>
                       <div class="form-group row" >
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Trạng thái thanh toán</label>
                         <div class="col-sm-9">
                           <input type="text" readonly class="form-control" id="status" style="font-weight: bold">
                         </div>
                       </div>
                       <div class="form-group row" id="status-ticket-group">
                        <label for="inputPassword" class="col-sm-3 col-form-label" style="font-weight: bold">Trạng thái sử dụng</label>
                         <div class="col-sm-9">
                            <select  class="form-control" id="status-ticket" >
                              
                                <option value="1" >Chưa sử dụng </option>
                                <option value="2" >Đã sử dụng</option>
                               
                              </select>
                         </div>
                       </div> 
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).on('click', '.ticket-detail', function(e) {
            var orderId = $(this).data('ticket');
            $.ajax({
                url: '/admin/order/show/' + orderId ,
                type: 'GET',
                // data: {
                //     id: month
                // },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
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
                    if(data.status == 1){
                        $('#status').val("Chờ thanh toán");
                    }else if(data.status == 2){
                        $('#status').val("Thanh toán thành công");
                    }else if(data.status_ticket == 3){
                        $('#status').val("Đã hủy");
                    }
                    if(data.status_ticket == 1){
                        $('#status-ticket').val(1);
                        $('#status-ticket-group').css('display', '');
                    }else if(data.status_ticket == 2){
                        $('#status-ticket').val(2);
                        $('#status-ticket-group').css('display', '');
                    }else if(data.status_ticket == null){
                        $('#status-ticket-group').css('display', 'none');
                    }
                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
       
    </script>
@endsection
