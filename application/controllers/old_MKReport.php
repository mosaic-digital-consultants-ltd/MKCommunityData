<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKReport extends CI_Controller {

    public function index()
    {
        // MapsAPIkey = AIzaSyBuZG8QnItRMSpVlZkemQf7xtKqEC4_SWM  registered to mark@mosaicdigital.tech
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);


        $this->load->helper('form');

        $this->load->model('issues_model');
        $this->load->model('themes_model');
        $this->load->model('keywords_model');
        $this->load->model('orgs_model');
        $this->load->model('age_model');
        $this->load->model('locations_model');
        $this->load->model('actions_model');
        $this->load->model('reports_model');



        $query = $this->issues_model->get_issues_by_organisation(5);
        $numrows = $query->num_rows();;

        $headerInfo = array();
        $headerInfo['title'] = "Community Data Reporting";
        $data=array();

        $data['numrows'] = $numrows;
        $data['title'] = "test title";
//        foreach ($query->result() as $row)
//        {
//            echo $row->summary;
//            echo $row->dialogue;
//
//        }
//        echo $numrows;

        $data['themes'] =  $this->themes_model->get_active_themes()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_active_keywords()->result();
        $data['organisations'] =  $this->orgs_model->get_organisations()->result();
        $data['locations'] =  $this->locations_model->get_locations()->result();
        $data['ages'] =  $this->age_model->get_age_ranges()->result();
        $data['actions'] =  $this->actions_model->get_actions()->result();
        $data['keywordsmap'] = $this->keywords_model->get_all_keywords_by_theme()->result();
        $data['topkeywords'] = $this->reports_model->get_top_keywords()->result();
        $data['toplocations'] = $this->reports_model->get_top_locations()->result();
        $data['topcategories'] = $this->reports_model->get_top_categories()->result();
        $data['firstdate'] = $this->reports_model->get_earliest_date()->result();
        $data['reviewedcounts'] = $this->reports_model->get_reviewed_counts()->result();
        $data['maxRecords'] = 15;
//        foreach ($data['themes']->result() as $row)
//        {
//            echo $row->id;
//            echo $row->name;
//
//        }

//        var_dump($data['themes']);

        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
        //$this->googlemaps->initialize();

        // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be placed where we want the map to appear.
        //$data['map'] = $this->googlemaps->create_map();

        // Load our view, passing the map data that has just been created
        $this->load->view('common/header', $headerInfo);
        $this->load->view('common/styles', $headerInfo);
        $this->load->view('datareport', $data);
        $this->load->view('common/footer', $headerInfo);

    }

    public function submit() {

        if ( $this->input->post( 'TS' ) != $this->session->userdata('form_TS') ) {

            $this->session->set_userdata('form_TS', $this->input->post('TS'));

            $this->load->model('issues_model');

            $postdata = array(
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


            $issue_id = $this->issues_model->save_issue($postdata);

            $newArray = array();
            $newArray = $this->convert_to_array($issue_id, 'issue_id', 'age_id', $this->input->post('age_groups[]'));
            $this->issues_model->save_issue_age_map ($newArray);

            $newArray = array();
            $newArray = $this->convert_to_array($issue_id, 'issue_id', 'location_id', $this->input->post('estates[]'));
            $this->issues_model->save_issue_location_map ($newArray);

            // Keywords are coming in as a JSON string, so need to be converted to an array.
            $testArray = json_decode($this->input->post('keywords'));
            $newArray = $this->convert_to_array($issue_id, 'issue_id', 'keyword_id', $testArray);
            $this->issues_model->save_issue_keyword_map ($newArray);

        }
        $headerInfo = array();
        $headerInfo['title'] = "Thank you";
        $data=array();
        $data['issue_id'] = $issue_id;

        $this->load->view('common/header', $headerInfo);
        $this->load->view('datasuccess', $data);
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

    public function viewresults()
    {

        $this->load->model('themes_model');
        $this->load->model('keywords_model');

        $headerInfo = array();
        $headerInfo['title'] = "Records Viewer";

        $data=array();

        $data['themes'] =  $this->themes_model->get_all_themes()->result();
        $data['categories'] =  $this->themes_model->get_categories()->result();
        $data['keywords'] =  $this->keywords_model->get_all_keywords_by_theme()->result();


        $this->load->view('common/header', $headerInfo);

        $this->load->view('common/styles');
        $this->load->view('dataviewrecords', $data);

        $this->load->view('common/footer-table');
        $this->load->view('common/footer');
    }

}

?>
