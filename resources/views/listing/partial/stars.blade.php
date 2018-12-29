
    @for (; $rating > 1.0; $rating -= 1.0)
        <i class="fas fa-star"></i>
    @endfor ($rating % 1.0)

    @for (; $rating > 0.5; $rating -= 0.5)
        <i class="fas fa-star-half"></i>
    @endfor ($rating % 1.0)