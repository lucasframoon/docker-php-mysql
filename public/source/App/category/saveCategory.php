<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Category;

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


    if ($nmCategory == "") {
        echo json_encode([
            'success' => false,
            'message' => 'Nome inválido'
        ]);
        exit;
    } else {
        $category->nm_category = $nmCategory;
    }

    if ($nmCategory != "") {
        $category->nm_category = $qtCategory;
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
