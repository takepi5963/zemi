<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
        <!-- views CSS -->
       	<link rel="stylesheet" type="text/css" href="css/layouts.blade.css">
        <link rel="stylesheet" type="text/css" href="../css/layouts.blade.css">
        <link rel="stylesheet" type="text/css" href="css/club.blade.css">

        <title>体育館管理</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    {{session()->get('Authority')}}
                    @if(session()->get('Authority')!='user')
                    @if (session()->get('Authority')=='club_leader')
                    <li class="nav-item">
                        <a class="nav-link" href="/request">希望申し込み</a>
                    </li>
                    @elseif(session()->get('Authority')=='admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/time_table">時間割調整</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/club">サークル管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">管理者情報更新</a>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </nav>
    <main> 
        <h1>@yield('title')</h1>
        @yield('main')
    </main>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
