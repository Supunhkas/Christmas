function createSnow() {
  let celebrate = document.querySelector("#celebrate");
  let span = document.createElement("span");

  span.style.left = Math.random() * innerWidth + "px";

  celebrate.appendChild(span);
  setTimeout(() => {
    span.remove();
  }, 5000);
}
setInterval(createSnow, 50);

/////////// Audio////>
// function play() {
//   var audio = document.getElementById("audio");
//   audio.play();
// }
