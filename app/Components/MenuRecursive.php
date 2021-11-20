<?php

namespace App\Components;

use App\Menu;

class MenuRecursive
{
    // php menu recursion
    private $html;

    public function __construct(){
        $this->html = '';
    }

    // B1 : Lây ra danh sách menu có parent_id = 0 ; menu 1 , menu 2, menu 3
    public function menuRecursion($parent_id = 0, $text = ''){
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            $this->menuRecursion($dataItem->id, $text . '--');
        }
        return $this->html;
    }

    public function menuRecursionEdit($parent_id_menu_edit, $parent_id = 0, $text = ''){
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            if($parent_id_menu_edit == $dataItem->id){
                $this->html .= '<option selected value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            }else{
                $this->html .= '<option value="' . $dataItem->id . '">' . $text . $dataItem->name . '</option>';
            }
            $this->menuRecursionEdit($parent_id_menu_edit,$dataItem->id, $text . '--');
        }
        return $this->html;
    }


}