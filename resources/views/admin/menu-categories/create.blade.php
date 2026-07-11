{{-- resources/views/admin/menu-categories/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'ایجاد دسته‌بندی جدید')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">ایجاد دسته‌بندی جدید</h2>
                <a href="{{ route('admin.menu-categories.index') }}" 
                   class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.menu-categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" id="category-form">
            @csrf

            {{-- فیلدهای نام (فارسی، انگلیسی، عربی) --}}
            <div>
                <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">نام فارسی *</label>
                <input type="text" name="name_fa" id="name_fa" value="{{ old('name_fa') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_fa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی *</label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_en')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">نام عربی *</label>
                <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." dir="rtl" required>
                @error('name_ar')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- آپلود تصویر --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">تصویر دسته‌بندی</label>
                <p class="text-xs text-gray-500 mb-2">
                    یک تصویر مربعی (۱:۱) با حداکثر ابعاد ۱۰۲۴×۱۰۲۴ و حجم ۲۰ مگابایت. 
                    فرمت‌های مجاز: JPEG, PNG, WebP, GIF, BMP, TIFF, HEIC, HEIF
                </p>

                <input type="file" id="image-input" name="image" accept="image/jpeg,image/png,image/webp,image/gif,image/bmp,image/tiff,image/heic,image/heif"
                       class="hidden" />

                <div class="flex items-center gap-4">
                    <button type="button" id="select-image-btn"
                            class="px-4 py-2 bg-gray-100 border rounded-lg hover:bg-gray-200 transition">
                        انتخاب تصویر
                    </button>
                    <span id="file-name" class="text-sm text-gray-500">هیچ فایلی انتخاب نشده</span>
                </div>
                @error('image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

                {{-- کراپر --}}
                <div id="cropper-container" class="mt-4 hidden">
                    <div class="max-w-md mx-auto">
                        <img id="cropper-image" src="" alt="Preview" class="max-w-full" />
                    </div>
                    <div class="flex justify-center gap-3 mt-4">
                        <button type="button" id="crop-btn"
                                class="px-4 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">
                            تأیید و برش
                        </button>
                        <button type="button" id="cancel-crop-btn"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            لغو
                        </button>
                    </div>
                </div>

                {{-- پیش‌نمایش نهایی --}}
                <div id="final-preview" class="mt-4 hidden">
                    <p class="text-sm text-green-600 mb-2">✅ تصویر نهایی (WebP، مربعی، حداکثر ۱۰۲۴×۱۰۲۴)</p>
                    <img id="final-preview-img" src="" alt="Final" class="w-32 h-32 object-cover rounded-lg border" />
                    <button type="button" id="reset-image-btn"
                            class="mt-2 text-sm text-red-600 hover:underline">حذف و انتخاب مجدد</button>
                </div>
            </div>

            {{-- دکمه‌های ثبت --}}
            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.menu-categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    انصراف
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">
                    ذخیره دسته‌بندی
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image-input');
    const selectBtn = document.getElementById('select-image-btn');
    const fileNameSpan = document.getElementById('file-name');
    const cropperContainer = document.getElementById('cropper-container');
    const cropperImage = document.getElementById('cropper-image');
    const cropBtn = document.getElementById('crop-btn');
    const cancelCropBtn = document.getElementById('cancel-crop-btn');
    const finalPreview = document.getElementById('final-preview');
    const finalPreviewImg = document.getElementById('final-preview-img');
    const resetBtn = document.getElementById('reset-image-btn');
    
    let cropper = null;
    let originalFile = null;      // فایل اصلی انتخاب شده
    let finalWebpBlob = null;     // خروجی WebP نهایی

    // دکمه انتخاب فایل
    selectBtn.addEventListener('click', () => imageInput.click());

    // مدیریت انتخاب فایل
    imageInput.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // اعتبارسنجی اولیه حجم و فرمت
        const maxSize = 20 * 1024 * 1024; // 20MB
        const allowedTypes = ['image/jpeg','image/png','image/webp','image/gif','image/bmp','image/tiff','image/heic','image/heif'];
        if (file.size > maxSize) {
            alert('حجم فایل نباید بیشتر از ۲۰ مگابایت باشد.');
            resetCropper();
            return;
        }
        if (!allowedTypes.includes(file.type)) {
            alert('فرمت فایل پشتیبانی نمی‌شود.');
            resetCropper();
            return;
        }

        originalFile = file;
        fileNameSpan.textContent = file.name;

        // نمایش cropper
        const url = URL.createObjectURL(file);
        cropperImage.src = url;
        cropperContainer.classList.remove('hidden');
        finalPreview.classList.add('hidden');

        if (cropper) cropper.destroy();
        cropper = new Cropper(cropperImage, {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 1,
            movable: true,
            zoomable: true,
            rotatable: false,
            scalable: true,
            background: false,
            ready() {
                // اختیاری
            }
        });
    });

    // دکمه crop
    cropBtn.addEventListener('click', async () => {
        if (!cropper || !originalFile) return;

        try {
            const cropData = cropper.getData();
            
            // خواندن فایل اصلی و crop با cross-image
            const arrayBuffer = await originalFile.arrayBuffer();
            const image = await window.CrossImage.Image.decode(new Uint8Array(arrayBuffer));
            
            // برش
            let cropped = image.crop(
                Math.round(cropData.x),
                Math.round(cropData.y),
                Math.round(cropData.width),
                Math.round(cropData.height)
            );

            // در صورت بزرگتر بودن از 1024، resize به 1024x1024
            if (cropped.width > 1024 || cropped.height > 1024) {
                cropped = cropped.resize(1024, 1024);
            }

            // تبدیل به WebP
            const webpData = await cropped.encode('webp', 85);
            finalWebpBlob = new Blob([webpData], { type: 'image/webp' });

            // نمایش پیش‌نمایش نهایی
            finalPreviewImg.src = URL.createObjectURL(finalWebpBlob);
            finalPreview.classList.remove('hidden');
            cropperContainer.classList.add('hidden');
            
            // به‌روزرسانی input file با فایل WebP جدید
            const dt = new DataTransfer();
            const newFile = new File([finalWebpBlob], originalFile.name.replace(/\.[^/.]+$/, '.webp'), {
                type: 'image/webp',
                lastModified: Date.now()
            });
            dt.items.add(newFile);
            imageInput.files = dt.files;
            fileNameSpan.textContent = newFile.name;
        } catch (err) {
            console.error('خطا در پردازش تصویر:', err);
            alert('خطا در برش/تبدیل تصویر. لطفاً دوباره تلاش کنید.');
        }
    });

    // لغو کراپر
    cancelCropBtn.addEventListener('click', resetCropper);

    // حذف تصویر نهایی
    resetBtn.addEventListener('click', resetCropper);

    function resetCropper() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        cropperContainer.classList.add('hidden');
        finalPreview.classList.add('hidden');
        imageInput.value = '';
        fileNameSpan.textContent = 'هیچ فایلی انتخاب نشده';
        originalFile = null;
        finalWebpBlob = null;
    }
});
</script>
@endpush