<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Category;
use Source\Models\Log;

try {
    $idCategory = filter_var(filter_input(INPUT_POST, "idCategory"), FILTER_SANITIZE_NUMBER_INT);

    $category = (new Category())->getCategoryById($idCategory);

    //Generating request log    
    $log = (new Log())->saveAction("Get Category");


    echo json_encode([
        'success' => true,
        'category' => $category->data()
    ]);

    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);

    exit;
}
