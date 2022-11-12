<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Controller;


/**
 * This file is part of the "Baar Aftonbladet" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * TagController
 */
class TagController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * tagRepository
     *
     * @var \Mauricext4fs\Baaraftonbladet\Domain\Repository\tagRepository
     */
    public $tagRepository = null;

    /**
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Repository\TagRepository $tagRepository
     */
    public function injectTagRepository(\Mauricext4fs\Baaraftonbladet\Domain\Repository\TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        //$tags = null;
        $tags = $this->tagRepository->findAll();
        $this->view->assign('tags', $tags);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('tag', $tag);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $newTag
     */
    public function createAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $newTag)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->tagRepository->add($newTag);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("tag")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('tag', $tag);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag
     */
    public function updateAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->tagRepository->update($tag);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag
     */
    public function deleteAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->tagRepository->remove($tag);
        $this->redirect('list');
    }
}
