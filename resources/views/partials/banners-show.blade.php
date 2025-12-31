@if ($banners->count() > 0)
    <div id="banners">
        <div class="slideshow-container">
            @for($i =0; $i < $banners->count(); $i++)
                @php
                    $link = $banners[$i]['url'];
                    $content = !empty($banners[$i]['html']) ?: "<a href='${link}'><img src='". Storage::url($banners[$i]["image"]) ."' style='width:100%'></a>";
                @endphp
                <div class="banner-slide fade">
                    <div class="numbertext">{{ $i+1 }} / {{ $banners->count() }}</div>
                    {!! $content !!}
                </div>
            @endfor
            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <!-- The dots/circles -->
        <div style="text-align:center">
            @for($i =1; $i <= $banners->count(); $i++)
                <span class="dot" onclick="currentSlide({{ $i }})"></span>
            @endfor
        </div>
    </div>
    @push('scripts')
        <script  type="text/javascript" src="{{ asset('js/utils/banners-show.js') }}"></script>
    @endpush
@endif
