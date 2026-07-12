{{-- resources/views/admin/dashboard/reserves/show.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'جزئیات رزرو')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">جزئیات رزرو #{{ $reserve->id }}</h1>
        <a href="{{ route('admin.reserves.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> بازگشت به لیست
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 fw-bold text-primary">اطلاعات ثبت‌شده</h6>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">نام و نام خانوادگی:</label>
                    <p class="form-control-plaintext">{{ $reserve->name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">شماره تماس:</label>
                    <p class="form-control-plaintext" dir="ltr">{{ $reserve->phone }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">ایمیل:</label>
                    <p class="form-control-plaintext">{{ $reserve->email ?? 'وارد نشده' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">نوع مراسم:</label>
                    <p class="form-control-plaintext">{{ $reserve->event_type ?? 'تعیین نشده' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">تعداد مهمان:</label>
                    <p class="form-control-plaintext">{{ $reserve->guest_count ?? 'تعیین نشده' }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">تاریخ رزرو:</label>
                    <p class="form-control-plaintext">{{ $reserve->reservation_date }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">ساعت ورود:</label>
                    <p class="form-control-plaintext">{{ $reserve->entry_time }}</p>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold text-gray-600">ساعت خروج:</label>
                    <p class="form-control-plaintext">{{ $reserve->exit_time }}</p>
                </div>
                <div class="col-12">
                    <label class="fw-bold text-gray-600">وضعیت:</label>
                    <p>
                        @if($reserve->status === 'pending')
                            <span class="badge bg-warning text-dark fs-6">در انتظار بررسی</span>
                        @elseif($reserve->status === 'confirmed')
                            <span class="badge bg-success fs-6">تأیید شده</span>
                        @elseif($reserve->status === 'rejected')
                            <span class="badge bg-danger fs-6">رد شده</span>
                        @endif
                    </p>
                </div>
                <div class="col-12">
                    <label class="fw-bold text-gray-600">توضیحات:</label>
                    <div class="p-3 bg-light rounded">
                        {{ $reserve->description ?? 'بدون توضیحات' }}
                    </div>
                </div>
                <div class="col-12">
                    <small class="text-muted">
                        تاریخ ثبت: {{ $reserve->created_at->format('Y/m/d ساعت H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection