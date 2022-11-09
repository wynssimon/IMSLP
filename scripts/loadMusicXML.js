var osmd = new opensheetmusicdisplay.OpenSheetMusicDisplay("osmdCanvas");
  osmd.setOptions({
    backend: "svg",
    drawTitle: true,
  });
  osmd
    .load("../xml/Band_Of_Brothers.musicxml")
    .then(
      function() {
        osmd.render();
      }
    );