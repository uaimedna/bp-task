<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Videos Controller
 *
 * @property \App\Model\Table\VideosTable $Videos
 */
class VideosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tag = $this->request->query('tag');
        if ($tag) {
            $videos = $this->Videos->find('all', [
                'conditions' => [
                    'Videos.tags LIKE' => "%" . $tag . "%"
                ]
            ]);
        } else {
            $videos = $this->Videos;
        }

        $videos = $this->paginate($videos);
        $tags = $this->Videos->getAllTags();

        $this->set(compact('videos', 'tags'));
        $this->set('_serialize', ['videos']);
    }
}
