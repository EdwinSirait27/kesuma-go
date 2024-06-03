<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'SU')
                <a href="AdminBeranda" class="site_title">
                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    <span>Kesuma-Go</span>
                </a>
            @endif
            @if (auth()->user()->hakakses == 'KepalaSekolah')
                <a href="KepalaSekolahBeranda" class="site_title">
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <span>Kesuma-Go</span>
                </a>
            @endif
            @if (auth()->user()->hakakses == 'Kurikulum')
                <a href="KurikulumBeranda" class="site_title">
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <span>Kesuma-Go</span>
                </a>
            @endif
            @if (auth()->user()->hakakses == 'Guru')
                <a href="GuruBeranda" class="site_title">
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <span>Kesuma-Go</span>
                </a>
            @endif
            @if (auth()->user()->hakakses == 'Siswa')
                <a href="SiswaBeranda" class="site_title">
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <span>Kesuma-Go</span>
                </a>
            @endif
            @if (auth()->user()->hakakses == 'NonSiswa')
                <a href="SiswaBeranda" class="site_title">
                    <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">

                    {{-- <img style="margin-right: 10px;" src="../../images/Shield_Logos__SMAK_KESUMA (1).png"> --}}
                    <span>Kesuma-Go</span>
                </a>
            @endif
        </div>
        <br />
        <style>
            .site_title {
                display: flex;
                align-items: center;
                background-color: #085696;
            }

            .profile_info {
                margin-bottom: 30px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                justify-content: center;
                height: 80px;
            }

            .profile_info h2 span {
                margin-bottom: 5px;
                color: yellowgreen;
                font-size: 12px;
                font-weight: bold;
            }

            .profile_info h3 span {
                margin-bottom: 5px;
                color: white;
                font-size: 16px;
            }

            .profile_info h3 {
                margin-bottom: 10px;
                color: white;
                font-size: 18px;
            }

            .profile_info h3:first-child {
                margin-top: 10px;
            }

            .profile_info h3:nth-child(2) {
                justify-content: flex-start;
            }

            .img-circle {
                border-radius: 10%;
            }

            h3 {
                font-family: 'Helvetica Neue', sans-serif;

                text-align: left;

                padding-bottom: 10px;
                margin-bottom: 20px;
            }
        </style>
        @if (auth()->user()->hakakses == 'Admin' ||
                auth()->user()->hakakses == 'KepalaSekolah' ||
                auth()->user()->hakakses == 'Kurikulum' ||
                auth()->user()->hakakses == 'Guru' ||
                auth()->user()->hakakses == 'SU')
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="{{ asset('storage/fotoguru/' . auth()->user()->guru->foto) }}" alt="Foto Profil"
                        class="img-circle profile_img">
                       
                    {{-- <img src="{{ asset('storage/images/' . auth()->user()->guru->foto) }}" alt="Foto Profil"
                        class="img-circle profile_img"> --}}
                </div>
                
                <div class="profile_info">
                    <hr>
                    <span style="margin-top: 10px;">Selamat Datang,</span>
                    <h2>{{ auth()->user()->guru->Nama }}</h2>
                    <h2>Username :{{ auth()->user()->username }}</h2>
                    <h2><span>Hak Akses : {{ auth()->user()->hakakses }}</span></h2>
                </div>
            </div>
            <br>
            <hr>
        @endif
        @if (auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'NonSiswa')
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="{{ asset('storage/fotosiswa/' . auth()->user()->siswa->foto) }}" alt="Foto Profil"
                        class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <hr>
                    <span style="margin-top: 10px;">Selamat Datang,</span>
                    <h2>{{ auth()->user()->siswa->NamaLengkap }}</h2>
                    
                    <h2>Username: {{ auth()->user()->username }}</h2>
                    <h2><span>Hak Akses: {{ auth()->user()->hakakses }}</span></h2>
                    <br>
                </div>
            </div>
            <hr>
        @endif
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    @if (auth()->user()->hakakses == 'SU')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofileSU">Edit Profile</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    @if (auth()->user()->hakakses == 'NonSiswa')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofileNonSiswa">Edit Profile</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif

                    @if (auth()->user()->hakakses == 'Admin')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofile">Edit Profile</a></li>
                            </ul>
                        </li>
                        {{-- </li> --}}
                    @endif
                    @if (auth()->user()->hakakses == 'Siswa')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofilesiswa">Edit Profile</a></li>
                                <li><a href="/editdatasiswa">Edit Data</a></li>
                                <li><a href="/ekstrakulikulersiswa">Ekstrakulikuler Anda</a></li>
                                <li><a href="/organisasisiswa">Organisasi Anda</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Guru')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofileGuru">Edit Profile</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Kurikulum')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofileKurikulum">Edit Profile</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    @if (auth()->user()->hakakses == 'KepalaSekolah')
                        <li><a><i class="fa fa-male"></i> Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/editprofileKepalaSekolah">Edit Profile</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    
                    @if (auth()->user()->hakakses == 'SU')
                        <li><a href="SUBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin')
                        <li><a href="AdminBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'Siswa')
                        <li><a href="/SiswaBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'NonSiswa')
                        <li><a href="/NonSiswaBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'Guru')
                        <li><a href="GuruBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'Kurikulum')
                        <li><a href="KurikulumBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'KepalaSekolah')
                        <li><a href="KepalaSekolahBeranda"><i class="fa fa-home"></i> Beranda <span>
                    @endif
                    @if (auth()->user()->hakakses == 'KepalaSekolah')
                        <li><a href="kepsek"><i class="fa fa-cubes"></i> Data Kepala Sekolah <span>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
                        <span class="label label-success pull-right"> <span></a>
                                <li><a><i class="fa fa-tachometer"></i> Data Master <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/kurikulum">Data Kurikulum</a></li>
                                        <li><a href="/tahunakademik">Data Tahun Akademik</a></li>
                                        <li><a href="/mata">Data Mata Pelajaran</a></li>
                                        <li><a href="/kelas">Data Kelas </a></li>
                                        <li><a href="/ekstra">Data Ekstrakulikuler </a></li>
                                        <li><a href="/organisasi">Data Organisasi </a></li>
                                        {{-- <li><a href="/buttonppdb">Button Tanggal </a></li>
                                        <li><a href="/buttonosis">Button Osis </a></li>
                                        <li><a href="/editdata">Button Edit Data </a></li>
                                        <li><a href="/buttonnilaisiswa">Button Nilai Siswa </a></li>
                                      --}}
                                       
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bell"></i> Button <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                       
                                        <li><a href="/buttonppdb">Button Tanggal </a></li>
                                        <li><a href="/buttonosis">Button Osis </a></li>
                                        <li><a href="/editdata">Button Edit Data </a></li>
                                        <li><a href="/buttonnilaisiswa">Button Nilai Siswa </a></li>
                                        <li><a href="/buttoninputnilaiguru">Button Nilai Kurikulum </a></li>
                                        <li><a href="/buttoninputnilaikurikulum">Button Nilai Guru </a></li>
                                     
                                       
                                    </ul>
                                </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
                    <li><a><i class="fa fa-calculator"></i> Osis <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/osis">Penambahan</a></li>
                            <li><a href="/pemilihan">Pemilihan Ketua Osis</a></li>
                            
                        </ul>
                    </li>
                    </li>
                @endif
                  
                    @if (auth()->user()->hakakses == 'Kurikulum')
                        <span class="label label-success pull-right"> <span></a>
                                <li><a><i class="fa fa-tachometer"></i> Data Master <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/mata">Data Mata Pelajaran</a></li>
                                    </ul>
                                </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a><i class="fa fa-calculator"></i> Osis <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            {{-- <li><a href="/osis">Penambahan</a></li> --}}
                            <li><a href="/pemilihan">Pemilihan Ketua Osis</a></li>
                            
                        </ul>
                    </li>
                    </li>
                @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a href="/guruall"><i class="fa fa-university"></i> Daftar Guru <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
                    <li><a href="/ppdb"><i class="fa fa-university"></i> Data PPDB <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a href="/siswaall"><i class="fa fa-group"></i> Daftar Siswa <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Siswa')
                    <li><a href="/listsiswa"><i class="fa fa-university"></i> Kelas Siswa<span
                        class="label label-success pull-right"> <span></a>
            </li>
            @endif
                    @if (auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a href="/listsiswaadmin"><i class="fa fa-university"></i> Kelas <span
                        class="label label-success pull-right"> <span></a>
            </li>
            @endif
                    
                    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
                    <li><a href="/listsiswaadmin"><i class="fa fa-university"></i> Kelas <span
                        class="label label-success pull-right"> <span></a>
            </li>
            @endif
            @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Siswa')
                    <li><a href="/ekstrakulikuler"><i class="fa fa-cubes"></i> Ekstrakulikuler <span
                        class="label label-success pull-right"> <span></a>
            </li>
            @endif
            @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Siswa')
            <li><a href="/organisasisiswaall"><i class="fa fa-cubes"></i> Organisasi Siswa <span
                class="label label-success pull-right"> <span></a>
    </li>
    @endif
    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
            <li><a href="/datamengajar"><i class="fa fa-cubes"></i> Menu Mengajar <span
                class="label label-success pull-right"> <span></a>
    </li>
    @endif
    @if (auth()->user()->hakakses == 'Guru')
                    <li><a href="/inputnilaiadmin"><i class="fa fa-flask"></i> Nilai <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a href="/inputnilaispc"><i class="fa fa-flask"></i> Nilai <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Kurikulum'||auth()->user()->hakakses == 'Guru')
                    <li><a href="/tugas"><i class="fa fa-graduation-cap"></i> Tugas <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Siswa')
                    <li><a href="/tugassiswa"><i class="fa fa-graduation-cap"></i> Tugas Siswa <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Siswa')
                    <li><a href="/datanilaisiswa"><i class="fa fa-graduation-cap"></i> Nilai <span
                                class="label label-success pull-right"> <span></a>
                    {{-- <li><a href="/nilai-ku"><i class="fa fa-graduation-cap"></i> Nilai <span
                                class="label label-success pull-right"> <span></a> --}}
                    </li>
                    @endif
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
                    <li><a href="/identitas"><i class="fa fa-graduation-cap"></i> Identitas Sekolah <span
                                class="label label-success pull-right"> <span></a>
                    </li>
                    @endif
               
                    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
                    <li><a><i class="fa fa-book"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/guru">Data Guru</a></li>
                            <li><a href="/siswa">Data Siswa</a></li>
                        </ul>
                    </li>
                    @endif
                    


            </div>
        </div>
    </div>
</div>
