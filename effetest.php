<button onclick="toggleGrid()">Toggle Grid</button>
<button onclick="toggleList()">Toggle List</button>

<style>
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    background-color:red;
  }

  .list {
    display: list-item;
    grid-template-rows: 1fr 1fr 1fr;
    background-color:blue;
  }
</style>

<div id="container">
    <div>Item 1</div>
    <div>Item 2</div>
    <div>Item 3</div>
</div>

<script>
  function toggleGrid() {
    var container = document.getElementById('container');
    container.classList.toggle('grid');
    container.classList.remove('list');

  }

  function toggleList() {
    var container = document.getElementById('container');
    container.classList.toggle('list');
    container.classList.remove('grid');
  }
</script>
