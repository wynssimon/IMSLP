const sheets = document.querySelectorAll('.shop-card');

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
