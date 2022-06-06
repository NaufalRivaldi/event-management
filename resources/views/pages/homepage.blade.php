@extends('layouts.master')

@section('title', $title)

@push('css')
    <style>
        .swiper-slide-new {
            background-position: center;
            background-size: cover;
            width: 700px;
        }

        .swiper-slide-new img {
            display: block;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <!-- Slider -->
    <section>
        <div>
            <!-- Slider -->
            <div class="swiper swiper-header">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($images as $image)
                        <div class="swiper-slide">
                            <img src="{{ $image['image'] }}" alt="header" class="img-fluid" width="100%">
                        </div>
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination swiper-pagination-header"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev swiper-button-prev-header"></div>
                <div class="swiper-button-next swiper-button-next-header"></div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section id="sejarah" class="content">
        <div class="container">
            <div class="row content">
                <div class="col-md-12 mt-4 mt-md-0">
                    <div class="tagline">
                        Stt Segara Madu
                    </div>
                    <div class="headline mt-3">
                        Sejarah
                    </div>
                    <div class="subheadline mt-4">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis possimus repellat ullam facere iure labore facilis blanditiis culpa nemo ad eaque esse expedita, et eius nihil maxime aperiam consequuntur commodi?
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="visimisi" class="content">
        <div class="container">
            <div class="row content">
                <div class="col-md-12 mt-4 mt-md-0">
                    <div class="headline mt-3">
                        Visi & Misi
                    </div>
                    <div class="subheadline mt-4">
                        <b>Visi</b><br>
                        Terwujudnya st. Segara madu yang mandiri, bertanggung jawab , dan memiki rasa menyama braya berlandaskan tri hita karana.
                    </div>
                    <div class="subheadline mt-4">
                        <b>Misi</b><br>
                        <ol>
                            <li>Menumbuhkan rasa memiliki / fanatik di dalan anggota sekaa teruna.</li>
                            <li>Pengelolaan sekaa teruna yang bersih dan terpercaya.</li>
                            <li>Meningkatkan seni dan budaya yang ada di lingkungan banjar adat medura.</li>
                            <li>Meningkatkan olahraga untuk menumbuhkan rasa sportivitas.</li>
                            <li>Meningkatkan rasa gotong royong di dalam anggota sekaa teruna</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(function () {
        let swiper = new Swiper('.swiper-header', {
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-header",
                prevEl: ".swiper-button-prev-header",
            },
            pagination: {
                el: ".swiper-pagination-header",
            },
            autoplay: {
                delay: 4000,
            },
        });
    });
</script>
@endpush