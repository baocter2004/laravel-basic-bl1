@extends('master')

@section('title')
    Chi Tiết
@endsection

@section('content')
    <table class="table table-striped">
        <tr>
            <th>Trường</th>
            <th>Giá Trị</th>
        </tr>
        @foreach ($employee->toArray() as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @php
                        switch ($key) {
                            case 'profile_picture':
                                $url = \Storage::url($value);
                                echo "<img src=\"$url\" width=\"50px\">";
                                break;
                            case 'is_active':
                                echo $value ? 'yes' : 'no';
                                break;
                            default:
                                echo $value;
                        }
                    @endphp
                </td>
            </tr>
        @endforeach

    </table>
@endsection
