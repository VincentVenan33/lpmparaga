@extends('layouts.template-reader')
@section('reader')
<div class="container pagecontent">
    <div id="home-layoutOne">
    </div>
    <div id="sitemain" class="site-main FloatLeft">
        <div class="contentarea">
            <article id="post-90" class="post-90 page type-page status-publish hentry">
                <header class="entry-header">
                    <h1 class="entry-title">Berita terbaru</h1>
                </header>
                <div class="entry-content">
                </div>
            </article>
            <div id="classiclayout">
                @foreach($news as $article)
                    <div class="layoutfull">
                        <div class="thumboxfix">
                            <a href="{{route('detailreader', $article->id)}}" title="{{ $article->judul }}">
                                @if($article->gambar->isNotEmpty())
                                <img src="{{ asset('storage/image/upload/' . $article->gambar->first()->foto) }}" class="attachment-full size-full wp-post-image" alt="{{ $article->gambar->first()->foto }}" decoding="async" loading="lazy" />
                                @endif
                            </a>
                        </div>
                        <h6><a href="{{route('detailreader', $article->id)}}" title="{{ $article->judul }}">{{ $article->judul }}</a></h6>
                        <div class="PostMeta">
                            <span><i class="fa fa-calendar"></i>{{ date("l, d F Y",$article->created_at) }}</span>
                            <span><i class="fa fa-user"></i> {{ $article->id_admin }}</span>
                            <span><i class="fa fa-archive"></i> <a href="">{{ $article->kat_berita }}</a></span>
                        </div>
                        <p>{!! Str::limit(strip_tags($article->isi), 500) !!}</p>
                        <a class="morebtn" href="{{route('detailreader', $article->id)}}" title="{{ $article->judul }}">Read More</a>
                    </div>
                @endforeach
                <div class="pagination">
                    <div>
                        <ul>
                            <li>
                                <span>
                                    {{ $news->currentPage() }} of {{ $news->lastPage() }}
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
        </div>
    </div>
    <div class="clear"></div>
</div>
@endsection
