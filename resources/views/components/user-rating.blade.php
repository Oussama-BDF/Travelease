@props(['rating'])
<span class="user-rating">
    @for ($i = 0; $i < $rating; $i++)
        <i class="fas fa-star"></i>
    @endfor
    @for ($j = $i; $j < 5; $j++)
        <i class="far fa-star"></i>
    @endfor
    {{$rating}}.0
</span>