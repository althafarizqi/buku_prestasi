/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

/* eslint-disable camelcase */

(function ($) {


  setTimeout(function () {
    // Mendapatkan tanggal saat ini
    var currentDate = new Date();

    // Periksa apakah hari ini adalah hari Jumat (0: Minggu, 1: Senin, ..., 6: Sabtu)
    if (currentDate.getDay() === 5) { // 5 adalah hari Jumat
      // Periksa apakah notifikasi sudah ditampilkan dalam 15 menit terakhir
      if (window.___browserSync___ === undefined && Number(localStorage.getItem('MessageShowed')) < Date.now()) {
        // Setelah notifikasi ditampilkan, simpan waktu tampilnya
        localStorage.setItem('MessageShowed', (Date.now()) + (15 * 60 * 1000))
        // eslint-disable-next-line no-alert
        alert('Bismillah, \nDihari Jumat ini, mari doakan pengembang beserta keluarga dengan segala kebaikan, Sebagaimana antum doakan diri antum beserta keluarga. \n\nJazakumullah khoir. ')
      }
    }
  }, 1000);


})(jQuery)
