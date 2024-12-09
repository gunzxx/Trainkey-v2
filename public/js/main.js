let indexkata = 0;
let indexhuruf = 0;
let basebenar = 0;

let banyakhuruf = 0;
let poinbenar = 0;
let poinsalah = 0;
let poin = 0;

var indexkamus = 0;

let userInput = document.getElementById("userInput");
userInput.addEventListener("focus", () => {
    let classkata2 = ".kata" + indexkata;
    document.querySelector(classkata2).style.backgroundColor = "#A8CD89";
});

userInput.addEventListener(
    "keydown",
    (i) => {
        countdown();
    },
    { once: true }
);

document.getElementById("restart").addEventListener("click", (e) => {
    resetTeks();
});

let jalanLagi;
async function resetTeks() {
    basebenar = 0;
    let samplekata = document.querySelectorAll(".kata");

    kamus = await fetch("/api/ajax/data", {
        method: "GET",
        headers: {
            Authorization: `Bearer ${token}`,
        },
    });
    kamus = await kamus.json();

    indexkamus = 0;
    for (let i = 0; i < 10; i++) {
        samplekata[i].textContent = cekSpasikata(
            kamus[indexkamus].toLowerCase()
        );
        indexkamus++;
    }

    samplekata.forEach((subkata) => {
        subkata.style.backgroundColor = "transparent";
    });

    if (!mundur) {
        return true;
    } else {
        clearInterval(mundur);
    }

    document.querySelector(".timer").style.display = "flex";

    countTime = 60;
    document.getElementById("countdown").textContent = countTime;
    document.getElementById("userInput").value = "";
    userInput.hidden = false;

    indexkata = 0;
    indexhuruf = 0;

    banyakhuruf = 0;
    poinbenar = 0;
    poinsalah = 0;
    setPoin();

    // console.log(jalanLagi);
    if (jalanLagi == undefined) {
        jalanLagi = true;
        userInput.addEventListener(
            "keydown",
            (i) => {
                countdown();
                jalanLagi = undefined;
            },
            { once: true }
        );
    }
}

