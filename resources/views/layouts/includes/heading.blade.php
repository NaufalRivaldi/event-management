<div class="content-heading">
    <div class="heading-left">
        <h1 class="page-title">{{ $title }}</h1>
        <p class="page-subtitle">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
        </p>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach (request()->segments() as $segment)
                <li class="breadcrumb-item">
                    @if ($loop->first)
                        <i class="fa fa-home"></i>
                    @endif
                    {{ ucfirst($segment) }}
                </li>
            @endforeach
        </ol>
    </nav>
</div>