{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
    <style>
.top_nav {
    background-color: #2c3e50;
    color: #fff;
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.nav_menu {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.nav.toggle {
    margin-right: auto; /* Pastikan elemen toggle berada di pojok kiri */
}

.navbar-right {
    display: flex;
    align-items: center;
    margin-left: auto; /* Posisikan item kanan ke kanan */
}

#menu_toggle {
    color: #fff;
    cursor: pointer;
    transition: color 0.3s ease;
}

#menu_toggle:hover {
    color: #3498db;
}

#menu_toggle i {
    transition: transform 0.3s ease-in-out;
}

#menu_toggle:hover i {
    transform: scale(1.1);
}

.user-profile {
    color: #fff;
    cursor: pointer;
    transition: color 0.3s ease;
}

.dropdown-menu {
    border: 1px solid #3498db;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    animation: fadeInDown 0.5s;
    background-color: #2c3e50;
}

.dropdown-item {
    color: #333;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #3498db;
    color: #fff;
    transform: translateY(-3px);
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (min-width: 768px) {
    .nav_menu {
        flex-direction: row; /* Menjadikan item navigasi horizontal */
        align-items: center; /* Pusatkan item navigasi secara vertikal */
        justify-content: flex-start; /* Posisikan item navigasi mulai dari kiri */
    }

    .navbar-right {
        margin-left: auto; /* Posisikan item kanan ke kanan */
    }

    .dropdown-menu {
        position: absolute; /* Jadikan menu dropdown terpisah dari navbar */
        top: 100%; /* Atur posisi menu dropdown tepat di bawah item navigasi */
        left: 0; /* Atur posisi awal menu dropdown */
        min-width: 160px; /* Tentukan lebar minimum menu dropdown */
    }

    .dropdown-item {
        width: auto; /* Atur lebar item dropdown agar sesuai dengan konten */
    }
}


  /* .top_nav {
    background-color: #2c3e50;
    color: #fff;
    padding: 10px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.nav_menu {
    display: flex;
    align-items: center;
    width: 100%;
}

.nav.toggle {
    margin-right: auto;
}

.navbar-right {
    display: flex;
    align-items: center;
    margin-left: auto; 
}

#menu_toggle {
    color: #fff;
    cursor: pointer;
    transition: color 0.3s ease;
}

#menu_toggle:hover {
    color: #3498db;
}

#menu_toggle i {
    transition: transform 0.3s ease-in-out;
}

#menu_toggle:hover i {
    transform: scale(1.1);
}

.user-profile {
    color: #fff;
    cursor: pointer;
    transition: color 0.3s ease;
}

.dropdown-menu {
    border: 1px solid #3498db;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    animation: fadeInDown 0.5s;
    background-color: #2c3e50;
}

.dropdown-item {
    color: #333;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #3498db;
    color: #fff;
    transform: translateY(-3px);
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (min-width: 768px) {
    .nav_menu {
        flex-direction: row;
        align-items: center;
        justify-content: space-between; 
    }

    .navbar-right {
        margin-left: auto;
    }

    .dropdown-menu {
        position: absolute; 
        top: 100%; 
        left: 0;
        min-width: 160px;
    }

    .dropdown-item {
        width: auto; 
    }
}
 */




    </style>
    {{-- <style>
        .top_nav {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .nav_menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        #menu_toggle {
            color: #fff;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        #menu_toggle:hover {
            color: #3498db;
        }

        #menu_toggle i {
            transition: transform 0.3s ease-in-out;
        }

        #menu_toggle:hover i {
            transform: scale(1.1);
        }

        .user-profile {
            color: #fff;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .dropdown-menu {
            border: 1px solid #3498db;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            animation: fadeInDown 0.5s;
            background-color: #2c3e50;
        }

        .dropdown-item {
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #3498db;
            color: #fff;
            transform: translateY(-3px);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 768px) {
    .nav_menu {
        flex-direction: row;
        align-items: center; 
        justify-content: space-between;
    }

    .navbar-right {
        margin-left: auto;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%; 
        left: 0; 
        min-width: 160px;
    }

    .dropdown-item {
        width: auto; 
    }
}


    </style> --}}
    
