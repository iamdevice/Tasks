<?php

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description');

        if ($this->canEditWorkResult($options)) {
            $builder->add('workResult');
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task',
            'user' => 'AppBundle\Entity\User',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_task';
    }

    private function canEditWorkResult(array $options)
    {
        $result = false;

        /** @var Task $task */
        $task = $options['data'];
        /** @var User $user */
        $user = $options['user'];

        if ($task->getPerformer() == $user && $task->isStatusInProcess()) {
            $result = true;
        }

        if ($user->isSupervisor() && $task->isSupervisorEditStatus()) {
            $result = true;
        }

        return $result;
    }
}
