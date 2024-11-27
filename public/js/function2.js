let kamus = [
    'tes kata',
]

function cekSpasi(array) {
    return array.map(kata => kata.split("").map((e) => e == " " ? '' : e).join(""))
}

console.log(cekSpasi(kamus));
