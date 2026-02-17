<select class="star-rating" name="rated" disabled>
    @foreach ($stars as $key => $value)
        <option value="{{ $key }}" {{ $averageRate == $key ? "selected" : ""}}>{{ $value }}</option>
    @endforeach
</select>

