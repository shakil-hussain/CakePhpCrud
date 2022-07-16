<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContactUs Controller
 *
 * @property \App\Model\Table\ContactUsTable $ContactUs
 *
 * @method \App\Model\Entity\ContactU[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactUsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $contactUs = $this->paginate($this->ContactUs);

        $this->set(compact('contactUs'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactU = $this->ContactUs->get($id, [
            'contain' => [],
        ]);

        $this->set('contactU', $contactU);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactUs = $this->ContactUs->newEntity();
        if ($this->request->is('post')) {
            $contactUs = $this->ContactUs->patchEntity($contactUs, $this->request->getData());
            if ($this->ContactUs->save($contactUs)) {
                $this->Flash->success(__('The contact u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact u could not be saved. Please, try again.'));
        }
        $this->set(compact('contactUs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactU = $this->ContactUs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactU = $this->ContactUs->patchEntity($contactU, $this->request->getData());
            if ($this->ContactUs->save($contactU)) {
                $this->Flash->success(__('The contact u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact u could not be saved. Please, try again.'));
        }
        $this->set(compact('contactU'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactU = $this->ContactUs->get($id);
        if ($this->ContactUs->delete($contactU)) {
            $this->Flash->success(__('The contact u has been deleted.'));
        } else {
            $this->Flash->error(__('The contact u could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
