<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKFormEdit extends CI_Controller {

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

        $issue_id = $this->input->get('iss') + 0;

        if ($issue_id > 0) {
            $query = $this->issues_model->get_issue_by_id($issue_id);
            $numrows = $query->num_rows();

//var_dump($issue_id);
//var_dump($numrows);
//var_dump($query);
//
//            foreach ($query->result() as $row) {
//                echo $row->action;
//                echo $row->action_alternate;
//            }

//            if ($numrows == 0) {
//                redirect("/MKForm");
//            }
        }
        else {
            redirect('/MKForm');
        }

        $headerInfo = array();
        $headerInfo['title'] = "Issue Editing";
        $data=array();

        $data['themes'] =  $this->themes_model->get_active_themes()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_active_keywords()->result();
        $data['organisations'] =  $this->orgs_model->get_organisations()->result();
        $data['locations'] =  $this->locations_model->get_locations()->result();
        $data['actions'] =  $this->actions_model->get_actions()->result();
        $data['keywordsmap'] = $this->keywords_model->get_all_keywords_by_theme()->result();
        $data['thisissue'] = $query->result();
        $data['thisid'] = $this->input->get('iss');



        // Load our view, passing the data that has just been created
        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles', $headerInfo);
        $this->load->view('dataissueeditor', $data);
        $this->load->view('common/footer', $headerInfo);

    }

    public function submit() {

//        if ( $this->input->post( 'TS' ) != $this->session->userdata('form_TS') ) {
//
//            $this->session->set_userdata('form_TS', $this->input->post('TS'));

            $this->load->model('issues_model');

            $postdata = array(
                'id' => $this->input->post('issue_id'),
                'organisation_id' => $this->input->post('selOrg_id'),
                'brief' => $this->input->post('briefText'),
                'detailed' => $this->input->post('detailText'),
                'category' => $this->input->post('selCat_id'),
                'impact_number' => $this->input->post('numAffected'),
                'action' => $this->input->post('selAct_id'),
                'action_alternate' => $this->input->post('actionText'),
                'contact_name' => $this->input->post('contactNameText'),
                'contact_phone' => $this->input->post('contactPhoneText'),
                'contact_email' => $this->input->post('contactEmailText')
            );

var_dump($postdata);

            $this->issues_model->update_issue($postdata, $this->input->post('issue_id'));
            $issue_id = $this->input->post('issue_id');
        var_dump($issue_id);

            $newArray = array();
            $newArray = $this->convert_to_array($issue_id, 'issue_id', 'location_id', $this->input->post('estates[]'));
            echo 'here ';
            var_dump ($newArray);
            $this->issues_model->save_issue_location_map ($newArray, $issue_id);

            echo 'here1';

            // Keywords are coming in as a JSON string, so need to be converted to an array.
            $testArray = json_decode($this->input->post('keywords'));
            $newArray = $this->convert_to_array($issue_id, 'issue_id', 'keyword_id', $testArray);
            $this->issues_model->save_issue_keyword_map ($newArray, $issue_id);
            echo 'here2';

//        }

        echo 'here';
        $headerInfo = array();
        $headerInfo['title'] = "Thank you";
        $data=array();
        $data['issue_id'] = $issue_id;

        redirect('/MKReview');
    }

    private function convert_to_array($idx, $keyName, $valName, $arr) {
        $outArray = array();
        foreach ($arr as $item) {
            //echo $item . ';';
            $pairArray = array($keyName => $idx, $valName => $item);
            //var_dump($pairArray);
            array_push($outArray, $pairArray);
        }
        return $outArray;
    }


}

?>