</head>
<body>
    <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class="navbar-right">
                    <li class="nav-item dropdown open">
                        @php
                            $user = auth()->user();
                            $displayName = $user->hakakses == 'Siswa' || $user->hakakses == 'NonSiswa' ? $user->siswa->NamaLengkap : $user->guru->Nama;
                            $additionalInfo = in_array($user->hakakses, ['Admin', 'Guru', 'KepalaSekolah', 'Kurikulum', 'SU']) ? ($user->guru->TugasMengajar ?? '') : '';
                            $kelas = $user->hakakses == 'Siswa' ? ($user->siswa->kelas->namakelas ?? 'empty') : '';
                            $hakAkses = $user->hakakses;
                        @endphp
    
                        <a href="#" class="user-profile dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <span>{{ $displayName }}</span> 
                            @if ($kelas) | <span>Kelas: {{ $kelas }}</span> @endif
                            <span>{{ $additionalInfo }}</span>
                        </a>
    
                        <div class="dropdown-menu dropdown-usermenu animated fadeInDown" aria-labelledby="navbarDropdown">
                            @unless (request()->is('ekstrakulikulersiswa/list', 'organisasisiswa/list'))
                                <a class="dropdown-item" href="{{ $hakAkses }}Beranda"><i class="fas fa-home" style="margin-right: 5px;"></i> Dashboard</a>
                            @endunless
                            @if ($hakAkses == 'Admin')
                                <a class="dropdown-item" href="/editprofile"><i class="fas fa-male" style="margin-right: 5px;"></i> Edit Profile</a>
                            @else
                                <a class="dropdown-item" href="/editprofile{{ $hakAkses }}"><i class="fas fa-male" style="margin-right: 5px;"></i> Edit Profile</a>
                            @endif
                            @unless (request()->is('ekstrakulikulersiswa/list', 'organisasisiswa/list'))
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Log Out</a>
                            @endunless
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    {{-- <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
                <ul class="navbar-right">
                    <li class="nav-item dropdown open">
                        @php
                            $user = auth()->user();
                            $displayName = $user->hakakses == 'Siswa' || $user->hakakses == 'NonSiswa' ? $user->siswa->NamaLengkap : $user->guru->Nama;
                            $additionalInfo = '';
                            if (in_array($user->hakakses, ['Admin', 'Guru', 'KepalaSekolah', 'Kurikulum', 'SU'])) {
                                $additionalInfo = $user->guru->TugasMengajar ?? '';
                            }
                            $kelas = $user->hakakses == 'Siswa' ? ($user->siswa->kelas->namakelas ?? 'empty') : '';
                        @endphp

                        <a href="#" class="user-profile dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <span>{{ $displayName }}</span> 
                            @if ($kelas) | <span>Kelas: {{ $kelas }}</span> @endif
                            <span>{{ $additionalInfo }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-usermenu animated fadeInDown" aria-labelledby="navbarDropdown">
                            @php
                                $hakAkses = auth()->user()->hakakses;
                            @endphp
                            @unless (request()->is('ekstrakulikulersiswa/list', 'organisasisiswa/list'))
                                <a class="dropdown-item" href="{{ $hakAkses }}Beranda"><i class="fas fa-home" style="margin-right: 5px;"></i> Dashboard</a>
                            @endunless
                            <a class="dropdown-item" href="/editprofile{{ $hakAkses }}"><i class="fas fa-male" style="margin-right: 5px;"></i> Edit Profile</a>
                            @unless (request()->is('ekstrakulikulersiswa/list', 'organisasisiswa/list'))
                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Log Out</a>
                            @endunless
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#menu_toggle").on("click", function(e) {
                e.preventDefault();
                var scrollPosition = $(".nav_menu").offset().top;
                $("html, body").animate({
                        scrollTop: scrollPosition
                    },
                    800
                );
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("#menu_toggle").on("click", function(e) {
                e.preventDefault();
                var scrollPosition = $(".nav_menu").offset().top;
                $("html, body").animate({
                        scrollTop: scrollPosition
                    },
                    800
                );
            });
        });
    </script> --}}
{{-- </body>
</html> --}}

