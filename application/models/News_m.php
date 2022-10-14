<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_m extends CI_Model {
	
    public function get($start = null, $limit = null)
	{
		$this->db->select('
            hl_id,
            news_subtitle,
            focnews_id,
            news_wm,
            news_id,
            catnews_id,
            news_title,
            news_headline,
            news_title,
            news_caption,
            news_description, 
            news_content,
            news_image_new,
            news_writer,
            tags_id,
            news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function getBy($category = null, $cat_id = null, $start = null, $limit = null)
	{
		$this->db->select('
            hl_id,
            news_subtitle,
            focnews_id,
            news_wm,
            news_id,
            catnews_id,
            news_title,
            news_headline,
            news_title,
            news_caption,
            news_description, 
            news_content,
            news_image_new,
            news_writer,
            tags_id,
            news_view');
        $this->db->from('db_news');
        $this->db->order_by('news_datepub','DESC');
		$this->db->limit($limit, $start);
		$this->db->where($category,$cat_id);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function getDetail($id)
	{
		$this->db->select('
            hl_id,
            news_subtitle,
            focnews_id,
            news_wm,
            news_id,
            catnews_id,
            news_title,
            news_headline,
            news_title,
            news_caption,
            news_description, 
            news_content,
            news_image_new,
            news_writer,
            tags_id,
            news_view');
        $this->db->from('db_news');
		$this->db->where("news_id", $id);
		$query = $this->db->get();
		return $query->result_array();
    }

    public function categoryTitle($cat = null)
	{
		$this->db->select('catnews_id,catnews_order,catnews_title,catnews_slug');
        $this->db->from('db_category_news');
		$this->db->where("catnews_title", $cat);
		$query = $this->db->get();
		return $query;
    }

}
