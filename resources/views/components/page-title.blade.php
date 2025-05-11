<div class="pagetitle">
    <h1 class="text-capitalize">{{ $header }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>

            @foreach ($links as $link => $url)
                <li class="breadcrumb-item text-capitalize"><a href="{{ $url }}">{{ $link }}</a></li>
            @endforeach

        </ol>
    </nav>
</div>