{{-- <style>
    .top_nav {
        background-color: #2c3e50;
        color: #fff;
        padding: 10px;
    }

    .nav_menu {
        padding: 10px;
    }

    .navbar-right {
        margin-right: 0;
        margin-left: auto;
    }

    #menu_toggle {
        color: #fff;
        cursor: pointer;
        position: relative;
        transition: color 0.3s ease, left 0.3s ease;
    }

    #menu_toggle:hover {
        color: #3498db;
    }

    #menu_toggle i {
        transition: transform 0.3s ease-in-out;
    }

    #menu_toggle:hover i {
        transform: scale(1.1);
    }

    .user-profile {
        color: #fff;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .dropdown-menu {
        border: 1px solid #3498db;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        animation: fadeInDown 0.5s;
        background-color: #2c3e50;
    }

    .dropdown-item {
        color: #333;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #3498db;
        color: #fff;
        transform: translateY(-3px);
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open">
                    @php
                        $user = auth()->user();
                        $displayName = '';
                        $additionalInfo = '';
                        $telur = '';

                        if ($user->hakakses == 'Siswa') {
                            $displayName = $user->siswa->NamaLengkap;
                            $telur = isset($user->siswa->kelas->namakelas) ? $user->siswa->kelas->namakelas : 'empty';
                        }
                        if ($user->hakakses == 'NonSiswa') {
                            $displayName = $user->siswa->NamaLengkap;
                        } elseif (in_array($user->hakakses, ['Admin', 'Guru', 'KepalaSekolah', 'Kurikulum', 'SU'])) {
                            $displayName = $user->guru->Nama;
                            $additionalInfo = $user->hakakses != 'Siswa' || $user->hakakses != 'NonSiswa' ? $user->guru->TugasMengajar : '';
                        }
                    @endphp
                    @if (auth()->user()->hakakses == 'Siswa' || auth()->user()->hakakses == 'NonSiswa')
                        <a href="#" class="user-profile dropdown-toggle" id="navbarDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <span>{{ $displayName }}</span> | <span>Kelas :
                                {{ $telur }}</span><span>{{ $additionalInfo }}</span>
                        </a>
                    @endif
                    @if (auth()->user()->hakakses == 'KepalaSekolah' ||
                            auth()->user()->hakakses == 'Admin' ||
                            auth()->user()->hakakses == 'Guru' ||
                            auth()->user()->hakakses == 'Kurikulum' ||
                            auth()->user()->hakakses == 'SU')
                        <a href="#" class="user-profile dropdown-toggle" id="navbarDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> <span>{{ $displayName }}</span> |
                            <span>{{ $additionalInfo }}</span>
                        </a>
                    @endif


                    <div class="dropdown-menu dropdown-usermenu animated fadeInDown" aria-labelledby="navbarDropdown">
                        @php
                            $hakAkses = auth()->user()->hakakses;
                        @endphp
@if (!request()->is('ekstrakulikulersiswa/list','organisasisiswa/list'))
                        <a class="dropdown-item" href="{{ $hakAkses }}Beranda"><i class="fas fa-home"
                                style="margin-right: 5px;"></i> Dashboard</a>
@endif
                        @switch($hakAkses)
                            @case('Siswa')
                            
                                <a class="dropdown-item" href="/editprofilesiswa"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @case('Admin')
                                <a class="dropdown-item" href="/editprofile"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @case('KepalaSekolah')
                                <a class="dropdown-item" href="/editprofileKepalaSekolah"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @case('Guru')
                                <a class="dropdown-item" href="/editprofileGuru"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @case('Kurikulum')
                                <a class="dropdown-item" href="/editprofileKurikulum"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @case('SU')
                                <a class="dropdown-item" href="/editprofileSU"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break
                            @case('NonSiswa')
                                <a class="dropdown-item" href="/editprofileNonSiswa"><i class="fas fa-male"
                                        style="margin-right: 5px;"></i> Edit Profile</a>
                            @break

                            @default
                        @endswitch


                        @if (!request()->is('ekstrakulikulersiswa/list','organisasisiswa/list'))
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Log Out
                        </a>
                    @endif
                    
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $("#menu_toggle").on("click", function(e) {
            e.preventDefault();
            var scrollPosition = $(".nav_menu").offset().top;
            $("html, body").animate({
                    scrollTop: scrollPosition
                },
                800
            );
        });
    });
</script> --}}
