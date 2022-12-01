const sheets = document.querySelectorAll('.shop-card');

//dropdown
function myFunction() {
  document.getElementById('myDropdown').classList.toggle('show');
}
function myFunction1() {
  document.getElementById('myDropdown').classList.toggle('hide');
}
function myFunction2() {
  document.getElementById('myDropdown1').classList.toggle('show');
}
function myFunction3() {
  document.getElementById('myDropdown1').classList.toggle('hide');
}
function myFunction4() {
  document.getElementById('myDropdown2').classList.toggle('show');
}
function myFunction5() {
  document.getElementById('myDropdown2').classList.toggle('hide');
}
//searchbar
function liveSearch() {
  let search_query = document.getElementById('myInput').value;

  //Use innerText if all contents are visible
  //Use textContent for including hidden elements
  for (var i = 0; i < sheets.length; i++) {
    if (
      sheets[i].textContent.toLowerCase().includes(search_query.toLowerCase())
    ) {
      sheets[i].classList.remove('is-hidden');
    } else {
      sheets[i].classList.add('is-hidden');
    }
  }
}

document.getElementById('myInput').oninput = liveSearch;

//buttons filter
/*let knop = document.querySelectorAll('#btn');

knop.forEach((btn) =>
  btn.addEventListener('click', (e) => {
    e.target.classList.toggle('active');
    liveSearch2(e.target.value);
  }),
);
function liveSearch2(button) {
  for (var i = 0; i < sheets.length; i++) {
    if (sheets[i].textContent.toLowerCase().includes(button.toLowerCase())) {
      sheets[i].classList.remove('is-hidden');
    } else {
      sheets[i].classList.add('is-hidden');
    }
  }
}

let btn2 = document.querySelectorAll('#all');

btn2.forEach((btn) =>
  btn.addEventListener('click', (e) => {
    e.target.classList.toggle('active');
    liveSearch3(e.target.value);
  }),
);
function liveSearch3(button) {
  for (var i = 0; i < sheets.length; i++) {
    sheets[i].classList.remove('is-hidden');
  }
}
*/
