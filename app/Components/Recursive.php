<?php

namespace App\Components;

class Recursive {

    private $data;
    private $htmlSelect = '';

    public function __construct($data) {
        $this->data = $data;
    }

    // step đệ quy
        // foreach($data as $value){
        //     if($value['parent_id'] == 0){
        //         echo "<option>". $value['name'] . "</option>";
        //         foreach($data as $value2){
        //             if($value2['parent_id'] == $value['id']){
        //                 echo "<option>". $value2['name'] . "</option>";
        //             }
        //         }
        //     }
        // }

    function categoryRecursive($id = 0, $text = ''){
        foreach($this->data as $value){
            if($value['parent_id'] == $id){
                $this->htmlSelect .= "<option value='". $value['id']. "'>". $text. $value['name'] . "</option>";
                $this->categoryRecursive($value['id'], $text . '--');
            }
        }

        return $this->htmlSelect;
    }

}