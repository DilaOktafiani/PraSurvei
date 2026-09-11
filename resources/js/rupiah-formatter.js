// resources/js/rupiah-formatter.js

function formatRupiah(angka) {
    let numberString = angka.replace(/[^,\d]/g, '').toString();
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
}

document.addEventListener('DOMContentLoaded', function () {
    const rupiahInputs = document.querySelectorAll('.input-rupiah');

    rupiahInputs.forEach(function (formattedInput) {
        const rawInput = formattedInput.nextElementSibling; 

        if (formattedInput.value && rawInput) {
            rawInput.value = formattedInput.value.replace(/\./g, '');
            formattedInput.value = formatRupiah(rawInput.value);
        }

        formattedInput.addEventListener('keyup', function (e) {
            if (rawInput) {
                rawInput.value = this.value.replace(/\./g, '');
            }
            this.value = formatRupiah(this.value);
        });
    });
});