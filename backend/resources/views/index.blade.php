<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .row {
            border-top: 1px solid rgb(232, 232, 232);
            padding-bottom: 20px;
        }
    </style>
</head>

<body>
    <a href="http://localhost:3200"></a>

    <div class="" style="width: 8cm; margin:auto">
        <div class="name-movie" style="text-align: center; background-color: white;">
            <h3 style="text-transform: uppercase; font-weight: bold;">{{ $orderSchedules[0]->movie_name }}</h3>
            <div>
                <p>{{ $orderSchedules[0]->room_name }}|2D phụ đề| {{ $orderSchedules[0]->time }}</p>
            </div>

        </div>
        <div class="row " style=" background-color: white; font-size: 14px;">
            <div class="col-md-5">
                <div class="pt-2">Ngày chiếu</div>
                <div class="pt-2">Giờ chiếu</div>
                <div class="pt-2">Phòng chiếu</div>
                <div class="pt-2">Ghế ngồi</div>
                <div class="pt-2">Combo</div>
            </div>
            <div class="col-md-7" style="font-weight: bold ">
                <div class="pt-2">{{ $datePart }}</div>
                <div class="pt-2">{{ $timePart }}</div>
                <div class="pt-2">{{ $orderSchedules[0]->room_name }}</div>
                <div class="pt-2">{{ $seatNames }}</div>
                <div class="pt-2">{{ $productNames }}</div>
            </div>
        </div>
        <div class="row " style="background-color: white; font-size: 14px;  padding-bottom: 0px;">
            <div class="col-md-4">
                <div class="pt-2">Voucher</div>
                <div class="pt-2">Dùng Điểm</div>
                <div class="pt-2">Thẻ</div>
            </div>
            <div class="col-md-4 " style="font-weight: bold">
                <div class="pt-2">{{ $orderDiscounts->code }} ({{ $orderDiscounts->percent }}%)</div>
                <div class="pt-2">{{ $order->points }}</div>
                <div class="pt-2">{{ $orderTransaction->bank_code }}</div>
            </div>
            <div class="col-md-4  "
                style="display: flex;align-items: center; justify-content: center; flex-direction: column;font-weight: bold; border-left: 1px solid;">
                <div>Tổng tiền</div>
                <div style="color: red;">{{ number_format($order->total, 0, ',', '.') }} VNĐ</div>
            </div>
        </div>
        <div class="pt-4"
            style="border-top: 6px dotted rgb(196, 196, 196); background-color: white; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <div>
                {!! DNS2D::getBarcodeHTML('http://127.0.0.1:8000/bill?details=' . $enOrderCode, 'QRCODE', 3, 3) !!}
            </div>
            <div class="pt-2">{{ $order->order_code }}</div>
        </div>



        <div style="font-size: 12px; padding-top: 10px">
            <div>
                <p>Vui lòng đưa mã số này đến quầy vé Cyber để nhận vé</p>
            </div>
            <div>
                <p><b style="color: red;">Lưu ý</b>: Cyber Cinema không chấp nhận hoàn tiền hoặc đổi vé đã thanh toán
                    thành
                    công trên Website</p>
            </div>
        </div>

        <a href="http://localhost:3200/" class="btn btn-success" style="width: 100%;">Trang chủ</a>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
