<?php
    function construct()
    {
        load_model("page");
        load('lib','upload-file');
        load('helper','page');
    };
    function indexAction(){
        global $config;
        $record_per_page=5;
        $total_record=db_num_rows("select `id` from `tbl_page`");
        $total_page=ceil($total_record/$record_per_page);
        if (isset($_GET['page']))
            $page=$_GET['page'];
        else
            $page=1;
        $start=($page-1)*$record_per_page;
        $list_page=db_fetch_array("select * from `tbl_page` limit $start,$record_per_page");
        $data=array(
            'list_page' => $list_page,
            'total_page' => $total_page,
            'config' => $config
        );
        load_view('index',$data);
    }
    function addAction(){
        global $error,$title,$success,$slug,$content;
        $error=array();
        if (isset($_POST['btn_add'])){
            $title=$_POST['title'];
            $slug=$_POST['slug'];
            $content=$_POST['desc'];
            
            if (empty($title))
                $error['title']='Tiêu đề không được để trống';

            if (!isset($_FILES['file']))
                $error['file']='Vui lòng chọn hình ảnh';

            if (empty($error)){
                $upload_dir='public/uploads/';
                $upload_file=$upload_dir.$_FILES['file']['name'];
                $data=array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'created_at' => time(),
                    'creator' => $_SESSION['username'],
                    'thumb' => $upload_file
                );
                
                if (add_page($data)>0 && move_uploaded_file($_FILES['file']['tmp_name'],$upload_file)){
                    $success="<b class='text-success'>Thêm trang thành công!</b>";
                }
                else 
                    $success="<b class='text-red'>Thêm trang thất bại!</b>";
            }else
                $success="<b class='text-red'>Thêm trang thất bại</b>";
        }
        load_view('add');
    }
    function paginationAjaxAction(){
        global $config;
        $num_page=$_POST['page'];
        $content='';
        $record_per_page=5;
        $start=($num_page-1)*$record_per_page;
        
        $list_page=db_fetch_array("select * from `tbl_page` limit $start,$record_per_page");
        $count=$start;
        foreach ($list_page as $page){
            $count++;
            if ($page['approved'])
                $status='Đã duyệt';
            else 
                $status='Chờ kiểm duyệt';
            $id=$page['id'];
            $content.='<tr>';
            $content.='<td><input type="checkbox" name="list_id['.$id.']" class="checkItem"></td>
            <td><span class="tbody-text">'.$count.'</h3></span>
            <td class="clearfix">
                <div class="tb-title fl-left">
                    <a href="'.$config['base_url'] .'?mod=page&id='.$id.'" title="">'.$page['title'].'</a>
                    </div>
                    <ul class="list-operation fl-right">
                        <li><a href="?mod=page&action=update&id='.$id.'" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                        <li><a href="?mod=page&action=delete&id='.$id.'" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void(0);" title="Duyệt" class="approve" onclick="approve('.$id.')"><i class="fa-solid fa-circle-check"></i></a></li>
                    </ul>
                </td>
                <td><span class="tbody-text">'.$_SESSION['username'].'</span></td>
                <td><span class="tbody-text">'.date('d/m/Y', $page['created_at']).'</span></td><td id="approve-status-'.$id.'">'.$status.'</td>';
            $content.='</tr>';
        }
        echo $content;
    }
    function deleteAction(){
        $id=$_GET['id'];
        db_delete('`tbl_page`',"`id` = $id");
        redirect('?mod=page');
    }
    function updateAction(){
        global $error,$success;
        $success='';
        $id=$_GET['id'];
        $info=db_fetch_row("select * from `tbl_page` where `id` = $id");
        $error=array();
        if (isset($_POST['btn_update'])){
            $info['title']=$_POST['title'];
            $info['slug']=$_POST['slug'];
            $info['content']=$_POST['desc'];
            
            if (empty($info['title']))
                $error['title']='Tiêu đề không được để trống';

            $upload_dir='public/uploads/';
            if (empty($_FILES['file']['tmp_name'])){
                $upload_file=$info['thumb'];
            }
            else{
                $upload_file=$upload_dir.$_FILES['file']['name'];
                if (empty($error) && !move_uploaded_file($_FILES['file']['tmp_name'],$upload_file)){
                   $error['file']='Upload file không thành công'; 
                }
            }

            if (empty($error)){
                
                $data=array(
                    'title' => $info['title'],
                    'slug' => $info['slug'],
                    'content' => $info['content'],
                    'thumb' => $upload_file
                );
                
                if (update_page($data,$id)>0){
                    $success="<b class='text-success'>Cập nhật trang thành công!</b>";
                }
                else 
                    $success="<b class='text-red'>Không trang nào được cập nhật!</b>";
            }else
                $success="<b class='text-red'>Cập nhật trang thất bại</b>";
        }
        $data['info']=$info;
        $data['success']=$success;
        load_view('update',$data);
    }
    function searchAction(){
        global $config;
        if (isset($_POST['btn_search'])){
            $key=$_POST['key'];
            $list_page=db_fetch_array("select * from `tbl_page` where `title` like '%$key%'");
            $record_per_page=5;
            $total_record=count($list_page);
            $total_page=ceil($total_record/$record_per_page);
            $data=array(
                'list_page' => $list_page,
                'total_page' => $total_page,
                'config' => $config
            );
        }
        load_view('index',$data);
    }
    function approvedPageAction(){
        global $config;
        $record_per_page=5;
        $total_record=db_num_rows("select `id` from `tbl_page` where `approved` = 1");
        $total_page=ceil($total_record/$record_per_page);
        
        $list_page=db_fetch_array("select * from `tbl_page` where `approved` = 1 limit 0,$record_per_page");
        $data=array(
            'list_page' => $list_page,
            'total_page' => $total_page,
            'config' => $config
        );
        load_view('index',$data);
    }
    function notApprovedPageAction(){
        global $config;
        $record_per_page=5;
        $total_record=db_num_rows("select `id` from `tbl_page` where `approved` = 0");
        $total_page=ceil($total_record/$record_per_page);
        
        $list_page=db_fetch_array("select * from `tbl_page` where `approved` = 0 limit 0,$record_per_page");
        $data=array(
            'list_page' => $list_page,
            'total_page' => $total_page,
            'config' => $config
        );
        load_view('index',$data);
    }
    function deletePagesAction(){
        if (isset($_POST['btn_delete_pages'])){
            $list_id=$_POST['list_id'];
            foreach ($list_id as $id=>$v){
                delete_page($id);
            }
        }
        redirect("?mod=page");
    }
    function approveAction(){
        $id=$_POST['id'];
        $num_approve=$_POST['numApproved'];
        $num_not_approve=$_POST['numNotApproved'];
        if (approve_page($id)){
            $data=array(
                'status' => 'Đã duyệt',
                'numApproved' => $num_approve+1,
                'numNotApproved' => $num_not_approve-1
            );
        }
        else{ 
            $data=array(
                'status' => '0',
            );
        }
        echo json_encode($data);
    }
    
