<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class CatatanHarian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CatatanHarian_model', 'CatatanHarian');

        $this->methods['index_get']['limit'] = 40;
        $this->methods['index_delete']['limit'] = 40;
        $this->methods['index_post']['limit'] = 40;
        $this->methods['index_put']['limit'] = 40;
    }
    
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null){
            $catatan_harian = $this->CatatanHarian->getCatatanHarian();
        } else {
            $catatan_harian = $this->CatatanHarian->getCatatanHarian($id);
        }

        
        if($catatan_harian)
        {
            $this->response([
                'status' => true,
                'data' => $catatan_harian
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if( $this->CatatanHarian->deleteCatatanHarian($id) > 0){
                //oke
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'data berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                //id not found
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

        public function index_post()
        {
            $data = [
                'kategori' => $this->post('kategori'),
                'tanggal'  => $this->post('tanggal'),
                'judul' => $this->post('judul'),
                'catatan' => $this->post('catatan')
            ];

            if( $this->CatatanHarian->createCatatanHarian($data) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'catatan harian berhasil di tambahkan'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => true,
                    'message' => 'catatan harian tidak berhasil di tambahkan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'kategori' => $this->put('kategori'),
                'tanggal'  => $this->put('tanggal'),
                'judul' => $this->put('judul'),
                'catatan' => $this->put('catatan')
            ];
            if( $this->CatatanHarian->updateCatatanHarian($data, $id) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'catatan harian berhasil di update'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'catatan harian tidak berhasil di update'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    
}