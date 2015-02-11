<?php
/**
 * @project LaVidaCubana
 * @author Jan Kotrba <jan.kotrbaa@gmail.com>
 * @date 11. 2. 2015, 1:53
 */
// Example: ['icon' => 'notes', 'actions' => ['Přidat článek|circle_plus' => 'add','Seznam článků|list' => 'list']]
$moduleActionArray = ['icon' => 'tags', 'items' => [
    'Přidat novou aktualitu|circle_plus' => 'addPost',
    'Seznam aktualit|notes_2' => 'allPosts',
    'Nastavení|settings' => 'config',
]];


print json_encode($moduleActionArray);