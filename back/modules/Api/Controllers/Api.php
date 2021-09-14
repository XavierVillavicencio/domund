<?php
namespace Modules\Api\Controllers;
use CodeIgniter\RESTful\ResourceController;
use Modules\Administration\Models\Vwlistaccessusers as Vwlistaccessusers;
use Modules\Administration\Models\Vwlistaccessgroups as Vwlistaccessgroups;

class Api extends ResourceController{
    use \CodeIgniter\API\ResponseTrait;
    public function __construct(){
        $this->Vwlistaccessusers = new Vwlistaccessusers;
        $this->Vwlistaccessgroups = new Vwlistaccessgroups;
        helper('language');
        $this->language_module = 'api';
        $this->language = getLanguageConfig('en');
    }

    #prueba con https://ofv.test/api/
    public function index(){

        $indexMessage = getLanguageKey(array('IndexMessage','api','WelcomeMenssage','sharedPartyx'));
        $response = [
            'status' => 201,
            'data' => array(
                'error' => '0',
                'message' => $indexMessage
            )
        ];
        return $this->respond($response);
    }

    public function getLanguageStrings(){
        $response = [
            'status' => 201,
            'data' => array(
                'error' => '0',
                'info' => getLanguageArray()
            )
        ];
        return $this->respond($response);
    }

    # prueba con https://ofv.test/api/access_users
    public function access_users(){
        // $response = [
        //     'status' => 201,
        //     'data' => $this->Vwlistaccessusers->findAll()
        // ];
        // return $this->respond($response);
        $response = [
            'status' => 201,
            'data' => array(
                'error' => '0',
                'message' => "hola 44"
            )
        ];
        return $this->respond($response);
    }

    # pruebas con https://ofv.test/api/access_groups
    public function access_groups(){
        // $data = $this->request->getPost();
        //     if(empty($data['gro_int_id'])){
        //         $response = [
        //             'status' => 404,
        //             'output' => null,
        //             'message' => 'No groups selected',
        //             'input' => $data
        //         ];
        //         return $this->respond($response);
        //     }
        //     if(empty($data['acc_text_tag'])){
        //         $response = [
        //             'status' => 404,
        //             'output' => null,
        //             'message' => 'No tag send',
        //             'input' => $data
        //         ];

        //     return $this->respond($response);
        // }

        // $response = [
        //     'status' => 201,
        //     'output' => $this->Vwlistaccessgroups
        //                                 ->where('gro_int_id',$data['gro_int_id'])
        //                                 ->where('acc_text_tag',$data['acc_text_tag'])
        //                                 ->find(),
        //     'input' => $data,
        //     'sql' => $this->Vwlistaccessgroups->getCompiledSelect()
        // ];
        // return $this->respond($response);

        $response = [
            'status' => 201,
            'data' => array(
                'error' => '0',
                'message' => "hola 55"
            )
        ];
        return $this->respond($response);

    }
}
