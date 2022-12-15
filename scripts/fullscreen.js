const document_element = document.documentElement;
if (
  document.fullscreenEnabled /* Standard syntax */ ||
  document.webkitFullscreenEnabled /* Safari */ ||
  document.msFullscreenEnabled /* IE11 */
) {
  create_fullscreen_button();
}
function create_fullscreen_button() {
  let fullscreen_button = document.createElement('button');
  let existingDiv = document.getElementById('main');
  existingDiv.appendChild(fullscreen_button);
  fullscreen_button.setAttribute('id', 'fullscreen-button');
  fullscreen_button.addEventListener('click', toggle_fullscreen);
  fullscreen_button.innerHTML = `
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  `;
  // document.main.appendChild(fullscreen_button);
}

function toggle_fullscreen() {
  if (
    !document.fullscreenElement && // alternative standard method
    !document.mozFullScreenElement &&
    !document.webkitFullscreenElement
  ) {
    // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(
        Element.ALLOW_KEYBOARD_INPUT,
      );
    }
    document.body.setAttribute('fullscreen', '');
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
    document.body.removeAttribute('fullscreen');
  }
}
function check_fullscreen() {
  // Because users can exit & enter fullscreen differently
  if (
    document.fullscreenElement ||
    document.webkitIsFullScreen ||
    document.mozFullScreen
  ) {
    document.body.setAttribute('fullscreen', '');
  } else {
    document.body.removeAttribute('fullscreen');
  }
}
setInterval(function () {
  check_fullscreen();
}, 1000);
