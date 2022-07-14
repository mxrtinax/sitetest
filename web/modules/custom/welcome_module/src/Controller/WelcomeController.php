<?php

namespace Drupal\welcome_module\Controller;

use Drupal\comment\Entity\Comment;
use Drupal\image\Entity\ImageStyle;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use functional\Append;
use function Sodium\add;

class WelcomeController {

  public function welcome() {
    $rows = [];
    $row = [];
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'blog_post')
      //->condition('title', '%Some%', 'LIKE')
      ->execute();
    $nodes = Node::loadMultiple($nids);

    //echo count($nodes);
    $node_storage = \Drupal::entityTypeManager()->getStorage('comment');
    /** @var Comment $node */
    $node = $node_storage->load(1);
//
    foreach ($nids as $nid) {
      //$n = Node::load($nid);
//      /** @var \Drupal\taxonomy\Entity\Term $term */
//      $term_type = '';
//      $term_id = $n->get('field_blog_post_type')->target_id;
//      if ($term_id) {
//        $term = Term::load($term_id);
//        $term_type = $term->get('name')->value;
//
//      }
      echo $nid ." ";
      //echo $n->title->value;
//      echo $n->get('title')->value;
//      $row=[$n->get('title')->value,$n->get('body')->format, $term_type];
//      $rows[]=$row;
    }
    //echo count($rows);
//    $values = [
//      'type' => 'blog_post',
//    ];
//    $nodes = \Drupal::entityTypeManager()
//      ->getStorage('node')
//      ->loadByProperties($values);
//    foreach ($nodes as $node){
//      $rows.array_push($node->get('title')->value);
//      echo $node->get('title')->value;
//    }
    return [
      [
        '#type' => 'table',
        '#rows' => $rows,
      ]
    ];
  }
}
