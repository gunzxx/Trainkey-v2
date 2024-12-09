@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/main.css">
@endsection

@section('content')
    @session('jwt')
        <input type="hidden" id="jwt-token" value="{{ session('jwt') }}">
        <script>
            const inputToken = document.getElementById('jwt-token').value;
            document.cookie = `jwt=${inputToken}`;
        </script>
    @endsession
    
    <!-- BOX -->
    <div class="box-container">
        <!-- Poin -->
        <div class="score-container itembox3">
            <table class="score">
                <tbody>
                    <tr>
                        <td class="col1">
                            <p>Banyak huruf diketik : </p>
                        </td>
                        <td class="col2">
                            <p id="huruf" name="poinNow" value="">0</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">
                            <p>Benar : </p>
                        </td>
                        <td class="col2">
                            <p id="benar" name="highPoin" value="10">0</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">
                            <p>Salah : </p>
                        </td>
                        <td class="col2">
                            <p id="salah" name="highPoin" value="10">0</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">
                            <p>Poin : </p>
                        </td>
                        <td class="col2">
                            <p id="poin" name="highPoin" value="10">0</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">
                            <p>Poin tertinggi : </p>
                        </td>
                        <td class="col2">
                            <p id="high_poin" name="high_poin" value="10">{{ $user['high_point'] }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End Poin -->

        <!-- Game container -->
        <div id="gamecontainer" class="game-container itembox2">


            <!-- Sample Teks -->
            <div class="teksLabel" id="sampleTeksContainer">
                <p class="kata kata0"></p><span>&nbsp;</span>
                <p class="kata kata1"></p><span>&nbsp;</span>
                <p class="kata kata2"></p><span>&nbsp;</span>
                <p class="kata kata3">Masih loading harap sabar....</p><span>&nbsp;</span>
                <p class="kata kata4"></p><span>&nbsp;</span>
                <p class="kata kata5"></p><span>&nbsp;</span>
                <p class="kata kata6"></p><span>&nbsp;</span>
                <p class="kata kata7"></p><span>&nbsp;</span>
                <p class="kata kata8"></p><span>&nbsp;</span>
                <p class="kata kata9"></p>
            </div>
            <!-- End Sample Teks -->


            <!-- User Input -->
            <input id="userInput" autocomplete="off" placeholder="Tunggu ya :>" disabled="">
            <!-- End User Input -->


            <!-- Timer -->
            <div class="timer" id="countdown-container">
                <p class="timerTeks text-center" id="countdown">60</p>
                <button id="restart">Restart</button>
            </div>
            <!-- End Timer -->

        </div>
        <!-- End Game contain -->


        <!-- Rank -->
        <div class="itembox1">
            <div class="rank-container">
                <h3 class="text-center">Leaderboard</h3>
                <input type="text" id="search" class="search" placeholder="Cari user">
                <table class="rank" id="rank">
                    <thead>
                        <td>No.</td>
                        <td style="text-align: left;">User</td>
                        <td>Poin</td>
                        <td>Banyak Huruf</td>
                    </thead>
                    <tbody id="rank_body" class="rank-body">
                        @foreach ($users as $k => $v)
                            @if ($v['id'] == $user['id'])
                                <tr style="background-color:green;">
                                    <td class="no">
                                        <p>{{ $k + 1 }}</p>
                                    </td>
                                    <td class="name-colomn">
                                        <img src="{{ $v->getFirstMediaUrl('profile') == '' ? '/img/profile/default.png' : $v->getFirstMediaUrl('profile') }}"
                                            alt="">
                                        <p>{{ $v['name'] }}</p>
                                    </td>
                                    <td class="point-colomn">
                                        <p>{{ $v['high_point'] }}</p>
                                    </td>
                                    <td class="word-colomn">
                                        <p>{{ $v['count_word'] }}</p>
                                    </td>
                                </tr>
                            @endif
                            @if ($v['id'] != $user['id'])
                                <tr>
                                    <td class="no">
                                        <p>{{ $k + 1 }}</p>
                                    </td>
                                    <td class="name-colomn">
                                        <img src="{{ $v->getFirstMediaUrl('profile') == '' ? '/img/profile/default.png' : $v->getFirstMediaUrl('profile') }}"
                                            alt="">
                                        <p>{{ $v['name'] }}</p>
                                    </td>
                                    <td class="point-colomn">
                                        <p>{{ $v['high_point'] }}</p>
                                    </td>
                                    <td class="word-colomn">
                                        <p>{{ $v['count_word'] }}</p>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <p class="showall" id="showall">Show all</p>
            </div>
        </div>
        <!-- End Rank -->

    </div>
    <!-- End BOX -->
@endsection

@section('js')
    <script src="js/function.js"></script>
    <script src="js/main.js"></script>
@endsection
