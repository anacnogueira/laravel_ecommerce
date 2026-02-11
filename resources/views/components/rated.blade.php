<select class="star-rating" disabled>
    @foreach ($stars as $key => $value)
        <option value="{{ $key }}" {{ $averageRate == $key ? "selected" : ""}}>{{ $value }}</option>
    @endforeach
</select>

