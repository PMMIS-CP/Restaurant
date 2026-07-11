{{-- resources/views/admin/menu-categories/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'ویرایش دسته‌بندی')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">ویرایش: {{ $menuCategory->name_fa }} - {{ $menuCategory->name_en }} - {{ $menuCategory->name_ar }}</h2>
        </div>

        <form action="{{ route('admin.menu-categories.update', $menuCategory) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" id="category-form">
            @csrf
            @method('PUT')

            {{-- فیلدهای نام --}}
            <div>
                <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">نام فارسی *</label>
                <input type="text" name="name_fa" id="name_fa" value="{{ old('name_fa', $menuCategory->name_fa) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_fa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی *</label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $menuCategory->name_en) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_en')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">نام عربی *</label>
                <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $menuCategory->name_ar) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." dir="rtl" required>
                @error('name_ar')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- تصویر فعلی --}}
            @if($menuCategory->image)
            <div id="current-image-section" class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-gray-700 mb-2">تصویر فعلی:</p>
                <img src="{{ $menuCategory->image_url }}" alt="Current" class="w-32 h-32 object-cover rounded-lg border" />
                <label class="inline-flex items-center mt-3 cursor-pointer">
                    <input type="checkbox" name="remove_image" value="1" id="remove-image-check" class="rounded border-gray-300 text-rose-500 focus:ring-rose-500">
                    <span class="mr-2 text-sm text-red-600">حذف تصویر فعلی</span>
                </label>
            </div>
            @endif

            {{-- آپلود تصویر جدید --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">تصویر جدید (اختیاری)</label>
                <p class="text-xs text-gray-500 mb-2">یک تصویر مربعی (۱:۱) با حداکثر ابعاد ۱۰۲۴×۱۰۲۴ و حجم ۲۰MB.</p>

                <input type="file" id="image-input" name="image" accept="image/jpeg,image/png,image/webp,image/gif,image/bmp,image/tiff,image/heic,image/heif"
                       class="hidden" />

                <div class="flex items-center gap-4">
                    <button type="button" id="select-image-btn"
                            class="px-4 py-2 bg-gray-100 border rounded-lg hover:bg-gray-200 transition">
                        انتخاب تصویر جدید
                    </button>
                    <span id="file-name" class="text-sm text-gray-500">هیچ فایلی انتخاب نشده</span>
                </div>
                @error('image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

                {{-- Cropper --}}
                <div id="cropper-container" class="mt-4 hidden">
                    <div class="max-w-md mx-auto">
                        <img id="cropper-image" src="" alt="Preview" class="max-w-full" />
                    </div>
                    <div class="flex justify-center gap-3 mt-4">
                        <button type="button" id="crop-btn" class="px-4 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">تأیید و برش</button>
                        <button type="button" id="cancel-crop-btn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">لغو</button>
                    </div>
                </div>

                {{-- پیش‌نمایش نهایی --}}
                <div id="final-preview" class="mt-4 hidden">
                    <p class="text-sm text-green-600 mb-2">✅ تصویر نهایی (WebP، مربعی، حداکثر ۱۰۲۴×۱۰۲۴)</p>
                    <img id="final-preview-img" src="" alt="Final" class="w-32 h-32 object-cover rounded-lg border" />
                    <button type="button" id="reset-image-btn" class="mt-2 text-sm text-red-600 hover:underline">حذف و انتخاب مجدد</button>
                </div>
            </div>

            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.menu-categories.index') }}" class="px-6 py-2 border ...">انصراف</a>
                <button type="submit" class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">بروزرسانی</button>
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
    const removeCheck = document.getElementById('remove-image-check');
    const currentImageSection = document.getElementById('current-image-section');
    
    let cropper = null;
    let originalFile = null;
    let finalWebpBlob = null;

    // اگر چک باکس حذف تیک خورد، input file را غیرفعال نکنیم، اما می‌توانیم هشدار دهیم
    // بهتر است هنگام تیک، فایل جدید پاک شود
    removeCheck?.addEventListener('change', function() {
        if (this.checked) {
            resetCropper(); // اگر تصویر جدیدی در حال ویرایش بود پاک شود
        }
    });

    selectBtn.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        if (file.size > 20 * 1024 * 1024) { alert('حجم بیش از ۲۰MB'); resetCropper(); return; }
        const valid = ['image/jpeg','image/png','image/webp','image/gif','image/bmp','image/tiff','image/heic','image/heif'];
        if (!valid.includes(file.type)) { alert('فرمت غیرمجاز'); resetCropper(); return; }

        originalFile = file;
        fileNameSpan.textContent = file.name;
        // مخفی کردن بخش تصویر فعلی
        if (currentImageSection) currentImageSection.classList.add('hidden');
        if (removeCheck) removeCheck.checked = false;

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
            background: false,
        });
    });

    cropBtn.addEventListener('click', async () => {
        if (!cropper || !originalFile) return;
        try {
            const cropData = cropper.getData();
            const arrayBuffer = await originalFile.arrayBuffer();
            const image = await window.CrossImage.Image.decode(new Uint8Array(arrayBuffer));
            let cropped = image.crop(
                Math.round(cropData.x), Math.round(cropData.y),
                Math.round(cropData.width), Math.round(cropData.height)
            );
            if (cropped.width > 1024 || cropped.height > 1024) {
                cropped = cropped.resize(1024, 1024);
            }
            const webpData = await cropped.encode('webp', 85);
            finalWebpBlob = new Blob([webpData], { type: 'image/webp' });
            finalPreviewImg.src = URL.createObjectURL(finalWebpBlob);
            finalPreview.classList.remove('hidden');
            cropperContainer.classList.add('hidden');
            const dt = new DataTransfer();
            const newFile = new File([finalWebpBlob], originalFile.name.replace(/\.[^/.]+$/, '.webp'), { type: 'image/webp', lastModified: Date.now() });
            dt.items.add(newFile);
            imageInput.files = dt.files;
            fileNameSpan.textContent = newFile.name;
        } catch (err) {
            console.error(err);
            alert('خطا در پردازش تصویر');
        }
    });

    cancelCropBtn.addEventListener('click', resetCropper);
    resetBtn.addEventListener('click', resetCropper);

    function resetCropper() {
        if (cropper) { cropper.destroy(); cropper = null; }
        cropperContainer.classList.add('hidden');
        finalPreview.classList.add('hidden');
        imageInput.value = '';
        fileNameSpan.textContent = 'هیچ فایلی انتخاب نشده';
        originalFile = null;
        finalWebpBlob = null;
        if (currentImageSection) currentImageSection.classList.remove('hidden');
    }
});
</script>
@endpush