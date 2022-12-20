let randomBtn = document.querySelector("button");
let result = document.querySelector("h1");
// console.log(<?php echo (json_encode($arrayToString));?>)
// let users = ["mark", "john", "wood", "alex", "jay", "simon", "messi"];

//const obj = JSON.parse(arrayToString);

// console.log(obj);

function getRandomName(min, max) {
  let step1 = max - min + 1;
  let step2 = Math.random() * step1;
  let result = Math.floor(step2) + min;
  return result;
}

randomBtn.addEventListener("click", () => {
  let index = getRandomName(0, users.length - 1);
  result.innerText = users[index];
});

///////////////////////////////////////////////
