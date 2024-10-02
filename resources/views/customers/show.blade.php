@extends('master')

@section('title')
    Chi Tiết
@endsection

@section('content')
    <table class="table table-striped">
        <tr>
            <th>Trường</th>
            <th>giá trị</th>
        </tr>
        @foreach ($customer->toArray() as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @php
                        switch ($key) {
                            case 'avatar':
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
