<?php 
	/**
	*-------------------------------------------------------------------------*
	* 
	* Helpers pagging
	*
	* 処理概要/process overview  :
	* 作成日/create date         :   2022/04/21
	* 作成者/creater             :   Namnth – namnth@ans-asia.com
	*
	* @package                  :   MASTER
	* @copyright                :   Copyright (c) ANS-ASIA
	* @version                  :   1.0.0
	*/
namespace App\Utill;

class Pagingate 
{
    /**
	* show pagging for list
	* -----------------------------------------------
	* @author      :   Namnth – namnth@ans-asia.com
	* @param       :   null
	* @return      :   null
	* @see         :   remark
	*/
	public static function Pagingate($data = []){
        $paging  = '';
        // dd($data);
        if (isset($data) && !empty($data) && $data['totalRecord'] > 0) {
            $paging  = '<div class="row col-md-12 dataTables_paginate paging_full_numbers" id="datatable_flextime_paginate">';
            $pageSize       = $data['pagesize'] ?? 10;
            $totalRecord    = $data['totalRecord'] ?? 0;
            $offset         = $data['offset'] ?? 0;
            $page           = $data['page'] ?? 0;
            $pageMax        = $data['pageMax'] ?? 0;
            $pagePrevious2  = ($page <= 2)? '': $page - 2;
            $pagePrevious  	= ($page <= 1)? '': $page - 1;
            $pagenext  		= ($pageMax <= $page)? '': $page + 1;
            $pagenext2  	= ($pageMax <= $page + 1)? '': $page + 2;
            $paging .= '<a class="paginate_button first" aria-controls="datatable_flextime" data-dt-idx="0" tabindex="7" id="datatable_flextime_first" page="1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>';
            if($page > 1){
                $paging .= '<a class="paginate_button previous" aria-controls="datatable_flextime" data-dt-idx="1" tabindex="8" id="datatable_flextime_previous" page="'.($page-1).'"><i class="fa fa-angle-left"></i></a>';
            }
            if ( ($page == $pageMax) && ($pagePrevious2 !='')) {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagePrevious2.'">' . $pagePrevious2 . '</a>';
            }
            if ( $pagePrevious!= '') {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagePrevious.'">' . $pagePrevious . '</a>';
            }
            $paging .= '<a class="paginate_button active" aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$page.'">' . $page . '</a>';
            if ($pagenext != '') {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagenext.'">' . $pagenext . '</a>';
            }
            if ( ($pagePrevious == '') && ($pagenext2 != '')) {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagenext2.'">' . $pagenext2 . '</a>';
            }
            if($page < $pageMax){
                $paging .= '<a class="paginate_button next" aria-controls="datatable_flextime" data-dt-idx="7" tabindex="14" id="datatable_flextime_next" page="'.($page+1) .'"><i class="fa fa-angle-right"></i></a>';
            }
            $paging .= '<a class="paginate_button last" aria-controls="datatable_flextime" data-dt-idx="8" tabindex="15" id="datatable_flextime_last" page="'.$pageMax.'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
            $paging  .='</div>';
        }
        return $paging;
    }
     /**
	* show pagging for list
	* -----------------------------------------------
	* @author      :   Namnth – namnth@ans-asia.com
	* @param       :   null
	* @return      :   null
	* @see         :   remark
	*/
	public static function PagingateSelectBox($data = []){
        $paging  = '';
        if (isset($data) && !empty($data) && $data['totalRecord'] > 0) {
            $paging  = '<div class="col-md-8 dataTables_paginate paging_full_numbers" id="datatable_flextime_paginate">';
            $pageSize       = $data['pagesize'] ?? 10;
            $totalRecord    = $data['totalRecord'] ?? 0;
            $offset         = $data['offset'] ?? 0;
            $page           = $data['page'] ?? 0;
            $pageMax        = $data['pageMax'] ?? 0;
            $pagePrevious2  = ($page <= 2)? '': $page - 2;
            $pagePrevious  	= ($page <= 1)? '': $page - 1;
            $pagenext  		= ($pageMax <= $page)? '': $page + 1;
            $pagenext2  	= ($pageMax <= $page + 1)? '': $page + 2;
            $paging .= '<a class="paginate_button first" aria-controls="datatable_flextime" data-dt-idx="0" tabindex="7" id="datatable_flextime_first" page="1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>';
            if($page > 1){
                $paging .= '<a class="paginate_button previous" aria-controls="datatable_flextime" data-dt-idx="1" tabindex="8" id="datatable_flextime_previous" page="'.($page-1).'"><i class="fa-solid fa-angle-left"></i></a>';
            }
            if ( ($page == $pageMax) && ($pagePrevious2 !='')) {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagePrevious2.'">' . $pagePrevious2 . '</a>';
            }
            if ( $pagePrevious!= '') {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagePrevious.'">' . $pagePrevious . '</a>';
            }
            $paging .= '<a class="paginate_button active" aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$page.'">' . $page . '</a>';
            if ($pagenext != '') {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagenext.'">' . $pagenext . '</a>';
            }
            if ( ($pagePrevious == '') && ($pagenext2 != '')) {
                $paging .= '<a class="paginate_button " aria-controls="datatable_flextime" data-dt-idx="2" tabindex="9" page="'.$pagenext2.'">' . $pagenext2 . '</a>';
            }
            if($page < $pageMax){
                $paging .= '<a class="paginate_button next" aria-controls="datatable_flextime" data-dt-idx="7" tabindex="14" id="datatable_flextime_next" page="'.($page+1) .'"><i class="fa fa-angle-right"></i></a>';
            }
            $paging .= '<a class="paginate_button last" aria-controls="datatable_flextime" data-dt-idx="8" tabindex="15" id="datatable_flextime_last" page="'.$pageMax.'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
            $paging  .='</div>';
            $paging  .=    '<div class="select_pagging">';
            $paging  .=        '<select id="cb_page" class="form-control page_size">';
            $paging  .=             '<option value="10" '.($pageSize == 10 ? 'selected':'').'>10</option>';
            $paging  .=             '<option value="20" '.($pageSize == 20 ? 'selected':'').'>20</option>';
            $paging  .=             '<option value="50" '.($pageSize == 50 ? 'selected':'').'>50</option>';
            $paging  .=         '</select>';
            $paging  .=     '</div>';
            $paging  .='<div>';
            $paging  .='<div clas="col-md-3">';
            if($page*$pageSize > $totalRecord){
                $paging  .=    '<label class="label_info">hiển thị: từ '.$offset.' đến '.$totalRecord.' trên '.$totalRecord.'</label>';
            }
            else{
                $paging  .=    '<label class="label_info">hiển thị: từ '.$offset.' đến '.$page*$pageSize.' trên '.$totalRecord.'</label>';
            }
            $paging  .='</div>';
		}
        return $paging;
    }
}