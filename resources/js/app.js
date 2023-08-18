import "./bootstrap";

Echo.channel("blog-chat").listen("BlogChat", (event) => {
    console.log(event);
    document.getElementById("chat").innerText = `${event.username}
    ${event.message}`;
});
