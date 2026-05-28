// Hmph... dengerin baik-baik ya!
// Aku jelasin cuma karena kalau nggak,
// nanti malah debugging sambil nangis sampe jam 2 pagi.
// B-bukan karena aku peduli atau apa!! tapi memang biar akunya gak lupa aja cara kerja script yang kutulis ini. Hmph!!

document.addEventListener('DOMContentLoaded', () => {

    // Hmph! Pertama kita load CSS SweetAlert2 dulu.
    // Kalau nggak ada CSS, popup-nya bakal polos banget.
    // Kayak hubungan tanpa effort. Menyedihkan.
    const swalCss = document.createElement('link');

    swalCss.rel = 'stylesheet';

    // Ini CDN SweetAlert2.
    // Alias numpang file dari internet.
    // Karena manusia suka yang instan(aku males sih downloadnya, cdn lebih scalable bagi aku). Hmph!!!
    swalCss.href =
        '../node_modules/sweetalert2/dist/sweetalert2.min.css';

    // Masukin CSS ke <head>.
    // Browser nanti otomatis baca stylenya.
    document.head.appendChild(swalCss);



    // Sekarang load file JavaScript SweetAlert2.
    // Kalau ini nggak ada, Swal.fire bakal error.
    // Terus aku yang bikin, panik nyalahin semuanya kecuali diri sendiri.
    const swalScript = document.createElement('script');

    swalScript.src =
        '../node_modules/sweetalert2/dist/sweetalert2.min.js';

    document.body.appendChild(swalScript);



    // Hmph... bagian ini dijalankan setelah SweetAlert selesai dimuat.
    // Karena kalau belum loaded tapi dipakai...
    // ya jelas meledak lah!!
    swalScript.onload = () => {

        // Cari semua elemen yang punya:
        // onclick="return confirm(...)"
        //
        // Jadi confirm jadul browser itu bakal kita takeover.
        // Kudeta frontend kecil-kecilan. Fufu~
        const elements =
            document.querySelectorAll('[onclick*="return confirm"]');



        // Loop semua elemen yang ketemu.
        elements.forEach(el => {

            // Ambil isi onclick.
            const onclickValue =
                el.getAttribute('onclick');



            // Regex ini dipakai buat nyolong pesan dari confirm().
            //
            // Contoh:
            // return confirm('Yakin hapus?')
            //
            // Yang diambil:
            // "Yakin hapus?"
            //
            // Hmph... regex memang menyebalkan,
            // tapi kadang berguna juga.
            const match =
                onclickValue.match(/return confirm\(['"](.*?)['"]\)/);



            // Kalau pesannya berhasil diambil...
            if (match) {

                // Simpan pesannya.
                const message = match[1];



                // Hapus onclick bawaan.
                // Kita nggak mau popup browser jelek itu lagi.
                // Mata aku sakit lihatnya.
                el.removeAttribute('onclick');



                // Tambahin event click baru.
                el.addEventListener('click', function(e) {

                    // Kalau ini button/input DAN punya form...
                    if (
                        (
                            el.tagName.toLowerCase() === 'button' ||
                            el.tagName.toLowerCase() === 'input'
                        )
                        &&
                        el.form
                    ) {

                        // Cek validasi form dulu.
                        // Misalnya input required kosong.
                        if (!el.form.checkValidity()) {

                            // Tampilkan error bawaan browser.
                            el.form.reportValidity();

                            // Stop SweetAlert.
                            // Isi form aja belum bener, hmph!!
                            return;
                        }
                    }



                    // Cegah aksi default.
                    // Misalnya link langsung kebuka.
                    e.preventDefault();



                    // Nah ini popup SweetAlert2-nya.
                    // Jauh lebih cantik daripada confirm() jadul.
                    // Browser native tuh selera desainnya kriminal.
                    Swal.fire({

                        // Judul popup.
                        title: 'Konfirmasi',

                        // Pesan hasil curian regex tadi.
                        text: message,

                        // Icon warning.
                        icon: 'warning',

                        // Tombol batal muncul.
                        showCancelButton: true,

                        // Warna tombol "Ya".
                        confirmButtonColor: '#005bb5',

                        // Warna tombol batal.
                        cancelButtonColor: '#d33',

                        // Teks tombol confirm.
                        confirmButtonText: 'Ya',

                        // Teks tombol cancel.
                        cancelButtonText: 'Batal'

                    }).then((result) => {

                        // Kalau user pencet "Ya"
                        if (result.isConfirmed) {



                            // Kalau elemennya link <a>
                            if (el.tagName.toLowerCase() === 'a') {

                                // Pindah halaman.
                                // Jangan salah klik lagi ya. Hmph.
                                window.location.href = el.href;



                            // Kalau button/input
                            } else if (
                                el.tagName.toLowerCase() === 'button' ||
                                el.tagName.toLowerCase() === 'input'
                            ) {

                                // Cari form terdekat.
                                const form = el.closest('form');



                                // Kalau form ditemukan...
                                if (form) {

                                    // Hmph... ini tricky.
                                    //
                                    // Kalau tombol punya attribute "name",
                                    // biasanya data tombol ikut terkirim.
                                    //
                                    // Tapi karena submit-nya manual pakai JS,
                                    // data tombol bisa hilang.
                                    //
                                    // Jadi kita bikin hidden input palsu.
                                    // Licik? Sedikit.
                                    if (el.name) {

                                        const hiddenInput =
                                            document.createElement('input');

                                        hiddenInput.type = 'hidden';

                                        hiddenInput.name = el.name;

                                        // Kalau tombol nggak punya value,
                                        // kasih default "1".
                                        hiddenInput.value =
                                            el.value || '1';

                                        form.appendChild(hiddenInput);
                                    }



                                    // Submit form manual.
                                    // Hmph... akhirnya selesai juga.
                                    form.submit();
                                }
                            }
                        }

                        // Kalau user pencet batal...
                        // ya udah. Hidup penuh keraguan memang.
                    });
                });
            }
        });

        // --- TAMBAHAN BARU ---
        // Fungsi global buat konfirmasi logout.
        // Dipanggil dari navbar: onclick="confirmLogout('url')"
        window.confirmLogout = function(url) {
            Swal.fire({
                title: 'Keluar?',
                text: 'Kamu akan keluar dari sistem.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        };

        // Fungsi global buat konfirmasi hapus.
        // Dipanggil dari tombol: onclick="confirmHapus('url')"
        window.confirmHapus = function(url) {
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        };

        // --- FLASHDATA AUTO-DETECT ---
        // Cari hidden div yang di-set oleh footerDashboard.php.
        // Kalau ada, tampilkan sebagai SweetAlert popup.
        var flashSuccess = document.getElementById('flash-success');
        if (flashSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: flashSuccess.dataset.message,
                timer: 2500,
                showConfirmButton: false
            });
        }

        var flashError = document.getElementById('flash-error');
        if (flashError) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: flashError.dataset.message
            });
        }

        var flashWarning = document.getElementById('flash-warning');
        if (flashWarning) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: flashWarning.dataset.message
            });
        }
        // --- AKHIR FLASHDATA ---
    };
});