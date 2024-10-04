@extends('master')

@section('title')
    Thêm Mới
@endsection

@section('content')

    {{-- không được show lỗi này cho user :))) --}}
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-3">
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">name</label>
                <input type="text" class="form-control" name="name" id="" value="{{ old('name') }}" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">IMG</label>
                <input type="file" class="form-control" name="avatar" id="" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="" value="{{ old('email') }}"
                    placeholder="abc@mail.com" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">address</label>
                <input type="text" class="form-control" name="address" id="" value="{{ old('address') }}"
                    placeholder="abc@mail.com" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">phone</label>
                <input type="phone" class="form-control" name="phone" id="" value="{{ old('phone') }}" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">is active</label>
                <input type="checkbox" name="is_active" value="1" />
            </div>
            <button type="submit" class="btn btn-primary mt-3">GỬi</button>
        </form>
    </div>
@endsection
