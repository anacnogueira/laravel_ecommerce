<div class="gallery-container">
  <div class="featured-wrapper">
    @php
        $imgPath = count($product->photos) > 0 ? Storage::url($product->photos[0]->photo_ori) : asset("img/no_image.jpg");
    @endphp
    <img id="current-featured" src="{{ $imgPath }}" alt="{{ $product->name }}" onclick="openModal(0)">
    <p class="zoom-hint">Toque para ampliar</p>
  </div>

  <div class="thumb-grid">
    @foreach($product->photos as $key =>$photo)
        <img
            class="item-thumb {{ $key == 0 ? ' active' : '' }}"
            src="{{ Storage::url($photo->photo_redim) }}"
            data-full="{{ Storage::url($photo->photo_ori) }}"
            data-index="{{ $key }}"
            alt="{{ $product->name }}">
    @endforeach
  </div>

  <div id="lbModal" class="lightbox">

    <button class="lb-nav lb-prev">&#10094;</button>
    <div class="lb-content">
        <span class="lb-close">&times;</span>
      <img id="lbImg" src="">
    </div>
    <button class="lb-nav lb-next">&#10095;</button>
  </div>
</div>

