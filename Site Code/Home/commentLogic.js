const urlParams = new URLSearchParams(window.location.search);
const postId = urlParams.get('id');

const out = document.getElementById("tester");

out.textContent = postId;