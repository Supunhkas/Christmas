//  countdown timer
let countDate = new Date("december 25, 2022 00:00:00").getTime();

function changeSection() {
  document.getElementById("hero").style.display = "none";
  document.getElementById("celebrate").style.display = "block";
}

function countDown() {
  let now = new Date().getTime();
  gap = countDate - now;

  let seconds = 1000;
  let minutes = seconds * 60;
  let hours = minutes * 60;
  let days = hours * 24;

  let d = Math.floor(gap / days);
  let h = Math.floor((gap % days) / hours);
  let m = Math.floor((gap % hours) / minutes);
  let s = Math.floor((gap % minutes) / seconds);

  document.getElementById("days").innerText = d;
  document.getElementById("hours").innerText = h;
  document.getElementById("minutes").innerText = m;
  document.getElementById("seconds").innerText = s;
  document.getElementById("celebrate").style.display = "none";
  if (d <= 0 && h <= 0 && m <= 0 && s <= 0)
    // document.getElementById("countDownSection").style.display = "none";
    // document.getElementById("wishes").style.display = "block";

    changeSection();
}

setInterval(function () {
  countDown();
}, 1000);

// Snow fall

function createSnow() {
  let hero = document.querySelector("#hero");
  let span = document.createElement("span");

  span.style.left = Math.random() * innerWidth + "px";

  hero.appendChild(span);
  setTimeout(() => {
    span.remove();
  }, 5000);
}
setInterval(createSnow, 100);
