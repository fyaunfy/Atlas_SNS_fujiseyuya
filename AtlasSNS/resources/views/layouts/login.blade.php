<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1><a href="{{ asset('/top')}}"><img src="{{ asset('storage/atlas.png')}}" class="head-images"></a></h1>
            <div id="headAccordion">
                <a href="" class="atlas-accordion is-active">
                    <!-- ログイン後に名前を表示する書き方 -->
                    <p class="head-name"><?php $user = Auth::user(); ?>{{ $user->username }}  さん  </p>
                    <!-- Authでログインしているユーザーの画像を表示　＆　ここを変数にするとページごとで値が変わっているのでauthにする -->
                    <img class="logo" src="{{ \Storage::url(Auth::user()->images) }}">            
                </a>
            </div>

        </div>
    </header>

    <ul class="atlas-accordion-ul">
        <li class="atlas-accordion-li"><a href="{{ asset('/top')}}">HOME</a></li>
        <li class="atlas-accordion-middle"><a href="{{ asset('/profile')}}">プロフィール編集</a></li>
        <li class="atlas-accordion-li"><a href="{{ asset('/logout')}}">ログアウト</a></li>
    </ul>
    
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                
                <p><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>

                <div class="side-follow-list">
                    <p>フォロー数</p>
                    <p>{{Auth::user()->follows()->count()}}人</p>
                </div>

                <p class="list-btn"><a href="{{ asset('/follow-list')}}">フォローリスト</a></p>

                <div class="side-follow-list">
                    <p>フォロワー数</p>
                    <p>{{Auth::user()->followers()->count()}}人</p>
                </div>

                <p class="list-btn"><a href="{{ asset('/follower-list')}}">フォロワーリスト</a></p>

            </div>

            <div class="side-search"><a href="{{ asset('/search')}}">ユーザー検索</a></div>
        </div>
    </div>
    <footer>
    </footer>
 
    <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
</body>
</html>


