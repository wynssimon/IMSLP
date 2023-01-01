const passwordInput = document.getElementById('password');
const strengthMeter = document.getElementById('strength-meter');

passwordInput.addEventListener('input', updateStrengthMeter);

function updateStrengthMeter() {
  const password = passwordInput.value;

  let strength = 0;
  if (password.match(/[a-z]/)) strength += 1;
  if (password.match(/[A-Z]/)) strength += 1;
  if (password.match(/[0-9]/)) strength += 1;
  if (password.match(/[!@#$%^&*?]/)) strength += 1;
  if (password.length > 8) strength += 1;

  strengthMeter.className = '';
  if (strength < 3) strengthMeter.classList.add('weak');
  else if (strength === 3) strengthMeter.classList.add('fair');
  else if (strength === 4) strengthMeter.classList.add('good');
  else if (strength === 5) strengthMeter.classList.add('strong');
}
