@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên phim</th>
                <th scope="col">Tên phòng</th>
                <th scope="col">Thời gian chiếu</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $key => $schedule)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $schedule->movies->name }}</td>
                    <td>{{ $schedule->rooms->name }}</td>
                    <td>{{ $schedule->time_start }}</td>

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
@endsection
