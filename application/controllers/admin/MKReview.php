<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//     This file is part of the Community Action MK Data Tool.
//
//    The Community Action MK Data Tool is free software: you can redistribute it and/or modify
//    it under the terms of the GNU Lesser General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    The Community Action MK Data Tool is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU Lesser General Public License for more details.
//
//    You should have received a copy of the GNU Lesser General Public License
//    along with the Community Action MK Data Tool.  If not, see <https://www.gnu.org/licenses/>.

//
//      Copyright 2021 Mosaic Digital Consultants
//


class MKReview extends CI_Controller {

    public function index()
    {


        $this->load->helper('form');

        $this->load->model('issues_model');
        $this->load->model('themes_model');
        $this->load->model('keywords_model');
        $this->load->model('orgs_model');
        $this->load->model('age_model');
        $this->load->model('locations_model');
        $this->load->model('actions_model');


        $headerInfo = array();
        $headerInfo['title'] = "Issue Reviewer";
        $data=array();


        $data['issues'] =  $this->issues_model->get_unreviewed_issues()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_active_keywords()->result();
        $data['organisations'] =  $this->orgs_model->get_organisations()->result();
        $data['locations'] =  $this->locations_model->get_locations()->result();
        $data['ages'] =  $this->age_model->get_age_ranges()->result();
        $data['actions'] =  $this->actions_model->get_actions()->result();
        $data['keywordsmap'] = $this->keywords_model->get_all_keywords_by_theme()->result();

        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles');
        $this->load->view('datareviewer', $data);
        $this->load->view('common/footer');

    }

    public function approve() {

        //$this->load->model('issues_model');

        $error = false;
        $msg = array('status' => $error, 'msg' => 'Failed updating database...', 'block' => '');


        $issue_id = $this->input->post('iss');
        $status = $this->input->post('s');

        // Set defaults
        if (strlen($status) == 0) { $status = "n"; }

        if ($issue_id > 0) {

            // Do the approval here.
            // Set the success status

            $sql = "UPDATE issues SET reviewed = '" . $status . "' WHERE id = ".$issue_id;
            $res = $this->db->query($sql, array());

            if ($res) {
                $msg = array('status' => !$error, 'msg' => 'Success - record approved' , 'block' => '');
            }

        }

        // send data as json format
        echo json_encode($msg);

    }

}

?>
