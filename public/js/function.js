abjad = [
    "a",
    "b",
    "c",
    "d",
    "e",
    "f",
    "g",
    "h",
    "i",
    "j",
    "k",
    "l",
    "m",
    "n",
    "o",
    "p",
    "q",
    "r",
    "s",
    "t",
    "u",
    "v",
    "w",
    "x",
    "y",
    "z",
];

let showState = "less";


function makeRowUser(users) {
    let row = '';
    const id = document.getElementById('user_id').textContent;
    users.forEach((user, key) => {
        if(user['authed']){
            row += `
                <tr style="background-color:green;">
                    <td class="no">${key+1}</td>
                    <td class="name-colomn">
                        <img src="img/pfp/pfp${user['profile']}.png" alt="">
                        <p class="img">${user['name']}</p>
                    </td>
                    <td class="point-colomn">
                        <p>${user['high_point']}</p>
                    </td>
                    <td class="word-colomn">
                        <p>${user['count_word']}</p>
                    </td>
                </tr>
            `;
        }else{
            row += `
                <tr>
                    <td class="no">${key + 1}</td>
                    <td class="name-colomn">
                        <img src="img/pfp/pfp${user['profile']}.png" alt="">
                        <p class="img">${user['name']}</p>
                    </td>
                    <td class="point-colomn">
                        <p>${user['high_point']}</p>
                    </td>
                    <td class="word-colomn">
                        <p>${user['count_word']}</p>
                    </td>
                </tr>
            `;
        }
    });
    return row;
}



function shuffle(array) {
    let temp = [];
    for (var i = array.length; i > 0; i--) {
        var j = Math.floor(Math.random() * array.length);
        temp.push(array[j]);
    }
    return temp;
}

function cekSpasi(array) {
    return array.map((kata) =>
        kata
            .split("")
            .map((e) => (e == " " ? "" : e))
            .join("")
    );
}

function cekSpasikata(kata) {
    return kata
        .split("")
        .map((e) => (e == " " ? "" : e))
        .join("");
}

function cekHuruf(array) {
    return array.map((kata) =>
        kata
            .split("")
            .map((e) => (abjad.includes(e.toLowerCase()) ? e : ""))
            .join("")
    );
}

function cekHurufkata(kata) {
    return kata
        .split("")
        .map((e) => (abjad.includes(e.toLowerCase()) ? e : ""))
        .join("");
}

var countTime = 60;
var mundur;

function countdown() {
    countTime = 60;
    document.getElementById("countdown").textContent = countTime;

    const keyword = document.getElementById('search').value;
    mundur = setInterval(function () {
        countTime -= 1;
        if (countTime <= 0) {
            countTime = 0;
            userInput.hidden = true;
            userInput.blur();
            clearInterval(mundur);

            let user_id = document.getElementById("user_id").textContent;
            

            let highpoin = document.getElementById("high_poin").textContent;
            if (poin > highpoin) {
                const highpoin_text = document.getElementById("high_poin");

                let rank = document.getElementById("rank_body");
                // console.log(rank);

                $.ajax({
                    url: "/api/ajax/update",
                    data: {
                        highPoint: poin,
                        countWord: banyakhuruf,
                    },
                    dataType: "json",
                    method: "post",
                    success: function (data) {
                        highpoin_text.textContent = data.high_point;
                    },
                    error: function (error) {
                        console.log(error);
                        console.log(arguments);
                        console.log("ajax1 gagal");
                    },
                });

                $.ajax({
                    url: "/api/ajax/rank",
                    method: "post",
                    data: {
                        showState,
                        keyword,
                    },
                    success: (data) => {
                        rank.innerHTML = makeRowUser(data);
                        console.log("ajax2 oke");
                    },
                    error: (error) => {
                        // console.log(error);
                        console.log("ajax2 gagal");
                    },
                });
            }
            if (poin <= highpoin) {
                console.log("Poin kecil");
            }
        }
        document.getElementById("countdown").textContent = countTime;
        // lanjut = false;
    }, 1000);
}

function setPoin() {
    let huruf = document.getElementById("huruf");
    let benar = document.getElementById("benar");
    let salah = document.getElementById("salah");
    let wpm = document.getElementById("poin");

    huruf.textContent = banyakhuruf;
    benar.textContent = poinbenar;
    salah.textContent = poinsalah;
    poin = poinbenar - poinsalah;
    wpm.textContent = poin;
}

function showNotify() {
    notify = document.getElementById("notify");
    notify.style.right = 0;
    setTimeout(() => {
        notify.style.right = "-500px";
    }, 1000);
}
