        
    </div>
    <footer class="sticky-footer bg-white border-top">
        <div class="row footer">
            <div class="container my-3 main-container">
                    <div class="copyright text-center">
                        <span>Copyright &copy Tumpas Jaya</span> 
                    </div>
            </div>
        </div>
    </footer>

    <!-- modal for create form ends-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url();?>assets/js/popper.min.js"></script>
    <!-- <script src="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script> -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- Cookie jquery file -->
    <script src="<?= base_url();?>assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="<?= base_url();?>assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="<?= base_url();?>assets/vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Footable jquery file -->
    <script src="<?= base_url();?>assets/vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- jVector map jquery file -->
    <script src="<?= base_url();?>assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="<?= base_url();?>assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intro.js@7.0.1/intro.min.js"></script>
    <!-- jquery toast message file -->
    <script src="<?= base_url();?>assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="<?= base_url();?>assets/js/main.js"></script>

    <!-- page specific script -->
    <style>
        .introjs-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        }

        /* Customize the tooltip */
        .introjs-tooltip {
        max-height: 400px;
        width: auto;
        padding: 5px;
        overflow: scroll;
        }

        /* Customize the next button */
        .introjs-nextbutton {
        background-color: #007bff;
        color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.about').click(function(){
                var intro = introJs().setOptions({
                    autoPosition: true,
                    steps: [
                        {
                            title: 'Tentang Aplikasi',
                            intro: 'Aplikasi ini adalah aplikasi pengelolaan SPP untuk membantu memudahkan administrator atau bendahara dalam mengelola SPP',
                            position: 'center'
                        },
                        {
                            intro: 'Ini adalah bagian header pada aplikasi, terdapat nama yayasan sekolah ini dan tombol Admin',
                            element: document.querySelector('.main-header'),
                            positon: 'center'
                        },
                        {
                            intro: 'Pada bagian sidebar ini terdapat tiga buah folder sebagai tempat untuk mengelola data.',      
                            element: document.querySelector('.sidebar'),
                        },
                        {
                            intro: `Bagian footer di bawah untuk menunjukkan bahwa aplikasi pengelolaan SPP ini 
                            milik Yayasan Islam Rahmatan Lil Alamin`,      
                            element: document.querySelector('.footer'),
                        },
                        {
                            element: document.querySelector(' .info'),
                            intro: 'Jika ingin melihat / mengubah profil atau logout, bisa mengklik pada bagian ini',      
                        },
                        {
                            intro: `Dan di sini merupakan halaman di mana informasi ditampilkan, seperti contoh pada halaman dashboard
                                    menampilkan informasi utama.`,      
                            element: document.querySelector('.content'),
                        },
                    ],
                });
                intro.start();
            });

            $('.using').click(function(){
                let intro = introJs();
                intro.setOptions({
                    steps: [
                        {
                            title: 'Penggunaan Aplikasi',
                            intro: `Aplikasi ini terintegrasi dengan aplikasi mobile milik orang tua siswa, proses kerjanya dimulai dari sini.
                            Admin menambahkan atau mengubah data yang tersedia pada sidebar kemudian data ini akan dikirimkan ke aplikasi mobile`,
                            position: 'center'
                        },
                        {
                            intro: `Sidebar ini merupakan tempat untuk menambah serta mengubah data, terdapat tiga buah folder yang di dalamnya terdapat tombol - tombol
                            untuk mengarah ke halaman setiap data`,      
                            element: document.querySelector('.sidebar'),
                        },
                    ],
                });
                intro.addSteps([{
                    element: document.querySelector('.master-data-ul'),
                    intro: 'Pada master data, merupakan folder untuk mengelola data utama seperti Data Instansi, Data Kelas, Data Tahun Akademik, Data Siswa, dan Data Admin. Proses penambahan data di sini harus mengisi data dari yang paling atas hingga ke yang paling bawah (kecuali Data Admin)',
                },
                {
                    element: document.querySelector('.transaksi-ul'),
                    intro: `Pada bagian transaksi, Data Biaya berfungsi untuk menentukan jumlah biaya setiap instansi lalu data ini akan dikirim ke aplikasi mobile. 
                    Sedangkan Data Transaksi berfungsi untuk menerima biaya SPP yang dikirimkan dari aplikasi mobile dan juga mencetak histori pembayaran`,
                },
                {
                    element: document.querySelector('.nonaktif-ul'),
                    intro: `Jika ada data usang yang sudah tidak dibutuhkan, data akan disimpan pada folder ini. Ketika
                    data ternyata memang masih dibutuhkan, data dapat dipulihkan kembali.`,
                }],
                ).onchange(function(targetElement) {
                    var currentStep = intro._introItems.findIndex(item => item.element === targetElement);
                    
                    if(currentStep === 2) {
                        // Show the element
                        document.querySelector('.master-data-ul').style.display = 'block';
                        document.querySelector('.master-data-nav').classList.add('active');
                    }else {
                        document.querySelector('.master-data-ul').style.display = 'none';
                        document.querySelector('.master-data-nav').classList.remove('active');
                    }
                    if(currentStep === 3){
                        // Show the element
                        document.querySelector('.transaksi-ul').style.display = 'block';
                        document.querySelector('.transaksi-nav').classList.add('active');
                    } else {
                        // Show the element
                        document.querySelector('.transaksi-ul').style.display = 'none';
                        document.querySelector('.transaksi-nav').classList.remove('active');
                    }
                    if(currentStep === 4){
                        // Show the element
                        document.querySelector('.nonaktif-ul').style.display = 'block';
                        document.querySelector('.nonaktif-nav').classList.add('active');
                    } else {
                        // hide the element
                        document.querySelector('.nonaktif-ul').style.display = 'none';
                        document.querySelector('.nonaktif-nav').classList.remove('active');
                    }
                }).onexit(function() {
                    document.querySelector('.master-data-ul').style.display = 'none';
                    document.querySelector('.master-data-nav').classList.remove('active');
                    document.querySelector('.transaksi-ul').style.display = 'none';
                    document.querySelector('.transaksi-nav').classList.remove('active');
                    document.querySelector('.nonaktif-ul').style.display = 'none';
                    document.querySelector('.nonaktif-nav').classList.remove('active');
                });
                intro.start();
            });

            // $('.instansi-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Instansi',
            //                 intro: `Ini adalah halaman yang menampilkan data instansi sekolah. 
            //                 Data instansi ini haruslah ditambahkan pertama kali ketika ingin menambahkan Data Kelas, Data Biaya, dan Data Siswa.`
            //             },
            //             {
            //                 element: '.instansi-add',
            //                 intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
            //                 sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/tsd.png" />
            //                 Data tidak boleh kosong ketika mengklik tombol <b>Simpan</b> atau akan muncul pesan peringatan
            //                 seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataInstansiError.png" />
            //                 `
            //             },
            //             {
            //                 element: '.instansi-cari',
            //                 intro: `Untuk memudahkan pencarian data instansi sekolah, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan instansi lalu mengklik tombol cari.`
            //             },
            //             {
            //                 element: '.instansi-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada dua tombol
            //                  <img class="img-fluid" src="<?= base_url();?>assets/img/dataBiayaUbahHapus.png" /> untuk mengubah data dan untuk
            //                 membuang sementara data ke folder <b>Data Nonaktif</b>.
            //                 `,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.instansi-update',
            //                 intro: `Ketika mengklik tombol <b>Ubah</b>, akan muncul sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataInstansiUbah.png" />`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.siswa-pagination',
            //                 intro: `
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya.`,
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.kelas-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Kelas',
            //                 intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data kelas. Data kelas
            //                 ditambahkan setelah menambahkan data instansi agar kelas - kelas dapat dikelompokkan berdasarkan
            //                 instansinya.`
            //             },
            //             {
            //                 element: '.kelas-add',
            //                 intro: `Klik tombol <b>Tambah Data</b> untuk menampilkan sebuah form penambahan data.
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataKelas.png" />
            //                 `
            //             },
            //             {
            //                 element: '.kelas-cari',
            //                 intro: `Untuk memudahkan pencarian data kelas sekolah, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan kelas lalu mengklik tombol cari.`
            //             },
            //             {
            //                 element: '.instansi-kelas',
            //                 intro: `Pada tabel data kelas, terdapat instansi yang didapatkan dari tabel <b>Data Instansi</b> 
            //                 sekolah yang sudah ditambahkan sebelumnya.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.kelas-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/dataBiayaUbahHapus.png" /> 
            //                 untuk mengubah data serta menghapus sementara data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.kelas-update',
            //                 intro: `Ketika mengklik tombol <b>Ubah</b>, akan muncul sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataKelasUbah.png" />`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.kelas-pagination',
            //                 intro: `<img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya.`,
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.thn-akademik-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Tahun Akademik',
            //                 intro: `Halaman ini berfungsi untuk menambahkan tahun akademik peserta didik. Untuk menambah data kelas ini,
            //                 tidak harus dilakukan setelah menambahkan <b>Data Instansi</b> atau <b>Data Kelas</b> tetapi harus ditambah
            //                 sebelum menambahkan <b>Data Siswa</b>.`
            //             },
            //             {
            //                 element: '.thn-akademik-add',
            //                 intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
            //                 sebuah form. <img class="img-fluid" src="<?= base_url();?>assets/img/dataTahunAkademik.png" />
            //                 Cara menambahkan data ini, tinggal mengisikan pada input Tahun Ganjil (misal: 2023), lalu secara otomatis akan muncul
            //                 tahun semester genap pada input Tahun Genap.`
            //             },
            //             {
            //                 element: '.thn-akademik-add',
            //                 intro: `<img class="img-fluid" src="<?= base_url();?>assets/img/dataTahunAkademik.png" />Selain itu,
            //                 terdapat sebuah input berupa checkbox status <b>Aktif/Tidak Aktif</b> untuk menandai bahwa tahun akademik ini adalah
            //                 tahun akademik yang sedang berjalan sekarang.`
            //             },

            //             {
            //                 element: '.thn-akademik-cari',
            //                 intro: `Untuk memudahkan pencarian data tahun akademik, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan tahun akademik lalu mengklik tombol cari.`
            //             },
            //             {
            //                 element: '.thn-akademik-status',
            //                 intro: `Pada kolom <b>Status</b> di bawah ini, terdapat dua status: <b>Aktif</b>
            //                 (Tahun Akademik yang saat ini berjalan) dan <b>Tidak Aktif</b> (Tahun Akademik yang
            //                 sudah berlalu atau yang akan datang).`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.thn-akademik-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/ubah.png" /> 
            //                 untuk mengubah data serta menghapus sementara data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.thn-akademik-update',
            //                 intro: `Ketika mengklik tombol <b>Ubah</b>, akan muncul sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataTahunAkademikUbah.png" />
            //                 ket: form ubah tahun akademik dengan status <b>Tidak Aktif</b>
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataTahunAkademikUbahAktif.png" />
            //                 ket: form ubah tahun akademik dengan status <b>Aktif</b>
            //                 `,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.thn-akademik-update',
            //                 intro: `<b>Tambahan</b>: Ketika data tahun akademik ini diubah baik dari tahunnya atau statusnya. 
            //                 Data tahun akademik yang ada di data siswa juga akan ikut berubah sesuai dengan tahun akademik yang 
            //                 memiliki status aktif pada halaman ini`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.thn-akademik-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya.`,
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.siswa-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Siswa',
            //                 intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data siswa sekolah. 
            //                 Data siswa ini ditambahkan setelah menambahkan <b>Data Kelas</b> dan <b>Data Tahun Akademik</b>.`
            //             },
            //             {
            //                 element: '.siswa-add',
            //                 intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
            //                 sebuah form.<img class="img-fluid" src="<?= base_url();?>assets/img/dataSiswa.png" />
            //                 `
            //             },
            //             {
            //                 element: '.siswa-add-excel',
            //                 intro: `Selain menambahkan data lewat form, ada opsi lain untuk menambahkan data secara batch: yakni dengan meng-upload
            //                 file spreadsheet (Excel). <img class="img-fluid" src="<?= base_url();?>assets/img/dataSiswaExcel.png" />`
            //             },
            //             {
            //                 element: '.siswa-cari',
            //                 intro: `Untuk memudahkan pencarian nama siswa, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan nama siswa.`
            //             },
            //             {
            //                 element: '.siswa-kelas',
            //                 intro: `Pada kolom <b>Kelas</b>, data didapatkan dari <b>Data Kelas</b> 
            //                 yang ditambah atau diubah.`
            //             },
            //             {
            //                 element: '.siswa-thn-akademik',
            //                 intro: `Pada kolom <b>Tahun Akademik</b> di bawah ini, data didapatkan dari 
            //                 <b>Data Tahun Akademik</b>. Jika status siswa aktif, setiap tahun akademik yang diubah di <b>Data Tahun Akademik</b> secara otomatis
            //                 data tahun akademik yang ada di sini otomatis berubah selama status siswa aktif.`
            //             },
            //             {
            //                 element: '.siswa-status',
            //                 intro: `kolom <b>Status</b> di sini berbeda dengan yang ada di tabel <b>Data Tahun Akademik</b>
            //                 . Aktif di sini menandakan apakah siswa merupakan peserta didik aktif atau tidak.`
            //             },
            //             {
            //                 element: '.siswa-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/dataBiayaUbahHapus.png" /> 
            //                 untuk mengubah data serta menghapus sementara data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.siswa-update',
            //                 intro: `Ketika mengklik tombol <b>Ubah</b>, akan muncul sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataSiswaUbah.png" />
            //                 `,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.siswa-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.admin-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Admin',
            //                 intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data administrator yang 
            //                 mengurus aplikasi SPP ini. 
            //                 Terdapat sebuah tabel di mana data instansi akan disajikan`
            //             },
            //             {
            //                 element: '.admin-add',
            //                 intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
            //                 sebuah form.`
            //             },
            //             {
            //                 element: '.admin-cari',
            //                 intro: `Untuk memudahkan pencarian nama administrator, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan nama administrator.`
            //             },
            //             {
            //                 element: '.admin-action',
            //                 intro: `Di sini tidak ada kolom <b>Aksi</b> yang terdapat tombol <b>Ubah</b> karena untuk
            //                 mengubah data admin. Admin yang bersangkutan haruslah login terlebih dahulu lalu masuk ke 
            //                 <b>Informasi</b> untuk mengubah data. Sehingga hanya ada tombol hapus.`,
            //                 position: 'center'
            //             },
            //             {
            //                 element: '.admin-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.biaya-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Biaya',
            //                 intro: `Ini adalah halaman data biaya sekolah berdasarkan instansi. Biaya sekolah ini ditentukan biaya awalnya lalu nanti akan dikalikan 12 bulan
            //                 dan akan dikirimkan aplikasi mobile Pembayaran SPP.`
            //             },
            //             {
            //                 element: '.biaya-add',
            //                 intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
            //                 sebuah form.<img class="img-fluid" src="<?= base_url();?>assets/img/dataBiaya.png" />`
            //             },
            //             {
            //                 element: '.biaya-cari',
            //                 intro: `Untuk memudahkan pencarian jenis biaya, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan jenis biaya.`
            //             },
            //             {
            //                 element: '.biaya-instansi',
            //                 intro: `kolom <b>Data Instansi</b> berarti bahwa jumlah biaya ditentukan berdasarkan instansi
            //                 masing - masing.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.biaya-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/dataBiayaUbahHapus.png" /> 
            //                 untuk mengubah data serta menghapus sementara data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.biaya-update',
            //                 intro: `Ketika mengklik tombol <b>Ubah</b>, akan muncul sebuah form seperti ini:
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/dataBiayaUbah.png" />
            //                 `,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.biaya-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.transaksi-btn').click(function(){
            //     let intro = introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Transaksi',
            //                 intro: `Ini adalah halaman Data Transaksi. Semua data transaksi yang dikirimkan dari aplikasi
            //                 mobile akan disajikan pada sebuah tabel. Tetapi data transaksi yang ditampilkan hanya didapatkan
            //                 dari satu orang siswa.`
            //             },
            //             {
            //                 element: '.cari-siswa',
            //                 intro: `Untuk menampilkan data transaksi, ketikkan nama atau nipd yang bersangkutan di sini dan tak lupa masukkan tahun akademik
            //                 sebagai pembeda antara total nominal masuk berdasarkan tahun akademik. Nanti 
            //                 akan muncul sebuah biodata siswa seperti pada gambar di bawah.
            //                 <br>
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/transaksi.png" />`
            //             },
            //             {
            //                 element: '.cari-siswa',
            //                 intro: `Di bawah tabel biodata siswa, inilah tabel di mana data transaksi disajikan. (Contoh di bawah
            //                 ini adalah tabel yang belum menampilkan data transaksi karena belum dikirimkan oleh orang tua siswa) 
            //                 <br>
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/transaksi-2.png" />`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.cari-siswa',
            //                 intro: `Contoh di bawah ini adalah tabel yang menampilkan data transaksi yang telah dikirimkan oleh orang tua siswa
            //                 , di situ terdapat sebuah tombol dengan tulisan <b>Ditunggu</b> yang di mana data transaksi orang tua siswa harus di
            //                 konfirmasi oleh admin agar datanya diterima. Jika diterima, maka jumlah nominal transaksi yang masuk akan dikalkulasikan
            //                 ke <b>Nominal Masuk</b>.
            //                 <br>
            //                 <img class="img-fluid" src="<?= base_url();?>assets/img/transaksi-3.png" />`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.cari-siswa',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.cetak-transaksi',
            //                 intro: `Data transaksi bisa dicetak ke dalam file dengan format Excel atau PDF jika diperlukan.
            //                 <br>
            //                 Data transaksi yang dapat dicetak bisa berdasarkan satu nipd siswa yang dimasukkan di pencarian atau semua
            //                 siswa peserta didik aktif.`,
            //             },
            //             {
            //                 element: '.tanggal-transaksi',
            //                 intro: `Mencetak data transaksi bisa berdasarkan rentang tanggal tertentu atau tidak terikat tanggal.`,
            //             },
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.nonaktifInstansi-btn').click(function(){
            //     let intro = new introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Nonaktif Transaksi',
            //                 intro: `Ini adalah halaman Data Nonaktif Instansi. Ketika ada data instansi yang tidak dibutuhkan, akan disimpan pada tabel ini. 
            //                 Tetapi, menonaktifkan data instansi secara otomatis akan menonaktifkan data kelas, dan data biaya yang terkait dengan instansinya. `
            //             },
            //             {
            //                 title: 'Data Nonaktif Transaksi',
            //                 intro: `Maka dari itu, usahakan untuk mengubah data kelas dan data biaya ke instansi lain dahulu
            //                 agar data tidak otomatis dinonaktifkan.`
            //             },
            //             {
            //                 element: '.nonaktifInstansi-cari',
            //                 intro: `Untuk memudahkan pencarian instansi, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan instansi.`
            //             },
            //             {
            //                 element: '.nonaktifInstansi-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/restore.png" /> 
            //                 untuk memulihkan data. Ketika data ini dipulihkan, data kelas dan data biaya tidak otomatis dipulihkan juga.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.nonaktifInstansi-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
                        
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.nonaktifKelas-btn').click(function(){
            //     let intro = new introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Nonaktif Kelas',
            //                 intro: `Ini adalah halaman Data Nonaktif Kelas. Ketika ada data kelas yang tidak dibutuhkan, akan disimpan pada tabel ini. 
            //                 Tetapi, menonaktifkan data kelas secara otomatis akan menonaktifkan data siswa.`
            //             },
            //             {
            //                 title: 'Data Nonaktif Siswa',
            //                 intro: `Maka dari itu, usahakan untuk mengubah data siswa ke kelas lain dahulu
            //                 agar data tidak otomatis dinonaktifkan.`
            //             },
            //             {
            //                 element: '.nonaktifKelas-cari',
            //                 intro: `Untuk memudahkan pencarian kelas, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan kelas.`
            //             },
            //             {
            //                 element: '.nonaktifKelas-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/restore.png" /> 
            //                 untuk memulihkan data. Ketika data ini dipulihkan, data siswa tidak otomatis dipulihkan juga.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.nonaktifKelas-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },    
            //         ]
            //     });
            //     intro.start();
            //     });

            // $('.nonaktifSiswa-btn').click(function(){

            //     let intro = new introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Nonaktif Siswa',
            //                 intro: `Ini adalah halaman Data Nonaktif Siswa. Ketika ada siswa yang sudah tidak aktif baik karena berhenti atau lulus, 
            //                 datanya akan disimpan pada tabel ini. Di sini, tahun akademik tidak akan berubah seperti yang ada di <b>Data Siswa</b>.`
            //             },
            //             {
            //                 element: '.nonaktifSiswa-cari',
            //                 intro: `Untuk memudahkan pencarian nama siswa, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan nama siswa.`
            //             },
            //             {
            //                 element: '.nonaktifSiswa-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/restore.png" /> 
            //                 untuk memulihkan data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.nonaktifSiswa-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
                        
            //         ]
            //     });
            //     intro.start();
            // });
            
            // $('.nonaktifAdmin-btn').click(function(){

            //     let intro = new introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Nonaktif Admin',
            //                 intro: `Ini adalah halaman Data Nonaktif Admin. Ketika ada admin yang sudah tidak memiliki kepentingan dalam mengelola aplikasi Web SPP, 
            //                 datanya akan disimpan pada tabel ini.`
            //             },
            //             {
            //                 element: '.nonaktifAdmin-cari',
            //                 intro: `Untuk memudahkan pencarian nama admin, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan nama admin.`
            //             },
            //             {
            //                 element: '.nonaktifAdmin-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/restore.png" /> 
            //                 untuk memulihkan data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.nonaktifAdmin-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
                        
            //         ]
            //     });
            //     intro.start();
            // });

            // $('.nonaktifBiaya-btn').click(function(){

            //     let intro = new introJs();
            //     intro.setOptions({
            //         tooltipClass: 'introjs-tooltip',
            //         steps: [
            //             {
            //                 title: 'Data Nonaktif Biaya',
            //                 intro: `Ini adalah halaman Data Nonaktif Biaya. Ketika ada biaya yang sudah tidak diperlukan lagi, 
            //                 datanya akan disimpan pada tabel ini.`
            //             },
            //             {
            //                 element: '.nonaktifBiaya-cari',
            //                 intro: `Untuk memudahkan pencarian jenis biaya, bisa melakukan pencarian di sini 
            //                 dengan mengetikkan jenis biaya.`
            //             },
            //             {
            //                 element: '.nonaktifBiaya-update',
            //                 intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <img class="img-fluid" src="<?= base_url();?>assets/img/restore.png" /> 
            //                 untuk memulihkan data.`,
            //                 position: 'left'
            //             },
            //             {
            //                 element: '.nonaktifBiaya-pagination',
            //                 intro: `
            //                 <img src="<?= base_url();?>assets/img/pagination.png" />
            //                 <br>
            //                 Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
            //                 itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
            //                 berpindah ke halaman lainnya`,
            //                 position: 'left'
            //             },
                        
            //         ]
            //     });
            //     intro.start();
            // });
        });
    </script>
</body>

</html>