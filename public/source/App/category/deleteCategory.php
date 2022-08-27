<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Category;
use Source\Models\Log;

try {
    $idCategory = filter_var(filter_input(INPUT_POST, "idCategory"), FILTER_SANITIZE_NUMBER_INT);

    $category = (new Category())->getCategoryById($idCategory);
    $result = $category->destroy();

    //Generating request log  
    $log = (new Log())->saveAction("Delete Category");

    echo json_encode(['success' => true, 'result' => $result]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
