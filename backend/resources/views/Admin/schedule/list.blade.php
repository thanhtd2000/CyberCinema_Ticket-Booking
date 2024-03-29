@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row">
        <button class="btn btn-primary mb-3 ml-2 col-md-1">
            <a class="text-white" href="{{ route('admin.schedule.create') }}">Thêm</a>
        </button>
        <form action="{{ route('admin.schedule.search') }}" method="POST" class="d-flex col-md-5">
            @csrf
            @method('get')
            <input type="date" name="date_start" class="form-control mr-2">
            <div>
                <input type="submit" class="btn btn-primary" value="Tìm kiếm">
            </div>

        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên phim</th>
                <th scope="col">Tên phòng</th>
                <th scope="col">Thời gian bắt đầu</th>
                <th scope="col">Thời gian kết thúc</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $key => $schedule)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td style="font-weight: bold">{{ $schedule->movies->name ?? 'Phim đã xoá hoặc không tồn tại' }}</td>
                    <td style="font-weight: bold">{{ $schedule->room->name }}</td>
                    <td style="font-weight: bold">{{ $schedule->time_start }}</td>
                    <td style="font-weight: bold">{{ $schedule->time_end }}</td>

                    <td>
                        <a class="btn btn-success" href="{{ route('admin.schedule.edit', $schedule->id) }}"><i
                                class="fas fa-pencil-alt"></i> </a>
                        <a class="btn btn-danger" OnClick='return confirm("Bạn có muốn xóa không?");'
                            href="{{ route('admin.schedule.delete', $schedule->id) }}"><i class="fas fa-trash-alt"></i> </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $schedules->links() }}
@endsection
