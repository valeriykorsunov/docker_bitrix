<?php
$arUrlRewrite=array (
  3 => 
  array (
    'CONDITION' => '#^/account/tests/([0-9a-zA-Z-]+)/.*#',
    'RULE' => 'testID=$1',
    'ID' => 'bulldog:test',
    'PATH' => '/account/tests/test.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/about-project/([a-z-0-9_]+)/.*#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/about-project/service.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/executors/([0-9a-zA-Z-]+)/.*#',
    'RULE' => 'ID_EXECUTOR=$1',
    'ID' => '',
    'PATH' => '/executors/executor.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/articles/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/articles/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/service/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/service/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/test3/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test3/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:main.register',
    'PATH' => '/login/index.php',
    'SORT' => 100,
  ),
);
