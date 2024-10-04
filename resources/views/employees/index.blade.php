@extends('master')

@section('title')
    Danh Sách người thanh toán
@endsection

@section('content')
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            Thao Tác Thành Công  
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-primary align-middle">
            <thead class="table-light">
                <caption>
                    Danh Sách Employee
                </caption>
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>img</th>
                    <th>date-of-birth</th>
                    <th>hire-date</th>
                    <th>salary</th>
                    <th>is_active</th>
                    <th>department_id</th>
                    <th>manager_id</th>
                    <th>address</th>
                    <th>create</th>
                    <th>update</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $item)
                    <tr class="table-primary">
                        <td scope="row">{{ $item->id }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <img src="{{ Storage::url($item->profile_picture) }}" alt="" width="50px">
                        </td>
                        <td>{{ $item->date_of_birth }}</td>
                        <td>{{ $item->hire_date }}</td>
                        <td>{{ $item->salary }}</td>
                        <td>
                            @if ($item->is_active === 1)
                                <span class="badge bg-primary">yes</span>
                            @else
                                <span class="badge bg-danger">no</span>
                            @endif
                        </td>
                        <td>{{ $item->department_id }}</td>
                        <td>{{ $item->manager_id }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $item) }}" class="btn btn-warning">sửa</a>
                            <a href="{{ route('employees.show', $item) }}" class="mt-2 mb-2 btn btn-info">xem</a>

                            <form action="{{ route('employees.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('xóa ?')" class="btn btn-danger">XÓA</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{ $data->links() }}
            </tfoot>
        </table>
    </div>
@endsection
