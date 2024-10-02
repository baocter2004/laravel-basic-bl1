@extends('master')

@section('title')
    danh sách
@endsection

@section('content')
    <div class="mt-3 mb-3">
        @if (session('success'))
            <div class="alert alert-info">
                Thao Tác Thành Công
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-primary align-middle">
                <thead class="table-light">
                    <caption>
                        Danh Sách Customer
                    </caption>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>avatar</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Is Active</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $customer)
                        <tr class="table-primary">
                            <td scope="row">{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <img src="{{ Storage::url($customer->avatar) }}" alt="" width="50px">
                            </td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>
                                @if ($customer->is_active === 1)
                                    <span class="badge bg-primary">yes</span>
                                @else
                                    <span class="badge bg-danger">no</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info">Chi Tiết</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning mt-2">Sửa</a>

                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    class="mt-2 mb-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('bạn muốn xóa ?')"
                                        class="btn btn-danger">xóa dởm</button>
                                </form>

                                <form action="{{ route('customers.forceDestroy', $customer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('bạn muốn xóa ?')"
                                        class="btn btn-danger">xóa thiệt</button>
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
    </div>
@endsection
