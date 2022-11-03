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
  </nav>
</header>
<main>
  <input type="text" id="myInput" placeholder="Search for names.." title="Type in a name" />
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
  </div>
  <div class="container" id="myUL">
    <div class="filterDiv Renaissance DiLasso">Lagrime de San Pietro</div>
    <div class="filterDiv Renaissance">Sweelinck</div>
    <div class="filterDiv Classic">Haydn</div>
    <div class="filterDiv Romantic">Wagner</div>
    <div class="filterDiv Classic">Mozart</div>
    <div class="filterDiv Barok Bach">Bach</div>
    <div class="filterDiv Classic">Beethoven</div>
    <div class="filterDiv Barok">Händel</div>
    <div class="filterDiv Barok Vivaldi">Vivaldi</div>
    <div class="filterDiv Renaissance">Obrecht</div>
    <div class="filterDiv Romantic Schubert">Schubert</div>
    <div class="filterDiv Romantic Tchaikovsky">Tchaikovsky</div>
  </div>
</main>    <script src="scripts/script.js"></script>
  </body>
</html>
