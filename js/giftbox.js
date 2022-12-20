const present = document.querySelector(".present");
function changeStyle() {
  var element = document.getElementById("snowman");
  element.style.display = "none";
}

let result = document.querySelector("h1");
let selectedindex;
let users = [];

present.onclick = () => {
  if (!isDrawed) {
    if (present.className == "present") {
      present.classList.toggle("open");
      changeStyle();
    } else {
    }
  } else {
  }
};

function loadData() {
  if (!isDrawed) {
    availableNameArray.forEach(setUsersArray);

    function setUsersArray(item, index, arr) {
      users[index] = item.name;
    }

    function getRandomName(min, max) {
      let step1 = max - min + 1;
      let step2 = Math.random() * step1;
      let result = Math.floor(step2) + min;

      return result;
    }

    selectedindex = randNo;

    if (availableNameArray.length > 0) {
      result.innerText = availableNameArray[selectedindex].name;

      wishList.forEach(getWishListById);

      function getWishListById(item, index, arr) {
        if (availableNameArray[selectedindex].id == item.userId) {
          document.getElementById("wish1").innerHTML = item.w1;
          document.getElementById("wish2").innerHTML = item.w2;
          document.getElementById("wish3").innerHTML = item.w3;
          document.getElementById("wish4").innerHTML = item.w4;
          document.getElementById("wish5").innerHTML = item.w5;
        }
      }
    } else {
      result.innerText = "Thats All !!";
    }
  } else {
    changeStyle();
    present.classList.toggle("open");
    result.innerText = recieverName;
    wishList.forEach(setWishListById);

    function setWishListById(item, index, arr) {
      document.getElementById("wish1").innerHTML = item.w1;
      document.getElementById("wish2").innerHTML = item.w2;
      document.getElementById("wish3").innerHTML = item.w3;
      document.getElementById("wish4").innerHTML = item.w4;
      document.getElementById("wish5").innerHTML = item.w5;
    }
  }
}
// document.getElementById

(function () {
  "use strict";

  const canvas = document.querySelector("canvas");
  const ctx = canvas.getContext("2d");

  let width, height, lastNow;
  let snowflakes;
  let maxSnowflakes = 100;

  function init() {
    snowflakes = [];
    resize();
    render((lastNow = performance.now()));
  }

  function render(now) {
    requestAnimationFrame(render);

    const elapsed = now - lastNow;
    lastNow = now;

    ctx.clearRect(0, 0, width, height);
    if (snowflakes.length < maxSnowflakes) snowflakes.push(new Snowflake());

    ctx.fillStyle = ctx.strokeStyle = "rgba(255, 255, 255, .9)";

    snowflakes.forEach((snowflake) => snowflake.update(elapsed, now));
  }

  function pause() {
    cancelAnimationFrame(render);
  }

  function resume() {
    lastNow = performance.now();
    requestAnimationFrame(render);
  }

  class Snowflake {
    constructor() {
      this.spawn();
    }

    spawn(anyY = false) {
      this.x = rand(0, width);
      this.y = anyY === true ? rand(-50, height + 50) : rand(-50, -10);
      this.xVel = rand(-0.05, 0.05);
      this.yVel = rand(0.02, 0.1);
      this.angle = rand(0, Math.PI * 2);
      this.angleVel = rand(-0.001, 0.001);
      this.size = rand(10, 20);
      this.sizeOsc = rand(0.01, 0.5);
    }

    update(elapsed, now) {
      const xForce = rand(-0.001, 0.001);

      if (Math.abs(this.xVel + xForce) < 0.075) {
        this.xVel += xForce;
      }

      this.x += this.xVel * elapsed;
      this.y += this.yVel * elapsed;
      this.angle += this.xVel * 0.05 * elapsed; //this.angleVel * elapsed

      if (
        this.y - this.size > height ||
        this.x + this.size < 0 ||
        this.x - this.size > width
      ) {
        this.spawn();
      }

      this.render();
    }

    render() {
      ctx.save();
      const { x, y, angle, size } = this;
      ctx.beginPath();
      ctx.arc(x, y, size * 0.2, 0, Math.PI * 2, false);
      ctx.fill();
      ctx.restore();
    }
  }

  // Utils
  const rand = (min, max) => min + Math.random() * (max - min);

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
    maxSnowflakes = Math.max(width / 10, 100);
  }

  window.addEventListener("resize", resize);
  window.addEventListener("blur", pause);
  window.addEventListener("focus", resume);
  init();
})();
