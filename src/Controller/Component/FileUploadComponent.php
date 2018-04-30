<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class FileUploadComponent extends Component
{

    protected $_allowedTypes = ['image/jpeg', 'image/png'];
    protected $_maximumFileSize = 1000000;

    function initialize(array $config)
    {
        parent::initialize($config);

        if(array_key_exists('allowedTypes', $config)){
            $this->_allowedTypes = $config['allowedTypes'];
        };
        if(array_key_exists('maximumFileSize', $config)){
            $this->_maximumFileSize = $config['maximumFileSize'];
        }
    }

    public function uploadFile($file, $category)
    {
        $controller = $this->_registry->getController();
        $controller->currentUser = [];
        $controller->currentUser['id'] = $controller->Auth->user('id');
        $uploadedFiles = [];

        if(isset($file) && !empty($file) && !(count($file) == 1 && $file[0]['name'] == '' && $file[0]['error'] > 0)) {
            if(!is_array($file)){
                $file = [$file];
            }
            foreach ($file as $key => $value) {
                $fileName = $value['name'];

                if ($value['error'] != 0){
                    $controller->Flash->error(__('The file \''.$fileName.' \' could not be uploaded. Please, try again.'));
                    continue;
                }else if(!in_array($value['type'],$this->_allowedTypes)){
                    $controller->Flash->error(__('The file \''.$fileName.' \' has a forbidden file type.'));
                    continue;
                }else if($value["size"] > $this->_maximumFileSize){
                    $controller->Flash->error(__('The file \''.$fileName.' \' exceeds maximum allowed file size'));
                    continue;
                }

                $savedEntity = $this->saveFileEntity($controller,$category,$value['name'],$value['type'],$value['tmp_name']);
                if($savedEntity == null) continue;

                if (!move_uploaded_file($value['tmp_name'], $savedEntity->path)) {
                    $savedEntity['path'] = 'N/A';
                    $controller->Files->save($savedEntity);
                    $controller->Flash->error(__('The file \''.$fileName.' \' could not be uploaded. Please, try again.'));
                    continue;
                }

                if(!$controller->Files->save($savedEntity)){
                    $controller->Flash->error(__('The file \''.$fileName.' \' could not be uploaded. Please, try again.'));
                }else{
                    $uploadedFiles[] = $savedEntity;
                };

            }
        }

        return $uploadedFiles;
    }

    public function saveFileEntity($controller, $category, $fileName, $fileType, $filePath)
    {
        $controller->loadModel('Files');

        $file = $controller->Files->newEntity();
        $file['user_id'] = 1;
        $file['category'] = $category;
        $file['name'] = $fileName;
        $file['type'] = $fileType;
        $file['path'] = $filePath;

        //create dir folder
        $root_file = ROOT . '/uploads' . "/" . date("Y-m-d");

        if (!file_exists($root_file)) {
            mkdir($root_file);
        }

        if(!$controller->Files->save($file)){
            $controller->Flash->error(__('The file \''.$fileName.' \' could not be uploaded. Please, try again.'));
            return null;
        }

        $final_destination = $root_file . '/' . $controller->currentUser['id'] . '-' . $file['id'] . '-' . $file['name'];
        $file['path'] = $final_destination;

        return $file;
    }

}