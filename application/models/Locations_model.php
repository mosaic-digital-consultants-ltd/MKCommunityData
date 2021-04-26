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


class Locations_model extends CI_Model {
    function __construct() {
        parent::__construct();

    }


    function get_locations() {
        $sql = "SELECT * FROM locations ORDER BY order_id, location ASC";
        return $this->db->query($sql, array());
    }

    function get_parishes() {
        $sql = "SELECT * FROM parishes ORDER BY parish_name ASC";
        return $this->db->query($sql, array());
    }

    function get_all_location_details () {
        $sql = "SELECT l.id, l.location, l.parish_id, l.order_id, p.parish_name FROM locations l,parishes p WHERE l.parish_id = p.id ORDER BY l.order_id, l.location ASC";
        return $this->db->query($sql, array());
    }

    function get_single_location_details ($id) {
        $sql = "SELECT l.id, l.location, l.parish_id, l.order_id, p.parish_name FROM locations l,parishes p WHERE l.id = ? AND l.parish_id = p.id ORDER BY l.order_id, l.location ASC";
        return $this->db->query($sql, array($id));
    }


}
