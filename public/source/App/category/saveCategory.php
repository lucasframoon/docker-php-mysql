<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Category;
use Source\Models\Log;

try {

    $idCategory = filter_var(filter_input(INPUT_POST, "id_category"), FILTER_SANITIZE_NUMBER_INT);
    $nmCategory = filter_var(filter_input(INPUT_POST, "nm_category"));

    $category = new Category();
    $responseCategory = false;
    $isUpdate = false;

    if ($idCategory != "") {

        $category = (new Category())->findById($idCategory);
        $isUpdate = true;
    }

    //Generating request log
    $log = new Log();
    $log->ds_action = "Save Category";
    $log->save();

    if ($nmCategory == "") {
        echo json_encode([
            'success' => false,
            'error' => 'invalid_param',
            'message' => 'Invalid name'
        ]);
        exit;
    } else {
        $category->nm_category = $nmCategory;
    }

    $responseCategory = $category->save();
    // print_r([$responseCategory, '---', $category->id_category]);
    // exit;


    echo json_encode([
        'success' => true,
        'idCategory' => $category->id_category,
        'responseCategory' => $responseCategory,
    ]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
