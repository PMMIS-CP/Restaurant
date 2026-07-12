{{-- resources/views/admin/dashboard/reserves/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'مدیریت رزروها')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">لیست درخواست‌های رزرو</h1>
        <span class="badge bg-primary fs-6">{{ $reserves->total() }} درخواست</span>
    </div>

    {{-- پیام موفقیت --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>نوع مراسم</th>
                            <th>تعداد مهمان</th>
                            <th>تاریخ رزرو</th>
                            <th>ساعت</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reserves as $reserve)
                        <tr>
                            <td>{{ $reserves->firstItem() + $loop->index }}</td>
                            <td class="fw-bold">{{ $reserve->name }}</td>
                            <td dir="ltr" class="text-start">{{ $reserve->phone }}</td>
                            <td>{{ $reserve->email ?? '-' }}</td>
                            <td>{{ $reserve->event_type ?? '-' }}</td>
                            <td>{{ $reserve->guest_count ?? '-' }}</td>
                            <td>{{ $reserve->reservation_date }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $reserve->entry_time }} تا {{ $reserve->exit_time }}
                                </span>
                            </td>
                            <td>
                                @if($reserve->status === 'pending')
                                    <span class="badge bg-warning text-dark">در انتظار بررسی</span>
                                @elseif($reserve->status === 'confirmed')
                                    <span class="badge bg-success">تأیید شده</span>
                                @elseif($reserve->status === 'rejected')
                                    <span class="badge bg-danger">رد شده</span>
                                @else
                                    <span class="badge bg-secondary">{{ $reserve->status }}</span>
                                @endif
                            </td>
                            <td>{{ $reserve->created_at->format('Y/m/d H:i') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.reserves.show', $reserve->id) }}" 
                                       class="btn btn-info text-white" title="مشاهده جزئیات">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.reserves.destroy', $reserve->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('آیا از حذف این رزرو اطمینان دارید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-times fs-3 mb-3 d-block"></i>
                                هیچ درخواست رزروی ثبت نشده است.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- صفحه‌بندی --}}
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    نمایش {{ $reserves->firstItem() ?? 0 }} تا {{ $reserves->lastItem() ?? 0 }} از {{ $reserves->total() }} نتیجه
                </div>
                <div>
                    {{ $reserves->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection