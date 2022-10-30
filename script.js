//filter
filterSelection('all');
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName('filterDiv');
  if (c == 'all') c = '';
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], 'show');
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], 'show');
  }
}

function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(' ');
  arr2 = name.split(' ');
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += ' ' + arr2[i];
    }
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(' ');
  arr2 = name.split(' ');
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(' ');
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById('myBtnContainer');
var btns = btnContainer.getElementsByClassName('btn');
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener('click', function () {
    var current = document.getElementsByClassName('active');
    current[0].className = current[0].className.replace(' active', '');
    this.className += ' active';
  });
}
//searchbar
/*function myFunction() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById('myUL');
  li = ul.getElementsByTagName('div');
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName('a')[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = '';
    } else {
      li[i].style.display = 'none';
    }
  }
}
*/
let cards = document.querySelectorAll('.filterDiv');

function liveSearch() {
  let search_query = document.getElementById('myInput').value;

  //Use innerText if all contents are visible
  //Use textContent for including hidden elements
  for (var i = 0; i < cards.length; i++) {
    if (
      cards[i].textContent.toLowerCase().includes(search_query.toLowerCase())
    ) {
      cards[i].classList.remove('is-hidden');
    } else {
      cards[i].classList.add('is-hidden');
    }
  }
}
