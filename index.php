<?php

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
        <!-- <li class="checked">Task 1</li>
        <li>Task 2</li>
        <li>Task 3</li> -->
      </ul>
    </div>
  </div>
</body>

</html>