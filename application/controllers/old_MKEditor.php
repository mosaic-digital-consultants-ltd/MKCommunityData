<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKEditor extends CI_Controller {

    public function index()
    {
        $this->load->model('themes_model');
        $this->load->model('keywords_model');

        $headerInfo = array();
        $headerInfo['title'] = "Theme Editor";
        $data=array();

        $data['themes'] =  $this->themes_model->get_all_themes()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_all_keywords_by_theme()->result();

        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles');
        $this->load->view('dataeditor', $data);
        $this->load->view('common/footer');
    }


    public function keywords()
    {
        $this->load->model('themes_model');
        $this->load->model('keywords_model');

        $headerInfo = array();
        $headerInfo['title'] = "Keywords Editor";

        $data=array();

        $data['themes'] =  $this->themes_model->get_all_themes()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_all_keywords_by_theme()->result();


        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles');
        $this->load->view('datakeywordeditor', $data);
        $this->load->view('common/footer');
    }

    public function organisations()
    {
        $this->load->model('orgs_model');
        $headerInfo = array();
        $headerInfo['title'] = "Organisations Editor";
        $data=array();

        $data['organisations'] =  $this->orgs_model->get_organisations()->result();

        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles');
        $this->load->view('dataorgeditor', $data);
        $this->load->view('common/footer');
    }


    public function locations()
    {
        $this->load->model('locations_model');

        $headerInfo = array();
        $headerInfo['title'] = "Locations Editor";
        $data=array();

        $data['locations'] =  $this->locations_model->get_all_location_details()->result();
        $data['parishes'] =  $this->locations_model->get_parishes()->result();

        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles');
        $this->load->view('dataloceditor', $data);
        $this->load->view('common/footer');
    }


    public function themes_edit(){

        $this->load->model('themes_model');


        //define index of column
        $columns = array(
            0 =>'name',
            1 => 'is_active'
        );
        $error = false;
        $colVal = '';
        $colIndex = $rowId = 0;

        $msg = array('status' => !$error, 'msg' => 'Failed! updating database');

        if(isset($_POST)){
            if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
                $colVal = $_POST['val'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['index']) && $_POST['index'] >= 0 &&  !$error) {
                $colIndex = $_POST['index'];
                $error = false;
            } else {
                $error = true;
            }
            if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
                $rowId = $_POST['id'];
                $error = false;
            } else {
                $error = true;
            }

            if(!$error) {

                //$status =  $this->themes_model->update_theme_field($columns[$colIndex], $colVal, $rowId )->result();
                //$status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

                $sql = "UPDATE themes SET " . $columns[$colIndex] ." = ? WHERE id = ? ";
                $status =  $this->db->query($sql, array($colVal, $rowId));
                $msg = array('status' => !$error, 'msg' => 'Success! Field \''.$columns[$colIndex].'\' updated with the value \'' . $colVal.'\' ');
            }
        }

        // send data as json format
        echo json_encode($msg);
    }

    public function keywords_edit(){
        //define index of column
        $columns = array(
            0 =>'name',
            1 => 'is_active'
        );
        $error = false;
        $colVal = '';
        $colIndex = $rowId = 0;

        $msg = array('status' => !$error, 'msg' => 'Failed! updating database');

        if(isset($_POST)){
            if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
                $colVal = $_POST['val'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['index']) && $_POST['index'] >= 0 &&  !$error) {
                $colIndex = $_POST['index'];
                $error = false;
            } else {
                $error = true;
            }
            if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
                $rowId = $_POST['id'];
                $error = false;
            } else {
                $error = true;
            }

            if(!$error) {

                //$status =  $this->themes_model->update_theme_field($columns[$colIndex], $colVal, $rowId )->result();
                //$status = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

                $sql = "UPDATE keywords SET " . $columns[$colIndex] ." = ? WHERE id = ? ";
                $status =  $this->db->query($sql, array($colVal, $rowId));
                $msg = array('status' => !$error, 'msg' => 'Success! Field \''.$columns[$colIndex].'\' updated with the value \'' . $colVal.'\' ');
            }
        }
        // send data as json format
        echo json_encode($msg);
    }

    public function orgs_edit(){
        //define index of column
        $columns = array(
            0 =>'name',
            1 => 'external_id'
        );
        $error = false;
        $colVal = '';
        $colIndex = $rowId = 0;

        $msg = array('status' => !$error, 'msg' => 'Failed! updating database');

        if(isset($_POST)){
            if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
                $colVal = $_POST['val'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['index']) && $_POST['index'] >= 0 &&  !$error) {
                $colIndex = $_POST['index'];
                $error = false;
            } else {
                $error = true;
            }
            if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
                $rowId = $_POST['id'];
                $error = false;
            } else {
                $error = true;
            }

            if(!$error) {

                $sql = "UPDATE organisations SET " . $columns[$colIndex] ." = ? WHERE id = ? ";
                $status =  $this->db->query($sql, array($colVal, $rowId));
                $msg = array('status' => !$error, 'msg' => 'Success! Field \''.$columns[$colIndex].'\' updated with the value \'' . $colVal.'\' ');
            }
        }
        // send data as json format
        echo json_encode($msg);
    }

    public function locations_edit(){
        //define index of column
        $columns = array(
            0 =>'location',
            1 => 'parish_id'
        );
        $error = false;
        $colVal = '';
        $colIndex = $rowId = 0;

        $msg = array('status' => !$error, 'msg' => 'Failed! updating database');

        if(isset($_POST)){
            if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
                $colVal = $_POST['val'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['index']) && $_POST['index'] >= 0 &&  !$error) {
                $colIndex = $_POST['index'];
                $error = false;
            } else {
                $error = true;
            }
            if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
                $rowId = $_POST['id'];
                $error = false;
            } else {
                $error = true;
            }

            if(!$error) {

                $sql = "UPDATE locations SET " . $columns[$colIndex] ." = ? WHERE id = ? ";
                $status =  $this->db->query($sql, array($colVal, $rowId));
                $msg = array('status' => !$error, 'msg' => 'Success! Field \''.$columns[$colIndex].'\' updated with the value \'' . $colVal.'\' ');
            }
        }
        // send data as json format
        echo json_encode($msg);
    }


    public function keywords_map(){
        //define index of column
        $columns = array(
            0 =>'name',
            1 => 'is_active'
        );
        $error = false;
        $colVal = '';
        $colIndex = $rowId = 0;

        $msg = array('status' => !$error, 'msg' => 'Failed! updating database');

        if(isset($_POST)){
//            if(isset($_POST['val']) && !empty($_POST['val']) && !$error) {
//                $colVal = $_POST['val'];
//                $error = false;
//
//            } else {
//                $error = true;
//            }
            if(isset($_POST['index']) && $_POST['index'] >= 0 &&  !$error) {
                $colIndex = $_POST['index'];
                $error = false;
            } else {
                $error = true;
            }
            if(isset($_POST['id']) && $_POST['id'] > 0 && !$error) {
                $rowId = $_POST['id'];
                $error = false;
            } else {
                $error = true;
            }

            if(!$error) {

                $sql = "UPDATE theme_keyword_map SET theme_id = ? WHERE keyword_id = ? ";
                $status =  $this->db->query($sql, array($rowId, $colIndex));
                $msg = array('status' => !$error, 'msg' => 'Success! Theme updated with theme \''.$rowId.'\' for keyword \'' . $colIndex.'\' ');
            }
        }
        // send data as json format
        echo json_encode($msg);
    }


    public function themes_new(){

        $this->load->model('themes_model');


        $error = false;
        $newthemename = "";

        $msg = array('status' => $error, 'msg' => 'Failed! updating database...', 'block' => '');

        if(isset($_POST)){
            if(isset($_POST['newthemename']) && !empty($_POST['newthemename']) && !$error) {
                $newthemename = $_POST['newthemename'];
                $error = false;

            } else {
                $error = true;
            }

            if(!$error) {
                $input = ['name'=>$newthemename];
                $this->db->insert('themes', $input);
                $theme_id = $this->db->insert_id();

                $block = "";

                $sql = "SELECT * FROM themes WHERE id = ".$theme_id;
                $res = $this->db->query($sql, array())->result();
                if(!empty($res)) {

                $block = '<tr data-row-id='.$res[0]->id.'>
        <td class="editable-col" contenteditable="true" col-index="0" oldVal ="'.$res[0]->name.'">'.$res[0]->name.'</td>
        <td class="editable-col" contenteditable="true" col-index="1" oldVal ="'.$res[0]->is_active.'">'.$res[0]->is_active.'</td>
    </tr>';
                }

                $msg = array('status' => !$error, 'msg' => 'Success! Row added with id ' . $theme_id , 'block' => $block);
            }
        }

        // send data as json format
        echo json_encode($msg);
    }

    public function keywords_new(){

        $error = false;
        $newkeywordname = "";
        $newThemeId = 0;

        $msg = array('status' => $error, 'msg' => 'Failed! updating database...', 'block' => '');

        if(isset($_POST)){
            if(isset($_POST['newkeywordname']) && !empty($_POST['newkeywordname']) && !$error) {
                $newkeywordname = $_POST['newkeywordname'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['themeId']) && !empty($_POST['themeId']) && !$error) {
                $newThemeId = $_POST['themeId'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['themeName']) && !empty($_POST['themeName']) && !$error) {
                $newThemeName = $_POST['themeName'];
                $error = false;

            } else {
                $error = true;
            }
            if(!$error) {
                $input = ['name'=>$newkeywordname];
                $this->db->insert('keywords', $input);
                $keyword_id = $this->db->insert_id();

                $data = array(
                    'theme_id' => $newThemeId,
                    'keyword_id' => $keyword_id
                );
                $this->db->insert('theme_keyword_map', $data);

                $block = "";

                $sql = "SELECT * FROM keywords WHERE id = ".$keyword_id;
                $res = $this->db->query($sql, array())->result();
                if(!empty($res)) {

                    $block = '<tr data-row-id='.$res[0]->id.'>
        <td class="non-editable-col" contenteditable="false" col-index="2" oldVal ="">' . $newThemeName . '</td>
        <td class="editable-col" contenteditable="true" col-index="0" oldVal ="'.$res[0]->name.'">'.$res[0]->name.'</td>
        <td class="editable-col" contenteditable="true" col-index="1" oldVal ="'.$res[0]->is_active.'">'.$res[0]->is_active.'</td>
    </tr>';
                }

                $msg = array('status' => !$error, 'msg' => 'Success! Row added with id ' . $keyword_id , 'block' => $block);
            }
        }

        // send data as json format
        echo json_encode($msg);
    }

    public function orgs_new(){

        $error = false;
        $neworgname = "";

        $msg = array('status' => $error, 'msg' => 'Failed! updating database...', 'block' => '');

        if(isset($_POST)){
            if(isset($_POST['neworgname']) && !empty($_POST['neworgname']) && !$error) {
                $neworgname = $_POST['neworgname'];
                $error = false;

            } else {
                $error = true;
            }


            if(!$error) {
                $input = ['name'=>$neworgname];
                $this->db->insert('organisations', $input);
                $org_id = $this->db->insert_id();

                $block = "";

                $sql = "SELECT * FROM organisations WHERE id = ".$org_id;
                $res = $this->db->query($sql, array())->result();
                if(!empty($res)) {

                    $block = '<tr data-row-id='.$res[0]->id.'>
        <td class="editable-col" contenteditable="true" col-index="0" oldVal ="'.$res[0]->name.'">'.$res[0]->name.'</td>
        <td class="editable-col" contenteditable="true" col-index="1" oldVal ="'.$res[0]->external_id.'">'.$res[0]->external_id.'</td>
    </tr>';
                }

                $msg = array('status' => !$error, 'msg' => 'Success! Row added with id ' . $org_id , 'block' => $block);
            }
        }

        // send data as json format
        echo json_encode($msg);
    }

    public function locations_new(){

        $error = false;
        $newlocname = "";

        $msg = array('status' => $error, 'msg' => 'Failed! updating database...', 'block' => '');

        if(isset($_POST)){
            if(isset($_POST['newlocname']) && !empty($_POST['newlocname']) && !$error) {
                $newlocname = $_POST['newlocname'];
                $error = false;

            } else {
                $error = true;
            }
            if(isset($_POST['parishId']) && !empty($_POST['parishId']) && !$error) {
                $newParishId = $_POST['parishId'];
                $error = false;

            } else {
                $error = true;
            }
            if(!$error) {
                $input = array(
                    'location' => $newlocname,
                    'parish_id' => $newParishId
                );
                $this->db->insert('locations', $input);
                $loc_id = $this->db->insert_id();

                $block = "";

                $sql = "SELECT l.id, l.location, p.parish_name FROM locations l,parishes p WHERE l.parish_id = p.id AND l.id =".$loc_id;
                $res = $this->db->query($sql, array())->result();
                if(!empty($res)) {

                    $block = '<tr data-row-id='.$res[0]->id.'>
        <td class="editable-col" contenteditable="true" col-index="0" oldVal ="'.$res[0]->name.'">'.$res[0]->parish_name.'</td>
        <td class="editable-col" contenteditable="true" col-index="1" oldVal ="'.$res[0]->external_id.'">'.$res[0]->location.'</td>
        <td></td>
    </tr>';
                }

                $msg = array('status' => !$error, 'msg' => 'Success! Row added with id ' . $loc_id , 'block' => $block);
            }
        }

        // send data as json format
        echo json_encode($msg);
    }
}

?>
