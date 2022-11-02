<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "Baar Aftonbladet" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * NyheterController
 */
class NyheterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * nyheterRepository
     *
     * @var \Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository
     */
    protected $nyheterRepository = null;

    /**
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository $nyheterRepository
     */
    public function injectNyheterRepository(\Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository $nyheterRepository)
    {
        $this->nyheterRepository = $nyheterRepository;
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
        $nyheters = $this->nyheterRepository->findAll();
        $this->view->assign('nyheters', $nyheters);
        return $this->htmlResponse();
    }

    /**
     * action downloadCsv
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadcsvAction(): \Psr\Http\Message\ResponseInterface
    {
        $nyheters = $this->nyheterRepository->findAll();
		$jsonOutput = json_encode($nyheters);
        $this->view->assign('nyheters', $nyheters);
		return $this->htmlResponse($jsonOutput);
		//return $this->htmlResponse('vlad');
		//return $this->htmlResponse('vlad');
		/*return $this->responseFactory->createResponse()
            ->withHeader('Content-Type', 'text/xml; charset=utf-8')
            ->withBody($this->streamFactory->createStream($this->view->render()));*/
        //return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('nyheter', $nyheter);
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
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $newNyheter
     */
    public function createAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $newNyheter)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->nyheterRepository->add($newNyheter);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("nyheter")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('nyheter', $nyheter);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter
     */
    public function updateAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->nyheterRepository->update($nyheter);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter
     */
    public function deleteAction(\Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter $nyheter)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->nyheterRepository->remove($nyheter);
        $this->redirect('list');
    }
}
