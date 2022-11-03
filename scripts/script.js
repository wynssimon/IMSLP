const buttons = document.querySelectorAll('.btn');
const composers = document.querySelectorAll('.filterDiv');

buttons.forEach((btn) =>
  btn.addEventListener('click', (e) => {
    e.target.classList.toggle('active');
    filterSelection();
  }),
);

function filterSelection() {
  const filters = [...document.querySelectorAll('.btn.active')].map(
    (el) => el.dataset.filter,
  );
  composers.forEach(
    (c) =>
      (c.style.display =
        filters.length === 0 || c.matches(`.${filters.join('.')}`)
          ? 'block'
          : 'none'),
  );
}
//searchbar
function liveSearch() {
  let search_query = document.getElementById('myInput').value;

  //Use innerText if all contents are visible
  //Use textContent for including hidden elements
  for (var i = 0; i < composers.length; i++) {
    if (
      composers[i].textContent
        .toLowerCase()
        .includes(search_query.toLowerCase())
    ) {
      composers[i].classList.remove('is-hidden');
    } else {
      composers[i].classList.add('is-hidden');
    }
  }
}

document.getElementById('myInput').oninput = liveSearch;
