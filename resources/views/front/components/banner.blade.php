@php
    $bannerConfig = [
        'image_url' => '',
        'link_url'  => '',
        'alt_text'  => '',
        'is_active' => true
    ];
@endphp

@if($bannerConfig['is_active'])
    <div class="ad-banner-wrapper">
        <a href="{{ $bannerConfig['link_url'] }}" class="ad-banner-link" target="_blank" rel="noopener">
            <img src="{{ $bannerConfig['image_url'] }}" 
                 alt="{{ $bannerConfig['alt_text'] }}" 
                 class="ad-banner-image">
        </a>
    </div>
@endif

<style>
    .ad-banner-wrapper {
        width: 100%;
        margin: 20px 0;
        overflow: hidden;
        border-radius: 8px;
    }

    .ad-banner-link {
        display: block;
        width: 100%;
    }

    .ad-banner-image {
        width: 100%;
        aspect-ratio: 4 / 1; 
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .ad-banner-image:hover {
        transform: scale(1.02);
    }

    @media (max-width: 640px) {
        .ad-banner-image {
            aspect-ratio: 2 / 1;
        }
    }
</style>