window.addEventListener("load", async () => {
    try {
        let sample = document.querySelectorAll(".kata");

        indexkamus = 0;
        const result = await fetch("/api/ajax/data", {
            method: "GET",
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        if (result.status == 200) {
            userInput.removeAttribute("disabled");
            userInput.placeholder = "Ketik disini...";

            kamus = await result.json();

            for (let i = 0; i < 10; i++) {
                sample[i].textContent = cekSpasikata(
                    kamus[indexkamus].toLowerCase()
                );

                indexkamus++;
            }
        }
        if (result.status == 401) {
            const errorText = (await result.json()).message;
            console.log(errorText);

            Swal.fire({
                text: errorText,
            }).then(() => {
                window.location.href = "/logout";
            });
            return true;
        }
        if (result.status == 400) {
            const errorText = (await result.json()).message;
            console.log(errorText);

            Swal.fire({
                text: errorText,
            });
            sample[3].textContent = "API Kamus bermasalah";
            return true;
        }
    } catch (error) {
        Swal.fire({
            text: error.message,
        });
    }
});

userInput.addEventListener("keydown", (e) => {
    let key = e.key;
    let inputValue = userInput.value;
    let result;

    let sample = document.querySelectorAll(".kata");

    let classkata = ".kata";
    classkata += indexkata;
    let kata = sample[indexkata].textContent;

    if (e.ctrlKey) {
        //cek CTRL
        e.preventDefault();
    }
    if (e.which == 32 || e.which == 13) {
        //cek enter dan spasi
        e.preventDefault();

        basebenar = poinbenar;

        if (inputValue != kata.substring(0, kata.length)) {
            document.querySelector(classkata).style.backgroundColor = "#F49D1A";
        }
        if (inputValue == kata.substring(0, kata.length)) {
            document.querySelector(classkata).style.backgroundColor = "#4ee74e";
        }
        userInput.value = "";
        inputValue = "";
        key = "";
        result = inputValue + key;

        if (indexkata >= sample.length - 1) {
            // ajaxTeks();
            for (let i = 0; i < 10; i++) {
                sample[i].textContent = cekSpasikata(
                    kamus[indexkamus].toLowerCase()
                );
                sample[i].style.backgroundColor = "transparent";
                indexkamus++;
            }
        }
        if (indexkata <= 9) {
            indexkata++;
        }
        if (indexkata > 9) {
            indexkata = 0;
        }

        let classkata3 = ".kata";
        classkata3 += indexkata;
        document.querySelector(classkata3).style.backgroundColor = "#8D9EFF";
        indexhuruf = 0;
    } else if (e.which == 20) {
        //cek capslock
        e.preventDefault();
        key = "";
        result = inputValue + key;
    } else if (key == "Backspace" || e.which == 8) {
        //cek backspace
        if (kata.substring(0, indexhuruf) == inputValue) {
            poinbenar -= 1;
        }

        key = "";
        inputValue = inputValue.slice(0, -1); //menghapus 1 huruf dibelakang

        indexhuruf -= 1;

        if (poinbenar <= basebenar) {
            poinbenar = basebenar;
        }
        benar.textContent = poinbenar;

        result = inputValue;
        if (inputValue == kata.substring(0, indexhuruf)) {
            document.querySelector(classkata).style.backgroundColor = "#4ee74e";
        } else if (inputValue != kata.substring(0, indexhuruf)) {
            document.querySelector(classkata).style.backgroundColor = "red";
        }
        if (indexhuruf <= 0) {
            indexhuruf = 0;
        }
    } else if (abjadstr.includes(e.key)) {
        if (indexhuruf < kata.length) {
            result = inputValue + key;
            indexhuruf += 1;
            if (result == kata.substring(0, indexhuruf)) {
                poinbenar += 1;
                poinsalah += 0;
                banyakhuruf += 1;
                setPoin();
                document.querySelector(classkata).style.backgroundColor =
                    "#4ee74e";
            } else if (result != kata.substring(0, indexhuruf)) {
                poinbenar += 0;
                poinsalah += 1;
                banyakhuruf += 1;
                setPoin();
                document.querySelector(classkata).style.backgroundColor = "red";
            }
        } else if (indexhuruf >= kata.length) {
            e.preventDefault();
        }
    } else {
        //cek tombol lain
        e.preventDefault();
        key = "";
        result = inputValue + key;
    }
});


let rank_body = document.getElementById("rank_body");
let showall = document.getElementById("showall");
let search = document.getElementById("search");

showall.addEventListener("click", () => {
    const keyword = search.value;

    if (showState == "all") {
        $.ajax({
            url: "/api/ajax/showall",
            method: "post",
            data: {
                showState,
                keyword,
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            success: (data) => {
                showall.textContent = "Show all";
                rank_body.innerHTML = makeRowUser(data);
            },
            error: (e) => {
                search.blur();
                Swal.fire({
                    text: e.responseJSON.message,
                    icon: "error",
                });
            },
        });
        showState = "less";
    } else if (showState == "less") {
        $.ajax({
            url: "/api/ajax/showall",
            method: "post",
            data: {
                showState,
                keyword,
            },
            headers: {
                Authorization: `Bearer ${token}`,
            },
            success: (data) => {
                showall.textContent = "Show less";
                rank_body.innerHTML = makeRowUser(data);
            },
            error: (e) => {
                search.blur();
                Swal.fire({
                    text: e.responseJSON.message,
                    icon: "error",
                });
            },
        });
        showState = "all";
    }
});

search.onkeyup = (e) => {
    const keyword = search.value;

    $.ajax({
        url: "/api/ajax/search",
        method: "post",
        data: {
            showState,
            keyword,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (data) => {
            console.log(data);
            rank_body.innerHTML = makeRowUser(data);
        },
        error: (e) => {
            search.blur();
            const errorMsg = e.responseJSON
                ? e.responseJSON.message
                : e.statusText;

            Swal.fire({
                text: errorMsg,
                icon: "error",
            });
        },
    });
};
