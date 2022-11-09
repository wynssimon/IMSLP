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
          <p class="titeltje">Period</p>
          <button data-filter="Barok" class="btn">Barok</button>
          <button data-filter="Classic" class="btn">Classic</button>
          <button data-filter="Renaissance" class="btn">Renaissance</button>
          <button data-filter="Romantic" class="btn">Romantic</button>
        </div>
        <div id="myBtnContainer">
          <p class="titeltje">Composer</p>
          <button data-filter="DiLasso" class="btn">De Lassus</button>
          <button data-filter="Bach" class="btn">Bach</button>
          <button data-filter="Vivaldi" class="btn">Vivaldi</button>
          <button data-filter="Schubert" class="btn">Schubert</button>
          <button data-filter="Tchaikovsky" class="btn">Tchaikovsky</button>
        </div>
        <div>
          <p class="titeltje">Instruments</p>
          <label class="checkbox">
            <input class="check" data-filter="piano" type="checkbox" name="checkbox" />
            Piano
          </label>
          <label class="checkbox">
            <input class="check" data-filter="accordion" type="checkbox" name="checkbox" />
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
        <div class="filterDiv Renaissance DiLasso accordion">
          <div class="titel">
            <h2>Di Lasso -Lagrime de San Pietro</h2>
          </div>
          <div class="genre">
            <h3>Genre</h3>
            <p>Renaissance</p>
          </div>
          <div class="instruments">
            <h3>Instruments</h3>
            <p>2 accordion</p>
          </div>
          <div class="arrangement">
            <h3>Arrangement</h3>
            <p>Original song</p>
          </div>
          <div class="difficulty">
            <h3>Difficulty</h3>
            <p>...</p>
          </div>
          <div class="naarsheet">
            <a href="./pages/sheet.php"><button>Naar sheet</button></a>
          </div>
          <div class="sheet">
            <img src="./img/scottish.png" alt="">
          </div>
        </div>
        <div class="filterDiv Renaissance piano">
          <div class="titel">
            <h2>Sweelinck - Fantasie</h2>
          </div>
          <div class="genre">
            <h3>Genre</h3>
            <p>Renaissance</p>
          </div>
          <div class="instruments">
            <h3>Instruments</h3>
            <p>2 accordion</p>
          </div>
          <div class="arrangement">
            <h3>Arrangement</h3>
            <p>Original song</p>
          </div>
          <div class="difficulty">
            <h3>Difficulty</h3>
            <p>...</p>
          </div>
          <div class="naarsheet">
            <button>Naar sheet</button>
          </div>
          <div class="sheet">
            <img src="./img/scottish.png" alt="">
          </div>
        </div>
        <div class="filterDiv Classic">
          <p>Haydn - The Seasons</p>
        </div>
        <div class="filterDiv Romantic">
          <p>Wagner - Parsifal</p>
        </div>
        <div class="filterDiv Classic">
          <p>Mozart - Requiem</p>
        </div>
        <div class="filterDiv Barok Bach">
          <p>Bach - Magnificat</p>
        </div>
        <div class="filterDiv Classic">
          <p>Beethoven - Symphony 5</p>
        </div>
        <div class="filterDiv Barok">
          <p>Händel - Hallelujah</p>
        </div>
        <div class="filterDiv Barok Vivaldi">
          <p>Vivaldi - The Four Seasons</p>
        </div>
        <div class="filterDiv Renaissance">
          <p>Obrecht - Factor Orbis</p>
        </div>
        <div class="filterDiv Romantic Schubert">
          <p>Schubert - Erlkönig</p>
        </div>
        <div class="filterDiv Romantic Tchaikovsky">
          <p>Tchaikovsky - Swan Lake</p>
        </div>
        <div class="filterDiv Barok Vivaldi">
          <p>Vivaldi - Rosmira</p>
        </div>
        <div class="filterDiv Classic">
          <p>Beethoven - Moonlight Sonata</p>
        </div>
      </div>
      <div id="noResult" class="hidden">No results</div>
    </main>    
  <script src="scripts/script.js"></script>
  </body>
</html>
