    <div class="box">
    <div class="blog-show-wrapper">

    <!-- Title -->
    <h1 class="mt-4">{{ $blog->title }}</h1>

    <!-- Author -->
    <p class="lead">
        {{ $blog->subtitle }}
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted On: {{ $blog->created_at->format('F j, Y, g:i a') }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{ asset($blog->image) }}" style="height: 300px; width: 70%" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $blog->content }}</p>

    <hr>


</div>
</div>
