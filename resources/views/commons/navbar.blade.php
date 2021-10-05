<header class="mb-1">
    
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <div class="container">
        <a class="navbar-brand" href="/">スケジュールボード</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            
                <ul class="navbar-nav">
                    
                {{--管理者の場合メンバーと案件にアクセス可能--}}
                  @if(Auth::check() && Auth::user()->admin_flag == true )
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('users.index', 'メンバー', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('projects.index', '案件', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('schedules.month', '予定', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('holidays.index', '休日', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('clients.index', '顧客', [], ['class' => 'nav-link']) !!}</li>
        
                     {{-- ログアウトへのリンク --}}
                　　<li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                </ul>
                    </li>
                　@elseif(Auth::check() && Auth::user()->admin_flag == false )
                
                　　<li class="nav-item">{!! link_to_route('projects.index', '案件', [], ['class' => 'nav-link']) !!}</li>
               　　  <li class="nav-item">{!! link_to_route('schedules.index', '予定', [], ['class' => 'nav-link']) !!}</li>
                
                   {{-- ログアウトへのリンク --}}
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
               　　 @else
                   {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login.post', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                　 @endif
            </ul>
        </div>
    </nav>
   </div> 
</header>