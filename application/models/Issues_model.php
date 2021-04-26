<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


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


class Issues_model extends CI_Model {
    function __construct() {
        parent::__construct();

    }


    function get_issues_by_organisation($organisation_id) {
        $sql = "SELECT * FROM issues 
            WHERE organisation_id = ?";
        return $this->db->query($sql, array($organisation_id));
    }

    function get_unreviewed_issues() {
        $sql = "SELECT 
                i.id AS this_issue, 
                i.submitted_date, 
                i.reviewed, 
                i.brief, 
                i.detailed, 
                i.impact_number, 
                i.category,
                i.action,
                i.organisation_id,
                i.action_alternate, 
                i.contact_name, 
                i.contact_phone, 
                i.contact_email,
                o.name AS organisation_name,
                c.name AS category_name, 
                a.action_name AS action_name,
                (SELECT GROUP_CONCAT(k.name SEPARATOR ';') 
FROM issue_keyword_map im, keywords k 
WHERE im.issue_id = this_issue
AND im.keyword_id = k.id) as keywords,
				(SELECT GROUP_CONCAT(l.location SEPARATOR ';') 
FROM issue_location_map lm, locations l 
WHERE lm.issue_id = this_issue
AND lm.location_id = l.id) as locations
                
                FROM issues i, organisations o, categories c, actions a 
                WHERE i.reviewed = 'n'
                AND o.id = i.organisation_id
                AND c.id = i.category
                AND a.id = i.action
                ORDER BY i.submitted_date ASC";
        return $this->db->query($sql, array());
    }

    function get_reviewed_issues() {
        $sql = "SELECT 
                i.id AS this_issue, 
                i.submitted_date, 
                i.reviewed, 
                i.brief, 
                i.detailed, 
                i.impact_number, 
                i.category,
                i.action,
                i.organisation_id,
                i.action_alternate, 
                i.contact_name, 
                i.contact_phone, 
                i.contact_email,
                o.name AS organisation_name,
                c.name AS category_name, 
                a.action_name AS action_name,
                (SELECT GROUP_CONCAT(k.name SEPARATOR ';') 
FROM issue_keyword_map im, keywords k 
WHERE im.issue_id = this_issue
AND im.keyword_id = k.id) as keywords,
				(SELECT GROUP_CONCAT(l.location SEPARATOR ';') 
FROM issue_location_map lm, locations l 
WHERE lm.issue_id = this_issue
AND lm.location_id = l.id) as locations
                
                FROM issues i, organisations o, categories c, actions a 
                WHERE i.reviewed = 'y'
                AND o.id = i.organisation_id
                AND c.id = i.category
                AND a.id = i.action
                ORDER BY i.submitted_date ASC";
        return $this->db->query($sql, array());
    }

    function get_issue_by_id($issue_id) {
        $sql = "SELECT 
                i.id AS this_issue, 
                i.submitted_date, 
                i.reviewed, 
                i.brief, 
                i.detailed, 
                i.impact_number, 
                i.category,
                i.action,
                i.organisation_id,
                i.action_alternate, 
                i.contact_name, 
                i.contact_phone, 
                i.contact_email,
                o.name AS organisation_name,
                c.name AS category_name, 
                a.action_name AS action_name,
                (SELECT GROUP_CONCAT(k.name SEPARATOR ';') 
FROM issue_keyword_map im, keywords k 
WHERE im.issue_id = this_issue
AND im.keyword_id = k.id) as keywords,
				(SELECT GROUP_CONCAT(l.location SEPARATOR ';') 
FROM issue_location_map lm, locations l 
WHERE lm.issue_id = this_issue
AND lm.location_id = l.id) as locations,
                (SELECT GROUP_CONCAT(lm.location_id SEPARATOR ';') 
FROM issue_location_map lm 
WHERE lm.issue_id = this_issue) as location_ids,
                (SELECT GROUP_CONCAT(im.keyword_id SEPARATOR ';') 
FROM issue_keyword_map im 
WHERE im.issue_id = this_issue) as keyword_ids
                
                FROM issues i, organisations o, categories c, actions a 
                WHERE i.id = ?
                AND o.id = i.organisation_id
                AND c.id = i.category
                AND a.id = i.action
                ORDER BY i.submitted_date ASC";
        return $this->db->query($sql, array($issue_id));
    }

    function save_issue($data) {

        $ret = $this->db->insert('issues', $data);
        if ($ret) {

        }
        $issue_id = $this->db->insert_id();

        return $issue_id;

    }

    function update_issue($data, $issue_id) {

        $this->db->where('id', $issue_id);
        $this->db->update('issues', $data);

    }

    function save_issue_age_map_single ($data) {
        
            if (is_array($data)) {
                $this->db->insert('issue_age_map', $data);
            }
    }
    
    function save_issue_age_map ($data) {
        
        foreach ($data as $pair) {
            if (is_array($pair)) {
                $this->db->insert('issue_age_map', $pair);
            }
            else {
                $this->db->insert ('issue_age_map', $data);
                break;
            }
        }
    }

    function save_issue_location_map ($data, $issue_id) {

        $this->db->where('issue_id', $issue_id);
        $this->db->delete('issue_location_map');

        foreach ($data as $pair) {
            if (is_array($pair)) {
                $this->db->insert('issue_location_map', $pair);
            }
            else {
                $this->db->insert ('issue_location_map', $data);
                break;
            }
        }
    }
    function save_issue_keyword_map ($data, $issue_id) {

        $this->db->where('issue_id', $issue_id);
        $this->db->delete('issue_keyword_map');

        foreach ($data as $pair) {
            if (is_array($pair)) {
                $this->db->insert('issue_keyword_map', $pair);
            }
            else {
                $this->db->insert ('issue_keyword_map', $data);
                break;
            }
        }
    }

}
