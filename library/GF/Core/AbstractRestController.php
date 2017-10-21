<?php

namespace GF\Core;

class AbstractRestController extends AbstractController
{
    protected $modelName;

    public function indexAction()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->show();
                break;
            case 'POST':
                $this->create();
                break;
            case 'PUT':
                $this->update();
                break;
            case 'DELETE':
                $this->destroy();
                break;
        }
    }

    protected function show()
    {
        $data = array();
        $modelName = $this->modelName;
        if (isset($_REQUEST['id'])) {
            $instance = $modelName::find($_REQUEST['id']);
            $data[] = $this->getProperties($instance);
        } else {
            $instances = $modelName::all();
            foreach ($instances as $key => $instance) {
                $data[] = $this->getProperties($instance);
            }
        }
        $this->_responseWithJson($data);
    }

    protected function create()
    {
        $modelName = $this->modelName;
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, TRUE);

        foreach ($data as $insert) {
            $newInstance = $modelName::create($insert, true);
        }

        $response = json_encode(array(
            'created' => $newInstance->name
        ));
        $this->_responseWithJson($response);
    }

    protected function update()
    {
        $modelName = $this->modelName;
        $newInstances = array();
        $ids = array();

        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, TRUE);
        $instances = $modelName::all();

        foreach ($data as $value) {
            $ids[$value['id']] = $value;
        }

        foreach ($instances as $instance) {
            if (array_key_exists($instance->id, $ids)) {
                $instance->update_attributes($ids[$instance->id]);
                $newInstances[] = $instance->name;
            }
        }

        $response = json_encode(array(
            'created' => $newInstances
        ));
        $this->_responseWithJson($response);
    }

    protected function destroy()
    {
        $modelName = $this->modelName;
        if (isset($_REQUEST['id'])) {
            $instance = $modelName::find($_REQUEST['id']);
            if ($instance) $instance->delete();
        }

        $response = json_encode(array(
            'deleted' => $instance->id
        ));
        $this->_responseWithJson($response);
    }

    protected function getProperties($model)
    {
        $data = array();
        $properties = array_keys($model->attributes());
        foreach ($properties as $property) {
            $data[$property] = $model->$property;
        }
        return $data;
    }

    private function _responseWithJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}