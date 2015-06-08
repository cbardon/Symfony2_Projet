<?php

namespace AppBundle\Controller;

 use Symfony\Component\DependencyInjection\ContainerAware;
  use Symfony\Component\HttpFoundation\RedirectResponse;
   use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
   use AppBundle\Entity\Tache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Form\FormEvent;
 use Symfony\Component\Form\FormEvents;
 use Symfony\Component\Form\FormBuilderInterface;

    //use MyApp\FilmothequeBundle\Form\ActeurForm;
    
    class TaskController extends Controller
    {
        public function listerAction()
        {
            $task = $this->getDoctrine()->getManager();
            $listRepository = $task->getRepository('AppBundle:Tache');

            $lists = $listRepository->findAll();

            if (!$task) {
                throw $this->createNotFoundException('No task !');
            }
            return $this->render('AppBundle:List:listerTask.html.twig', array('title' => 'Show task', 'lists' => $lists));
        }

        /**
         * @param Request $request
         * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
         */
        public function ajouterAction(Request $request)
        {
            $task = new Tache();

            /* $data = $event->getData();

             $positions = $data->getSport()->getAvailablePositions();

             $form->add('position', 'entity', array('choices' => $positions));
       */
            $form = $this->createFormBuilder($task)
                ->add('nomTache', 'text')
                ->add('liste','hidden', array('data' => this.getListe()))
                /*->add('etat', 'checkbox', array(
                    'label' => 'Check !', 'required' => false,))*/
                ->add('save', 'submit')
                ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();
                //	$request->request('nom');
                return $this->redirect($this->generateUrl('task_lister'));
            }

            return $this->render('AppBundle:List:ajouterTask.html.twig', array(
                'form' => $form->createView(), 'title' => 'Add task'));

        }

        public function modifierAction($id)
        {

            $em = $this->getDoctrine()->getManager();
            $Task = $em->getRepository('AppBundle:Tache')->find($id);

            if (!$Task) {
                throw $this->createNotFoundException(
                    'Aucune tache pour l id: ' . $id
                );
            }

            $Task->setEtat(1);
            $em->flush();

            return $this->redirect($this->generateUrl('task_lister', array('title' => 'Task')));


        }

        public function supprimerAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $task = $em->getRepository('AppBundle:Tache')->find($id);

            $em->remove($task);
            $em->flush();
            return $this->redirect($this->generateUrl('task_lister'));
        }
    }
