<!-- Banner Carousel -->
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($banners as $index => $banner)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}"
                    class="{{ $index === 0 ? 'active' : '' }}"
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $index + 1 }}">
            </button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ $banner->title_ar }}" style="height: 800px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <div class="bg-dark bg-opacity-50 p-4 rounded">
                        <h2 class="display-4 fw-bold text-white">{{ $banner->title_ar }}</h2>
                        <p class="lead text-white">{{ $banner->description_ar }}</p>
                        @if($banner->button_text && $banner->button_link)
                            <a href="{{ $banner->button_link }}" class="btn btn-success btn-lg mt-3">
                                {{ $banner->button_text }}
                                <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($banners) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">السابق</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">التالي</span>
        </button>
    @endif
</div>
