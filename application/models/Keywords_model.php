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


class Keywords_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->model_table = 'keywords';
    }


    function get_active_keywords() {
        $sql = "SELECT * FROM keywords 
            WHERE is_active = 'y' ORDER BY name ASC";
        return $this->db->query($sql);
    }

    function get_all_keywords() {
        $sql = "SELECT * FROM keywords 
            ORDER BY name ASC ";
        return $this->db->query($sql);
    }

    function get_all_keywords_by_theme() {
        $sql = "SELECT k.id AS keyword_id, k.name AS keyword_name, k.is_active AS keyword_is_active, t.name AS theme_name, t.id AS theme_id, t.is_active as theme_is_active FROM keywords k, themes t, theme_keyword_map m
            WHERE k.id = m.keyword_id AND t.id = m.theme_id ORDER BY t.name, k.name ASC ";
        return $this->db->query($sql);
    }


    function edit_keyword($keyword_id, $keyword_name, $keyword_active) {
        $sql = "UPDATE keywords SET name = ?, is_active = ? 
            WHERE id = ? ";
        return $this->db->query($sql, array($keyword_name, $keyword_active, $keyword_id));
    }

    // Add keyword. Also attach to a theme
    function add_keyword($keyword_name, $theme_id) {
        $input = ['name'=>$keyword_name];
        $this->db->insert('keywords', $input);
        $keyword_id = $this->db->insert_id();

        $sql = "INSERT INTO theme_keyword_map (theme_id, keyword_id) VALUES (?, ?) ";
        $this->db->query($sql, array($theme_id, $keyword_id));
    }
    function remove_keyword_from_theme($theme_id, $keyword_id) {
        $sql = "DELETE FROM theme_keyword_map WHERE theme_id = ? AND keyword_id = ? ";
        return $this->db->query($sql, array($theme_id, $keyword_id));
    }
    function remove_keyword_from_theme_map($keyword_id) {
        $sql = "DELETE FROM theme_keyword_map WHERE keyword_id = ? ";
        return $this->db->query($sql, array($keyword_id));
    }

    function delete_keyword($keyword_id) {
        $res1 = remove_keyword_from_theme_map($keyword_id);
        $sql = "DELETE FROM keywords WHERE keyword_id = ? ";
        return $res1 && $this->db->query($sql, array($keyword_id));
    }
}
