@extends('master')

@section('title')
    Cập Nhật - {{ $customer->name }}
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-info">
            Thao Tác Thành Công
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
        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="" class="form-label">name</label>
                <input type="text" class="form-control" name="name" id="" value="{{ $customer->name }}" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">IMG</label>
                <input type="file" class="form-control" name="avatar" id="" />
                <img src="{{ Storage::url($customer->avatar) }}" alt="" width="100px">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="" value="{{ $customer->email }}"
                    placeholder="abc@mail.com" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">address</label>
                <input type="text" class="form-control" name="address" id="" value="{{ $customer->address }}"
                    placeholder="abc@mail.com" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">phone</label>
                <input type="phone" class="form-control" name="phone" id="" value="{{ $customer->phone }}" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">is active</label>
                <input type="checkbox" name="is_active" @checked($customer->is_active) value="1" />
            </div>
            <button type="submit" class="btn btn-primary mt-3">GỬi</button>
        </form>
    </div>
@endsection
