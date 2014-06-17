<?php

/**
 * EColumnListView class file.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 * @copyright Copyright &copy; 2012 Tasos Bekos
 */
/**
 * EColumnListView represents a list view in multiple columns.
 *
 * @author Tasos Bekos <tbekos@gmail.com>
 */
Yii::import('zii.widgets.CListView');

class HeaderListView extends CListView {

    /**
     *
     * @var mixed integer the number of columns
     */
   public $header;
    /**
     * Renders the data item list.
     */
    public function renderItems()
    {
        echo CHtml::openTag($this->itemsTagName)."\n";
        $data=$this->dataProvider->getData();
        if(($n=count($data))>0)
        {
            $owner=$this->getOwner();
            $viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach($data as $i=>$item)
            {   
                
                $date= date('l, d F Y', strtotime($item->creado));
                $sendHeader=null;
                if ($date!=$this->header):
                    $this->header = $date;
                    $sendHeader=$date;
                          
                endif;
                $data=$this->viewData;
                $data['header']=$sendHeader;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;
                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1)
                    echo $this->separator;
            }
        }
        else
            $this->renderEmptyText();
        echo CHtml::closeTag($this->itemsTagName);
    }

}

?>