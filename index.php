<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/reset.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/sheetsresults.css" />
    <title>IMSLP</title>
  </head>
  <body>
    <header>
      <h1>IMSLP</h1>
      <nav>
        <a href="index.php">Home</a>
        <a href="pages/subscription.php">Subscription</a>
        <a href="pages/login.php">Login</a>
        <a href="pages/about.php">About</a>
        <input type="text" id="myInput" placeholder="Search for music..." title="Type in a name" />
      </nav>
    </header>
    <main>
      <div id="filters">
        <div id="myBtnContainer">
          <p>Period</p>
          <button data-filter="Barok" class="btn">Barok</button>
          <button data-filter="Classic" class="btn">Classic</button>
          <button data-filter="Renaissance" class="btn">Renaissance</button>
          <button data-filter="Romantic" class="btn">Romantic</button>
        </div>
        <div id="myBtnContainer">
          <p>Composer</p>
          <button data-filter="DiLasso" class="btn">De Lassus</button>
          <button data-filter="Bach" class="btn">Bach</button>
          <button data-filter="Vivaldi" class="btn">Vivaldi</button>
          <button data-filter="Schubert" class="btn">Schubert</button>
          <button data-filter="Tchaikovsky" class="btn">Tchaikovsky</button>
        </div>
        <div>
          <p>Instruments</p>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Piano
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Accordion
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Violin
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Cello
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Trumpet
          </label>
          <label class="checkbox">
            <input type="checkbox" name="checkbox" />
            Flute
          </label>
        </div>
      </div>
      <div class="container" id="myUL">
        <div class="filterDiv Renaissance DiLasso">Di Lasso -Lagrime de San Pietro</div>
        <div class="filterDiv Renaissance">Sweelinck - Fantasie</div>
        <div class="filterDiv Classic">Haydn - The Seasons</div>
        <div class="filterDiv Romantic">Wagner - Parsifal</div>
        <div class="filterDiv Classic">Mozart - Requiem</div>
        <div class="filterDiv Barok Bach">Bach - Magnificat</div>
        <div class="filterDiv Classic">Beethoven - Symphony 5</div>
        <div class="filterDiv Barok">Händel - Hallelujah</div>
        <div class="filterDiv Barok Vivaldi">Vivaldi - The Four Seasons</div>
        <div class="filterDiv Renaissance">Obrecht - Factor Orbis</div>
        <div class="filterDiv Romantic Schubert">Schubert - Erlkönig</div>
        <div class="filterDiv Romantic Tchaikovsky">Tchaikovsky - Swan Lake</div>
        <div class="filterDiv Barok Vivaldi">Vivaldi - Rosmira</div>
        <div class="filterDiv Classic">Beethoven - Moonlight Sonata</div>
      </div>
      <div id="noResult" class="hidden">No results</div>
    </main>    
  <script src="scripts/script.js"></script>
  </body>
</html>
