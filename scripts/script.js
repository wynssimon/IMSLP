//const buttons = document.querySelectorAll('.btn');
const sheets = document.querySelectorAll('.filterDiv');
/*const checkbox = document.querySelectorAll('.check');

checkbox.forEach((btn) =>
  btn.addEventListener('change', (e) => {
    e.target.classList.toggle('active');
    filterSelection2;
  }),
);

/*Hieronder wordt de classlist active toegevoegd aan de button als erop geklikt wordt en wordt de functie filterSelection gestart*/
/*buttons.forEach((btn) =>
  btn.addEventListener('click', (e) => {
    e.target.classList.toggle('active');
    filterSelection();
  }),
);

/*...om een array terug te keren aangezien querySelectorAll geen array weergeeft.*/
/*function filterSelection() {
  const filters = [...document.querySelectorAll('.btn.active')].map(
    (el) => el.dataset.filter,
  );
  sheets.forEach((c) => {
    /*Als bv classic al verborgen is EN ENKEL EN ALLEEN ALS OOK de desbetreffende datafilter wordt geselecteerd dan wordt de naam van de filter (bv Classic) toegevoegd als class (vandaar het puntje ervoor) filter.join('.')  zet gewoon een puntje voor de elementen van filters (dus classic, rennaisance,...)*/
/*if (filters.length === 0 || c.matches(`.${filters.join('.')}`)) {
      /*dan wordt de hidden class verwijderd dus wordt de div zichtbaar*/
/*     c.classList.remove('hidden');
    } else {
      c.classList.add('hidden');
    }
  });

  const hiddensheets = document.querySelectorAll('.filterDiv.hidden');
  const noResultElement = document.getElementById('noResult');

  /*als al de totale hoeveelheid componisten gelijk is aan de totale hoeveelheid verborgen componisten dan wordt de classlist 'hidden' verwijderd waardoor "no results" zichtbaar wordt*/
/*  if (sheets.length === hiddensheets.length) {
    noResultElement.classList.remove('hidden');
  } else {
    noResultElement.classList.add('hidden');
  }
}
function filterSelection2() {
  const filters = [...document.querySelectorAll('.check.active')].map(
    (el) => el.dataset.filter,
  );
  sheets.forEach((c) => {
    if (filters.length === 0 || c.matches(`.${filters.join('.')}`)) {
      c.classList.remove('hidden');
    } else {
      c.classList.add('hidden');
    }
  });

  const hiddensheets = document.querySelectorAll('.filterDiv.hidden');
  const noResultElement = document.getElementById('noResult');

  if (sheets.length === hiddensheets.length) {
    noResultElement.classList.remove('hidden');
  } else {
    noResultElement.classList.add('hidden');
  }
}*/
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
let knop = document.querySelectorAll('.btn');

knop.forEach((btn) =>
  btn.addEventListener('click', (e) => {
    e.target.classList.toggle('active');
    liveSearch2();
  }),
);
function liveSearch2() {
  let button = document.getElementById('btn').value;
  for (var i = 0; i < sheets.length; i++) {
    if (sheets[i].textContent.toLowerCase().includes(button.toLowerCase())) {
      sheets[i].classList.remove('is-hidden');
    } else {
      sheets[i].classList.add('is-hidden');
    }
  }
}

document.getElementById('btn').oninput = liveSearch2;
