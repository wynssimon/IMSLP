<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/reset.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/main.css" />
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
      <input
        type="text"
        id="myInput"
        placeholder="Search for names.."
        title="Type in a name"
      />
      <div id="myBtnContainer">
        <button onclick="filterSelection('all')" class="btn active">
          Show All
        </button>
        <button onclick="filterSelection('Barok')" class="btn">Barok</button>
        <button onclick="filterSelection('Classic')" class="btn">
          Classic
        </button>
        <button onclick="filterSelection('Renaissance')" class="btn">
          Renaissance
        </button>
        <button onclick="filterSelection('Romantic')" class="btn">
          Romantic
        </button>
      </div>
      <div class="container" id="myUL">
        <div class="filterDiv Renaissance">Di Lasso</div>
        <div class="filterDiv Renaissance">Sweelinck</div>
        <div class="filterDiv Classic">Haydn</div>
        <div class="filterDiv Romantic">Wagner</div>
        <div class="filterDiv Classic">Mozart</div>
        <div class="filterDiv Barok">Bach</div>
        <div class="filterDiv Classic">Beethoven</div>
        <div class="filterDiv Barok">Händel</div>
        <div class="filterDiv Barok">Vivaldi</div>
        <div class="filterDiv Renaissance">Obrecht</div>
        <div class="filterDiv Romantic">Schubert</div>
        <div class="filterDiv Romantic">Tchaikovsky</div>
      </div>
    </main>
    <script src="script.js"></script>
  </body>
</html>
