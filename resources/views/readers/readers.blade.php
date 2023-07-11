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
                <a href="https://sktthemesdemo.net/newspaper/feugiat-semper-justo/" title="Feugiat semper justo">
                    @if($article->gambar->isNotEmpty())
            <img width="1280" height="854" src="{{ asset('storage/image/upload/' . $article->gambar->first()->foto) }}" class="attachment-full size-full wp-post-image" alt="" decoding="async" loading="lazy" />
        @endif
                </a>
            </div>
            <h6><a href="https://sktthemesdemo.net/newspaper/feugiat-semper-justo/" title="Feugiat semper justo">{{ $article->judul }}</a></h6>
            <div class="PostMeta">
                <span><i class="fa fa-calendar"></i>{{ date("l, d F Y",$article->created_at) }}</span>
                <span><i class="fa fa-user"></i> {{ $article->id_admin }}</span>
                <span><i class="fa fa-archive"></i> <a href="https://sktthemesdemo.net/newspaper/feugiat-semper-justo/#comments">{{ $article->kat_berita }}</a></span>
            </div>
            <p>{!! $article->isi !!}</p>
            <a class="morebtn" href="https://sktthemesdemo.net/newspaper/feugiat-semper-justo/" title="Feugiat semper justo">Read More</a>
        </div>
    @endforeach
<div class="pagination"><div><ul><li><span>1 of 2</span></li><li><span aria-current="page" class="page-numbers current">1</span></li><li><a class="page-numbers" href="https://sktthemesdemo.net/newspaper/home-layout-classic/page/2/">2</a></li><li><a class="next page-numbers" href="https://sktthemesdemo.net/newspaper/home-layout-classic/page/2/">Next &raquo;</a></li></ul></div></div> </div>
</div>
</div>
<div id="sidebar" class="sidebar-right">
<aside class="widget Social_Count_Widget">
<h3 class="widget-title">Follow Us</h3>
<div class="social-count">
<div class="counter">
<a href="#" target="_blank" class="fa fa-facebook fa-2x" title="facebook"></a>
<a href="#" target="_blank">
<span class="bold">100</span>
<span>Fan</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-twitter fa-2x" title="twitter"></a>
<a href="#" target="_blank">
<span class="bold">50</span>
<span>Followers</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-linkedin fa-2x" title="linkedin"></a>
<a href="#" target="_blank">
<span class="bold">250</span>
<span>Subcriber</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-rss fa-2x" title="rss"></a>
<a href="#" target="_blank">
<span class="bold">100</span>
<span>Fan</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-google-plus fa-2x" title="google-plus"></a>
<a href="#" target="_blank">
<span class="bold">50</span>
<span>Followers</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-instagram fa-2x" title="instagram"></a>
<a href="#" target="_blank">
<span class="bold">250</span>
<span>Subcriber</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-flickr fa-2x" title="flickr"></a>
<a href="#" target="_blank">
<span class="bold">100</span>
<span>Fan</span>
</a>
</div>
<div class="counter">
<a href="#" target="_blank" class="fa fa-youtube fa-2x" title="youtube"></a>
<a href="#" target="_blank">
<span class="bold">50</span>
<span>Followers</span>
</a>
</div>
<div class="clear"></div></div> </aside>
<aside id="addspace" class="widget">
<a href="#"><img alt src="https://sktthemesdemo.net/newspaper/wp-content/themes/skt-newspaper/images/add-250-by-250.jpg"></a>
</aside>
<aside id="about" class="widget">
<h3 class="widget-title">About Octagon</h3>
<img alt src="https://sktthemesdemo.net/newspaper/wp-content/themes/skt-newspaper/images/about-thumb.jpg">
<p>Fusce vulputate sollicitu rutrum quam purus ligulay scelerisque orci vestibulum quis. Aliquam erat volutpat. Sdisse enim lacus, ultrices et leo eget, sollicitu rutrum quam. Quisque eu magna libero sollicitu rutrum scelerisque quam.</p>
</aside>
</div>
<div class="clear"></div>
</div>
@endsection
