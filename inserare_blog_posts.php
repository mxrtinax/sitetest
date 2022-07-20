<?php

use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
//Title,Description,image,Blog post type
$row = 1;
/**
 * Delete all taxonomy terms from a vocabulary
 * @param $vid
 */
function delete_terms_from_vocab($vid) {
  $tids = Drupal::entityQuery('taxonomy_term')
    ->condition('vid', $vid)
    ->execute();
  if (empty($tids)) {
    return;
  }
  $term_storage = \Drupal::entityTypeManager()
    ->getStorage('taxonomy_term');
  $entities = $term_storage->loadMultiple($tids);
  $term_storage->delete($entities);
}

if (($handle = fopen(DRUPAL_ROOT . "/../input.csv", "r")) !== FALSE) {
  //delete_terms_from_vocab('types');
  $data = fgetcsv($handle, 1000, ",");
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { //parcurgem fiecare linie din csv
    $terms = []; //salvam termenii pe care ii are blogpostul de pe linia curenta
    $file = NULL;
    for($i = 3;$i<sizeof($data);$i++){ //pentru fiecare blog_post_type din linie
      if (!empty($data[$i])){
      $vids = \Drupal::entityQuery('taxonomy_term') //verificam daca termenul exista deja in vocabular
        ->condition('vid', 'types')
        ->condition('name', $data[$i])
        ->execute();
      if (!empty($vids)) {  //daca exista, incarcam termenul in $term
        $id = reset($vids);
        $term = Term::load($id);
      }
      else { //daca nu exista, cream un term nou
        $term = Term::create([
        'vid' => 'types',
        'name' => $data[$i],
          'field_counter' => [1]
      ]);
        $term->save();
        }
      array_push($terms,$term);
      }
    }
    if (empty($terms[0])){
      echo "empty ";
    }
    if (!empty($data[2])) {
      $uri = 'public://'.$data[0];
      $type = explode('.',$data[2])[1];
      copy(DRUPAL_ROOT .'/..//'.$data[2],$uri.'.'.$type);

      $file = File::create([
        'uri' => $uri.'.'.$type,
      ]);
      $file->save();
      $file = [
        'target_id' => $file->id(),
        'alt' => $data[0],
        'title' => $data[0]
      ];
      }
    $node = Node::create([
      'type'        => 'blog_post',
      'title'       => $data[0],
      'body'        => $data[1],
      'field_blog_post_type' => $terms,
      'field_image' => $file
    ]);
    $node->save();
  }
  }
  fclose($handle);
?>
