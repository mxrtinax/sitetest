<?php


use Drupal\node\Entity\Node;
function getName($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}



//var_dump($node->getTitle());
/*
$nids = \Drupal::entityQuery('node')
  ->condition('type', 'blog_post')
  ->condition('title', 'Some news')
  ->execute();
$nodes = Node::loadMultiple($nids);
foreach ($nodes as $node) {
  echo $node->getTitle();
  $node->set('title',getName(10));
  $node->save();
}*/

Node::create([
  'uid' => 10,
  'title' => "Create a blog post programmatically",
  'status' => 1,
  'type' => 'blog_post',
  'body' => [
    'value' => 'Instructions for creating a blog post programmatically',
    'format' => 'full_html'
  ],
  'path' => [
    'alias' => '/blog-prom',
//    'pathauto' => PathautoState::SKIP,
  ],
])->save();
