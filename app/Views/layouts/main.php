<!DOCTYPE html>
<html>
<head>
    <title>Программа для  писателей | <?= $this->renderSection('title') ?></title> 
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<nav>

    <header>
      <span></span>
      John Doe
      <a></a>
    </header>
  
    <ul>
      <li>Navigation</li>
      <li><a class="active">Dashboard</a></li>
      <li><a>Statistics</a></li>
      <li><a>Milestones</a></li>
      <li><a>Tickets</a></li>
      <li><a>GitHub</a></li>
      <li><a>FAQ</a></li>
      <li><a>Settings</a></li>
    </ul>
  
  </nav>
  
  <main>
  
    <h1><?= $this->renderSection('title') ?></h1>
  
    <?=$this->renderSection('content') ?>
  
  </main>
  <script src="/js/main.js"></script>
  </body>
  </html>