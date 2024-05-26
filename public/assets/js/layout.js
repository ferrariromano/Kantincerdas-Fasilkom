/*
Template Name: StarCode & Dashboard Template
Author: StarCode Kh
Version: 1.1.0
Website: https://StarCode Kh.in/
Contact: StarCode Kh@gmail.com
File: Layout Js File
*/

(function () {

    'use strict';

    if (sessionStorage.getItem('defaultAttribute')) {
        var attributesValue = document.documentElement.attributes;
        var CurrentLayoutAttributes = {};
        for (var i = 0; i < attributesValue.length; i++) {
            var attribute = attributesValue[i];
            if (attribute.nodeName && attribute.nodeName != "undefined") {
                var nodeKey = attribute.nodeName;
                CurrentLayoutAttributes[nodeKey] = attribute.nodeValue;
            }
        }
        if (JSON.stringify(CurrentLayoutAttributes) !== sessionStorage.getItem('defaultAttribute')) {
            // sessionStorage.clear();
            // location.reload();
        } else {
            var isLayoutAttributes = {
                'data-layout': sessionStorage.getItem('data-layout'),
                'data-skin': sessionStorage.getItem('data-skin'),
                'data-mode': sessionStorage.getItem('data-mode'),
                'dir': sessionStorage.getItem('dir'),
                'data-content': sessionStorage.getItem('data-content'),
                'data-sidebar-size': sessionStorage.getItem('data-sidebar-size'),
                'data-navbar': sessionStorage.getItem('data-navbar'),
                'data-sidebar': sessionStorage.getItem('data-sidebar'),
                'data-topbar': sessionStorage.getItem('data-topbar'),
            };

            for (var x in isLayoutAttributes) {
                if (isLayoutAttributes[x] && isLayoutAttributes[x]) {
                    document.documentElement.setAttribute(x, isLayoutAttributes[x]);
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen input price
        var priceInput = document.getElementById('price');

        // Tambahkan event listener untuk memantau perubahan nilai
        priceInput.addEventListener('input', function() {
            // Ambil nilai input
            var priceValue = parseFloat(priceInput.value);

            // Pastikan nilai input adalah angka
            if (!isNaN(priceValue)) {
                // Format nilai menjadi format Rupiah
                var formattedPrice = formatRupiah(priceValue);

                // Masukkan kembali nilai yang diformat ke dalam input
                priceInput.value = formattedPrice;
            }
        });

        // Fungsi untuk memformat nilai menjadi format Rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formattedPrice = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + formattedPrice + ',00'; // Tambahkan ',00' untuk menampilkan angka desimal
        }
    });



})();
