@if ($comments->count() > 0)
    <hr>
    <a name="show-comments"></a>
    <div class="comments">
        <p><strong>Avaliação dos clientes</strong></p><br>
        @foreach ($comments as $comment)
            <div class="comment-item">
                <span>
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star {{ $i <= $comment->rate ? 'star-selected' : ''}}"></i>
                    @endfor
                </span>
                <strong>{{ $comment->name }}</strong>
                <p>{{ $comment->text }}</p>
            </div>
            <hr>
        @endforeach
    </div>
@endif
