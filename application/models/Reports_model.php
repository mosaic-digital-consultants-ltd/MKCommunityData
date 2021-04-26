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



class Reports_model extends CI_Model {
    function __construct() {
        parent::__construct();

    }


    function get_top_keywords() {
        $sql = "SELECT k.name AS keyword, k.id AS keyword_id, t.name AS theme, COUNT(im.`keyword_id`) AS occurrences 
 FROM keywords k LEFT JOIN issue_keyword_map im ON im.keyword_id = k.id, 
 themes t, 
 theme_keyword_map tm, 
 issues i 
 WHERE tm.keyword_id = k.id 
 AND tm.theme_id = t.id
 AND i.reviewed = 'n'
 AND i.id = im.issue_id
 GROUP BY k.id
 ORDER BY occurrences DESC";
        return $this->db->query($sql, array());
    }

    function get_top_locations() {
        $sql = "SELECT l.location AS location, l.id AS location_id, p.parish_name AS parish, COUNT(im.`location_id`) AS occurrences 
 FROM locations l LEFT JOIN issue_location_map im ON im.location_id = l.id, 
 parishes p,  
 issues i 
 WHERE p.id = l.parish_id 
 AND i.reviewed = 'n'
 AND i.id = im.issue_id
 GROUP BY l.id
 ORDER BY occurrences DESC";
        return $this->db->query($sql, array());
    }

    function get_top_categories() {
        $sql = "SELECT c.name AS category, c.id AS category_id, COUNT(i.`category`) AS occurrences
FROM categories c LEFT JOIN issues i ON i.category = c.id
WHERE i.reviewed = 'n'
GROUP BY c.id
ORDER BY occurrences DESC";
        return $this->db->query($sql, array());
    }


    function get_earliest_date() {
        $sql = "SELECT MIN(submitted_date) AS firstdate FROM issues i WHERE i.reviewed = 'n'";
        return $this->db->query($sql, array());
    }

    function get_reviewed_counts() {
        $sql = "SELECT i.reviewed AS reviewed, COUNT(i.`reviewed`) AS occurrences
FROM issues i

GROUP BY i.reviewed
ORDER BY reviewed DESC";
        return $this->db->query($sql, array());
    }

    function get_issues($action, $id) {
        $sql = "select 0";
        switch ($action) {
            case "cat":
                $sql = "SELECT * FROM issues WHERE reviewed = 'n' AND category=?";
                break;

            case "loc":
                $sql = "SELECT * FROM issues i, issue_location_map lm WHERE i.reviewed = 'n' AND lm.location_id = ? AND i.id = lm.issue_id";
                break;

            case "key":
                $sql = "SELECT * FROM issues i, issue_keyword_map im WHERE i.reviewed = 'n' AND im.keyword_id = ? AND i.id = im.issue_id";
                break;
        }

        return $this->db->query($sql, array($id));
    }
}
