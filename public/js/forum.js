// Fungsi untuk mengambil cookie
const getCookie = (name) => {
    const nameEQ = name + "=";
    const ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
};

function makeChat(chats) {
    let chatElement = "";

    const token = getCookie("jwt");
    const jwtParts = token.split(".");
    const decodePayload = JSON.parse(atob(jwtParts[1]));
    const user_id = decodePayload.sub;

    chats.forEach((chat) => {
        if (chat["user_id"] == user_id) {
            chatElement += `
                <div class="bubble-container authed">
                    <div class="bubble-chat">
                        <div class="header-chat">
                            <strong class="sender-chat">${
                                chat["username"]
                            }</strong>
                            <img src="${chat["profile_image"]}">
                        </div>
                        <p class="sender-chat">${chat["message"]}</p>
                        <small class="time-chat">${new Date(chat["created_at"])
                            .toISOString()
                            .slice(0, 19)
                            .replace("T", " ")}</small>
                    </div>
                </div>
            `;
        } else {
            chatElement += `
                <div class="bubble-container">
                    <div class="bubble-chat">
                        <div class="header-chat">
                            <img src="${chat["profile_image"]}">
                            <strong class="sender-chat">${
                                chat["username"]
                            }</strong>
                        </div>
                        <p class="sender-chat">${chat["message"]}</p>
                        <small class="time-chat">${new Date(chat["created_at"])
                            .toISOString()
                            .slice(0, 19)
                            .replace("T", " ")}</small>
                    </div>
                </div>
            `;
        }
    });

    return chatElement;
}

let sendingMessage = false;
$("#sendMessage").click(() => {
    const token = getCookie("jwt");
    const msgInput = document.getElementById("message-chat");

    const message = msgInput.value;

    if (sendingMessage == false) {
        sendingMessage = true;

        msgInput.setAttribute("disabled", true);
        msgInput.setAttribute("placeholder", "Mengirim...");
        fetch("/api/message", {
            method: "POST",
            headers: {
                Authorization: `Bearer ${token}`,
                "Content-Type": `application/json`,
            },
            body: JSON.stringify({
                message: message,
            }),
        })
            .then(async (apiRes) => {
                const bodyRes = await apiRes.json();

                if (apiRes.status == 200) {
                    msgInput.removeAttribute("disabled");
                    msgInput.value = "";
                    sendingMessage = false;
                    return console.log("success");
                }
                if (apiRes.status == 401) {
                    return Swal.fire({
                        text: bodyRes.message,
                        icon: "error",
                    }).then(() => {
                        window.location.href = "/logout";
                    });
                }

                if (
                    apiRes.status == 400 &&
                    bodyRes.message == "The message field is required."
                ) {
                    return Swal.fire({
                        text: bodyRes.message,
                        icon: "error",
                    }).then(() => {
                        msgInput.removeAttribute("disabled");
                        msgInput.value = "";
                        msgInput.focus();
                        sendingMessage = false;
                    });
                }

                return Swal.fire({
                    text: bodyRes.message,
                    icon: "error",
                }).then(() => {
                    window.location.reload();
                });
            })
            .catch((err) => {
                console.log(err);
            });
    }
});

$("#message-chat").keydown((event) => {
    const token = getCookie("jwt");
    const message = event.target.value;

    if (event.key == "Enter") {
        if (sendingMessage == false) {
            sendingMessage = true;

            event.target.setAttribute("disabled", true);
            event.target.setAttribute("placeholder", "Mengirim...");
            fetch("/api/message", {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": `application/json`,
                },
                body: JSON.stringify({
                    message: message,
                }),
            })
                .then(async (apiRes) => {
                    const bodyRes = await apiRes.json();

                    if (apiRes.status == 200) {
                        event.target.removeAttribute("disabled");
                        event.target.value = "";
                        sendingMessage = false;
                        event.target.focus();
                        return console.log("success");
                    }
                    if (apiRes.status == 401) {
                        return Swal.fire({
                            text: bodyRes.message,
                            icon: "error",
                        }).then(() => {
                            window.location.href = "/logout";
                        });
                    }

                    if (
                        apiRes.status == 400 &&
                        bodyRes.message == "The message field is required."
                    ) {
                        return Swal.fire({
                            text: bodyRes.message,
                            icon: "error",
                        }).then(() => {
                            event.target.removeAttribute("disabled");
                            event.target.value = "";
                            event.target.focus();
                            sendingMessage = false;
                        });
                    }

                    return Swal.fire({
                        text: bodyRes.message,
                        icon: "error",
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    }
});

$(document).ready(() => {
    scrollToBottom();

    Pusher.logToConsole = true;
    var pusher = new Pusher("local", {
        cluster: "mt1",
        wsHost: "localhost",
        wsPort: 6001,
        forceTLS: false,
    });

    pusher.connection.bind("error", (error) => {
        console.log("Detailed Error:", error);
        Swal.fire({
            text: `Gagal terhubung ke websocket!`,
        });
    });

    var channel = pusher.subscribe("forum");
    channel.bind("message", function (data) {
        const chats = data.chats;
        document.getElementById("chat-container").innerHTML = makeChat(chats);
        scrollToBottom();
    });
});

/** Scroll to bottom */
function scrollToBottom() {
    const chatContainer = document.getElementById("chat-container");
    chatContainer.scrollTop = chatContainer.scrollHeight;
}
/** Scroll to bottom end */
