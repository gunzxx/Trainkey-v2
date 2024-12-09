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

    chats.forEach((chat) => {
        if (chat["authed"]) {
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
    msgInput.setAttribute("disabled", true);

    const message = msgInput.value;

    if (sendingMessage == false) {
        sendingMessage = true;
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
                    const chats = bodyRes.chats;
                    document.getElementById("chat-container").innerHTML =
                        makeChat(chats);

                    return Swal.fire({
                        text: bodyRes.message,
                        icon: "success",
                    }).then(() => {
                        msgInput.removeAttribute("disabled");
                        msgInput.value = "";
                        sendingMessage = false;
                    });
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
