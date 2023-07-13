@extends('layouts.template-reader')
@section('reader')
<div class="container pagecontent">
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
    <div id="sitemain" class="site-main site-contact">
        <div class="contentarea">
            <article id="post-104" class="post-104 page type-page status-publish hentry">
                <header class="entry-header">
                    <h1 class="entry-title">Contact Us</h1>
                </header>
                <div class="entry-content">
                    <div class="main-form-area" id="contactform_main">
                        <form name="contactform" action="{{route('sendmessage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <input class="form-control @error('nama')is-invalid @enderror" type="text" name="nama" value="{{old('judul')}}" placeholder="Nama" />
                                @error("nama")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </p>
                            <p>
                                <input class="form-control @error('email')is-invalid @enderror" type="email" name="email" value="{{old('email')}}" placeholder="Email" />
                                @error("email")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </p>
                            <p>
                                <textarea class="form-control @error('pesan')is-invalid @enderror" name="pesan" placeholder="Pesan"></textarea>
                                @error("pesan")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </p>
                            <p>
                                <button type="submit" name="c_submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Submit</button>
                            </p>
                        </form>
                    </div>
                </div>
            </article>
        </div>
        <div class="contentarea">
            <article id="post-104" class="post-104 page type-page status-publish hentry">
                <header class="entry-header">
                    <h1 class="entry-title">Media Partner</h1>
                </header>
                <div class="entry-content">
                    <div class="main-form-area" id="contactform_main">
                        <div class="social-count">
                            <div class="counter">
                            <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=ukmparaga@unika.ac.id" target="_blank" class="fa fa-envelope fa-2x" title="email"></a>
                            <a href="https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to=ukmparaga@unika.ac.id" target="_blank">
                            <span>Email</span>
                            </a>
                            </div>
                            <div class="counter">
                            <a href="https://www.instagram.com/paraga_unika/" target="_blank" class="fa fa-instagram fa-2x" title="instagram"></a>
                            <a href="https://www.instagram.com/paraga_unika/" target="_blank">
                            <span>Instagram</span>
                            </a>
                            </div>
                            <div class="clear"></div></div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <div class="clear"></div>
</div>
@endsection
