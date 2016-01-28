<?php 

class MenuHelper {
    
    public $echoed = array();
    public $level = 0;

    public function echoMenu($items){
        foreach ($items as $key => $item) {
            if(!array_key_exists($item->id, $this->echoed)){
                $this->countLevel($item);
                $this->echoed[$item->id] = $this->level; 
                echo '<tr><td>';
                for($i = 0; $i < $this->echoed[$item->id]; $i ++){ echo "--"; }
                echo " ".$item->id.'</td>
                    <td>'.__(dots($item->title, 90)).'</td>
                    <td><a class="btn btn-primary" href="'._l(URL::action('MenuController@getItemEdit').'/'.$item->id).'">'.__(Lang::get('admin.edit')).'</a></td>
                    <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="'.URL::action('MenuController@getItemDestroy').'/'.$item->id.'">'.__(Lang::get('admin.delete')).'</a></td>
                </tr>';
            }
            if($item->children()->count() > 0){                
                $this->echoMenu($item->children);
            }

        }
    }

    public function countLevel($item, $level = 0){
        $this->level = $level;
        if($item->parent_id  != null){
            $this->level ++;
            $this->countLevel($item->parent, $this->level);
        }

    }
}