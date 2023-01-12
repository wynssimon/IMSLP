var inputs = document.querySelectorAll("input[type='submit']");
for (var i = 0; i < ownChoiceRating; i++) {
  inputs[i].classList.add('beforeHover');
}
for (var i = 0; i < inputs.length; i++) {
  inputs[i].addEventListener('mouseover', function () {
    for (var i = 0; i < ownChoiceRating; i++) {
      inputs[i].classList.remove('beforeHover');
    }
    for (var j = 0; j < inputs.length; j++) {
      if (j < this.value) {
        inputs[j].classList.add('beforeHover');
      }
    }
  });
  inputs[i].addEventListener('mouseout', function () {
    for (var j = 0; j < inputs.length; j++) {
      inputs[j].classList.remove('beforeHover');
      for (var i = 0; i < ownChoiceRating; i++) {
        inputs[i].classList.add('beforeHover');
      }
    }
  });
}
