<?php
require_once('./server/services/TaskService.php');

$service = new TaskService();
$tasks = $service->get_all();

$_COOKIE['error'] = 'banana'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" type="text/css" href="./assets/style.css">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/imgs/icon.png">
  <script>
    function check(event) {
      const input = document.querySelector("input[name='done']");
      const img = event.target;
      const li = img.parentElement.parentElement; // button -> li

      for (const element of [img, li]) {
        element.classList.toggle("checked");
      }

      input.value = input.value === "1" ? "0" : "1";
    }

    function edit(taskId, task) {
      const [input, inputId] = [
        document.getElementById("input-box"),
        document.querySelector(`input[name="id"]`)
      ];
      const button = document.getElementById("annotate");

      inputId.value = taskId;
      input.attributes.placeholder.value = `Editing: ${task}`;
      input.focus();

      button.innerText = "Edit";
      button.attributes.formaction.value = "./server/operations/Edit.php";
    }
  </script>
</head>

<body>
  <div class="container">
    <div class="todo-app">
      <!-- Error-->
      <?php if (isset($_COOKIE['error'])): ?>
        <div class="error-card">
          <div class="error-icon">!</div>
          <div class="error-message">
            <strong>Error: </strong><?= $_COOKIE['error'] ?>
          </div>
        </div>
      <?php endif; ?>


      <!-- App -->
      <h2>ToDo List <img src="./assets/imgs/icon.png"></h2>
      <form method="post" class="row">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="done" value="">
        <input type="text" name="task" id="input-box" placeholder="Add your text">

        <button id="annotate" type="submit" formaction="./server/operations/Add.php">Add</button>
      </form>

      <!-- Tasks -->
      <ul id="list-container">
        <?php foreach ($tasks as $task): ?>
          <?php
          $check = '';
          if ($task['done']) {
            $check = 'checked';
          }
          ?>


          <form method="post">
            <li class="<?= $check ?>">
              <button type="submit" formaction="./server/operations/Check.php">
                <img onclick="check(event)" class="<?= $check ?>">
              </button>

              <p><?= $task['description'] ?></p>
              <input type="hidden" name="id" value="<?= $task['id'] ?>">

              <button type="button" onclick="edit('<?= $task['id'] ?>', '<?= $task['description'] ?>')">
                <span>&#x270E</span>
              </button>

              <button type="submit" formaction="./server/operations/Delete.php">
                <span>&#x00D7</span>
              </button>
            </li>
          </form>
        <?php endforeach; ?>

      </ul>
    </div>
  </div>
</body>

</html>