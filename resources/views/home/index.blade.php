@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="/css/main.css">
@endsection

@section('content')
    <!-- Navbar -->
    <nav class="nav">
        <a href="" class="brand">
            <img src="img/logo.png" alt="" width="70px">
            <h1>Train Key</h1>
        </a>
        <div class="sub-nav">
            <a class="nav-list" href="forum" target="_blank">
                <p>Forum</p>
            </a>
            <a class="nav-list">
                <p>Help & Support</p>
            </a>
            <a class="nav-list">
                <p>Documentation</p>
            </a>
        </div>
        <div class="profile-container">
            <img src="img/pfp/pfp{{ $user['profile'] }}.png" alt="" class="profile" id="profile">
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="profile-menu" id="profile-menu">
        <a class="menu" href="editprofil">Edit profile</a>
        <a class="menu" id="logoutbtn">Logout</a>
    </div>

    <!-- BOX -->
    <div class="box-container">
        <!-- Poin -->
        <div class="score-container itembox3">
            <table class="score">
                <tbody>
                    <tr>
                        <td class="col1"><p>Banyak huruf diketik : </p></td>
                        <td class="col2"><p id="huruf" name="poinNow" value="">0</p></td>
                    </tr>
                    <tr>
                        <td class="col1"><p>Benar : </p></td>
                        <td class="col2"><p id="benar" name="highPoin" value="10">0</p></td>
                    </tr>
                    <tr>
                        <td class="col1"><p>Salah : </p></td>
                        <td class="col2"><p id="salah" name="highPoin" value="10">0</p></td>
                    </tr>
                    <tr>
                        <td class="col1"><p>Poin : </p></td>
                        <td class="col2"><p id="poin" name="highPoin" value="10">0</p></td>
                    </tr>
                    <tr>
                        <td class="col1"><p>Poin tertinggi : </p></td>
                        <td class="col2"><p id="high_poin" name="high_poin" value="10">{{ $user['high_poin'] }}</p></td>
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
                        <td colspan="2" style="text-align: center;">Nama</td>
                        <td>Poin</td>
                        <!-- <td>Tanggal</td> -->
                    </thead>
                    <tbody id="rank_body" class="rank-body">
                        <?php foreach($users as $k => $v) {?>
                            <?php if($v['user_id'] == $user['id']){ ?>
                                <tr style="background-color:green;">
                                    <td class="no">{{ $k+1 }}</td>
                                    <td><img width="20px" height="20px" src="img/pfp/pfp{{ $v['profile'] }}.png" alt=""></td>
                                    <td class="img">{{ $v['name'] }}</td>
                                    <td class="data">{{ $v['high_poin'] }}</td>
                                    <!-- <td class="data" style="font-size:12px;">{{ $v['tanggal'] }}</td> -->
                                </tr>
                            <?php } ?>
                            <?php if($v['user_id'] != $user['id']){ ?>
                                <tr>
                                    <td class="no">{{ $k+1 }}</td>
                                    <td><img width="20px" height="20px" src="img/pfp/pfp{{ $v['profile']}}.png" alt=""></td>
                                    <td class="img">{{ $v['name'] }}</td>
                                    <td class="data">{{ $v['high_poin'] }}</td>
                                    <!-- <td class="data" style="font-size:12px;">{{ $v['tanggal'] }}</td> -->
                                </tr>
                            <?php } ?>
                        <?php } ?>
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
    <script src="js/data.js"></script>
    <script src="js/main.js"></script>    
@endsection