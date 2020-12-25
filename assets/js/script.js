function mask_rupiah(number) {
    return "Rp. " + number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}