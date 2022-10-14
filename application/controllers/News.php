<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
    JTN News V1 API
    by Fitrah Izul Falaq
    https://ceo.bikinkarya.com
*/

use chriskacerguis\RestServer\RestController;

class News extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('news_m');
    }

    public function index_get()
    {
        $this->response([
            'status' => false,
            'message' => 'Invalid Paramater. Read documentation'
        ], 404);
    }

    public function all_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 50;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->get($start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }

    public function detail_get()
    {
        $id = $this->get('id');
        $data = $this->news_m->getDetail($id);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News ID Not Found'
            ], 404);
        }
    }

    public function category_get()
    {
        //Cek ID dari Inputan Kanal
        $cat = urldecode($this->uri->segment(3));
        $cat_id = $this->news_m->categoryTitle($cat)->row("catnews_id");

        //Atur Start dan Limit
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 50;
        }

        //Dapatkan data dari DB
        $data = $this->news_m->getBy("catnews_id", $cat_id, $start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'News Category ID Not Found'
            ], 404);
        }
    }

    public function headline_get()
    {
        $start = $this->get('start');
        $limit = $this->get('limit');

        if ($limit == null) {
            $limit = 50;
        }
        // if ($start == null) { $start = 1; }

        $data = $this->news_m->getBy("news_headline", "1", $start, $limit);

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'No news were found'
            ], 404);
        }
    }
}
