<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes_model extends CI_Model {
    function __construct() {
        parent::__construct();


    }


    function get_categories() {
        $sql = "SELECT * FROM categories 
            WHERE is_active = 'y' ";
        return $this->db->query($sql);
    }
    function get_active_themes() {
        $sql = "SELECT * FROM themes 
            WHERE is_active = 'y' ORDER BY name ASC ";
        return $this->db->query($sql);
    }

    function get_all_themes() {
        $sql = "SELECT * FROM themes ORDER BY name ASC";
        return $this->db->query($sql);
    }

    function get_theme_name($id) {
        $sql = "SELECT name FROM themes WHERE id=?";
        return $this->db->query($sql, array($id));
    }

    function edit_theme($theme_id, $theme_name, $theme_active) {
        $sql = "UPDATE themes SET name = ?, is_active = ? 
            WHERE id = ? ";
        return $this->db->query($sql, array($theme_name, $theme_active, $theme_id));
    }
    function add_theme($theme_name, $theme_active) {
        $sql = "INSERT INTO themes (name, is_active) VALUES (?, ?) ";
        return $this->db->query($sql, array($theme_name, $theme_active));
    }
    function remove_keywords_from_theme($theme_id) {
        $sql = "DELETE FROM theme_keyword_map WHERE theme_id = ? ";
        return $this->db->query($sql, array($theme_id));
    }
    function remove_theme($theme_id) {
        $sql = "DELETE FROM themes WHERE id = ? ";
        return $this->db->query($sql, array($theme_id));
    }
    function delete_theme($theme_id) {
        $res1 = remove_keywords_from_theme($theme_id);
        $res2 = remove_theme($theme_id);
        return $res1 && $res2;
    }

    function update_theme_field($name, $value, $theme_id) {
        $sql = "UPDATE themes SET ".$name." = ? WHERE id = ? ";
        //return $this->db->query($sql, array($value, $theme_id));
        return true;
    }


}
