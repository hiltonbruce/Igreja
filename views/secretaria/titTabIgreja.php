<?php
  if ($_GET["id"]>0) {
    echo ' - Igreja: '.$arrayIg[$_GET["id"]]['0'];
  } elseif (isset($_GET['ig']) && $_GET['ig']==='0') {
    echo ' - Sem igreja definida';
  }
?>
