# github-lastversion
PHP class/script to get the last version tag from a GitHub repository

## Use

<ul>
  <li>As a class:</li>
  <br>

```php
<?php

require 'github-lastversion.php';

try {

  echo GitHub::getLastRelaseVersion('vrana/adminer'); // example

} catch (Exception $e) {
  //TODO
}    
```
  <br>
  <li>As a script:</li>
  <br>
  Syntax: <code>php github-lastversion.php [githubuser]/[githubrepository]</code><br>
  <br>
  Example: <code>php github-lastversion.php vrana/adminer</code><br>
</ul>
