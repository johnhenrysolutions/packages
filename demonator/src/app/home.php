<html>
<head>
  <meta charset="UTF-8">
  <title>Demonator</title>

  <script src="backend.js"></script>
  

  <script src="node_modules/monaco-editor/min/vs/loader.js"></script>
  <script>
    require.config({ paths: { vs: 'node_modules/monaco-editor/min/vs' } });
  </script>

  <link rel="stylesheet" href="styles.css">

  <!-- Semantic UI CSS -->
  <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">

  <!-- jQuery (required) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Semantic UI JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>

  <script src="ui.js"></script>

</head>
<body>

 <div class="ui container top">

    <h2 class="ui header">DEMONATOR</h2>
    <h5 class="ui header zero-margin">The tool for fast demo application configuration</h5>

    <div class="ui top attached tabular menu">

      <?php 
        $counter = 0; foreach($apps as $app): 
        $tab_classes = ($counter == $_GET['app']) ? 'active ' : '';
      ?>

        <a class="<?=$tab_classes?>item" href="?app=<?=$counter?>">
          <?=$app['title']?>
        </a>

      <?php 
        ++$counter; 
        endforeach; 
      ?>
      
    </div>

    <div class="ui bottom attached active tab segment">
      <?php
        $app_index = $_GET['app'];
        $app = $apps[$app_index];

        include '../app/app.php'; 
      ?>
    </div>

  </div>

</body>

</html>