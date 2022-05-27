<?php
define('PAGINATION_COUNT' , 10);

function getFolder(){
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

function changeStatus($category){
    return $category->is_active == 1 ? "الغاء التفعيل":"تفعيل";
}
// function getCategoryId($category , $subCategory ){
//     if($category->parent_id == null){
//         return $category->id;
//     }elseif($category->parent_id !== null){
//         return $subCategory->id;
//     }
// }
function lacaleLanguage(){
    return app()->getLocale();
}
function uploadImage($folder , $image){
    $image->store('/' , $folder);
    $fileName = $image->hashName();
    $path = 'images/'.$folder.'/'.$fileName;
    return $path;
}
function removeWhiteSpace($string){
    return strtolower(str_replace(" " , "-" , $string));
}

function removeHifen($string){
    return strtolower(str_replace("-" , " " , $string));
}
