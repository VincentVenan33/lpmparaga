@extends('layouts.template-reader')
@section('reader')
<div class="container pagecontent">
    <div id="home-layoutOne">
    </div>
    <div id="sidebar" class="sidebar-left">
        <aside id="recent-posts-2" class="widget widget_recent_entries">
            <h3 class="widget-title">Recent Posts</h3>
            <ul>
                @foreach($recentPosts as $post)
                    <li>
                        <a href="{{ route('detailreader', $post->id) }}">{{ $post->judul }}</a>
                    </li>
                @endforeach
            </ul>
        </aside>
        <aside id="categories-2" class="widget widget_categories">
            <h3 class="widget-title">Categories</h3>
            <ul>
                <li class="cat-item cat-item-4">
                    <a href="{{ route('category', 'Lastest News') }}">Lastest News</a>
                </li>
                <li class="cat-item cat-item-2">
                    <a href="{{ route('category', 'Sosial Budaya') }}">Sosial Budaya</a>
                </li>
                <li class="cat-item cat-item-5">
                    <a href="{{ route('category', 'Kesehatan') }}">Kesehatan</a>
                </li>
                <li class="cat-item cat-item-3">
                    <a href="{{ route('category', 'Politik') }}">Politik</a>
                </li>
                <li class="cat-item cat-item-7">
                    <a href="{{ route('category', 'Ekonomi') }}">Ekonomi</a>
                </li>
                <li class="cat-item cat-item-1">
                    <a href="{{ route('category', 'Gametech') }}">Gametech</a>
                </li>
                <li class="cat-item cat-item-1">
                    <a href="{{ route('category', 'Olahraga') }}">Olahraga</a>
                </li>
                <li class="cat-item cat-item-1">
                    <a href="{{ route('category', 'Opini') }}">Opini</a>
                </li>
            </ul>
        </aside>
    </div>
    <div id="sitemain" class="site-main ">
        <div class="contentarea">
            <article id="post-74" class="single-post post-74 post type-post status-publish format-standard has-post-thumbnail hentry category-popular-post">
                <header class="entry-header">
                    <h1 class="entry-title">{{ $news->judul }}</h1>
                </header>
                <div class="entry-content">
                    <div class="postmeta">
                        <div class="post-date">{{ date("l, d F Y",$news->created_at) }}</div>
                            <div class="post-comment">
                                 |
                                <a href="{{ route('category', $news->kat_berita) }}">{{ $news->kat_berita }}</a>
                                | {{ $news->id_admin }}
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div id="carouselExampleAutoplaying" class="carousel slide post-thumb" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($news->gambar as $key => $gambar)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="loading-overlay">
                                            <div class="loading-spinner"></div>
                                        </div>
                                        <img src="{{ asset('storage/image/upload/'.$gambar->foto) }}" class="d-block" alt="{{ $gambar->foto }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <p>{!! $news->isi !!}</p>
                        {{-- <div class="clear"></div> --}}
                    </div>
                    <div class="pagination post-navigation">
                            <ul>
                                <li>
                                    @if ($nextPost)
                                        @php
                                            $nextTitle = strlen($nextPost->judul) > 5 ? substr($nextPost->judul, 0, 5) . '...' : $nextPost->judul;
                                        @endphp
                                        <a href="{{ route('detailreader', $nextPost->id) }}" class="morebtn">
                                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>&nbsp;{{ $nextTitle }}
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    @if ($previousPost)
                                        @php
                                            $previousTitle = explode(' ', $previousPost->judul);
                                            $previousTitle = count($previousTitle) > 3 ? implode(' ', array_slice($previousTitle, 0, 3)) . '...' : $previousPost->judul;
                                        @endphp
                                        <a href="{{ route('detailreader', $previousPost->id) }}" class="morebtn">
                                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp;{{ $previousTitle }}
                                        </a>
                                    @endif
                                </li>
                            <ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <div class="clear"></div>
    <link rel="stylesheet" href="{{  url('') }}/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        function showImages() {
            var carouselItems = document.querySelectorAll('.carousel-item');
            carouselItems.forEach(function(item) {
                var image = item.querySelector('img');
                image.style.display = 'block';
            });

            var loadingOverlay = document.querySelectorAll('.loading-overlay');
            loadingOverlay.forEach(function(overlay) {
                setTimeout(function() {
                    overlay.style.display = 'none';
                }, 800);
            });
        }

        window.addEventListener('DOMContentLoaded', showImages);
        window.addEventListener('load', showImages);
    </script>
    <script>
        function resizeImages() {
            var carouselItems = document.querySelectorAll('.carousel-item');
            carouselItems.forEach(function(item) {
                var image = item.querySelector('img');
                var windowWidth = window.innerWidth;
                var maxHeight = (windowWidth <= 768) ? 200 : 400;

                if (image.height > maxHeight) {
                    image.style.height = maxHeight + 'px';
                    image.style.width = 'auto';
                }
            });
        }

        window.addEventListener('DOMContentLoaded', resizeImages);
        window.addEventListener('load', resizeImages);
        window.addEventListener('resize', resizeImages);
    </script>
@endsection
