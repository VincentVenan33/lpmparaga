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
    <div id="sitemain" class="site-main site-category">
        <div class="contentarea">
            <header class="page-header">
                <h1 class="page-title">Category: {{ $kat_berita }}</h1>
            </header>
            <div class="categorystyle ">
                <div class="postlayouts">
                    @foreach($news as $post)
                    <article id="post-66" class="post-66 post type-post status-publish format-standard has-post-thumbnail hentry category-latest-news">
                        <header class="entry-header">
                            <h5 class="entry-title"><a href="{{route('detailreader', $post->id)}}" rel="bookmark">{{ $post->judul }}</a></h5>
                            <div class="postmeta">
                                <div class="post-date">{{ date("l, d F Y",$post->created_at) }}</div>
                                <div class="post-categories"> | <a href="{{ route('category', $post->kat_berita) }}" title="View all posts in {{ $post->kat_berita }}">{{ $post->kat_berita }}</a> | {{ $post->id_admin }}</div>
                                <div class="clear"></div>
                            </div>
                            <div class="post-thumb"><a href="{{route('detailreader', $post->id)}}" rel="bookmark">
                                @if($post->gambar->isNotEmpty())
                                    <a href="{{ route('detailreader', $post->id) }}" rel="bookmark">
                                        <img width="300" height="203" src="{{ asset('storage/image/upload/' . $post->gambar->first()->foto) }}" class="alignleft wp-post-image" alt="mount-st-helens" decoding="async" sizes="(max-width: 300px) 100vw, 300px" />
                                    </a>
                                @endif
                            </div>
                        </header>
                        <div class="entry-summary">
                            <p>{!! Str::limit(strip_tags($post->isi), 500) !!}</p>
                            <p><a class="morebtn" href="{{route('detailreader', $post->id)}}">Read More</a></p>
                        </div>
                            <div class="clear"></div>
                        </article>
                    @endforeach
                    <div class="pagination">
                        <div>
                            <ul>
                                <li>
                                    <span>
                                        Page {{ $news->currentPage() }} of {{ $news->lastPage() }}
                                    </span>
                                </li>
                                @foreach(range(1, $news->lastPage()) as $page)
                                    <li>
                                        @if($page == $news->currentPage())
                                            <span aria-current="page" class="page-numbers current">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a class="page-numbers" href="{{ $news->url($page) }}">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                                @if($news->hasMorePages())
                                    <li>
                                        <a class="next page-numbers" href="{{ $news->nextPageUrl() }}">
                                            Next &raquo;
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    <div class="clear"></div>
</div>
@endsection
