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
    public function downloadCsvAction(): \Psr\Http\Message\ResponseInterface
    {
        $this->defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;
        $nyheters = $this->nyheterRepository->findAll();
		
		$csvOutput = "";
		$csvLabel = "";
		$labelArr = [];
		foreach ($nyheters as $nyheterObj) {
			$nyheterArr = array();
			foreach ($nyheterObj as $label => $value) {
				$labelArr[] = $label;
				if ($label != "tags") {
					$nyheterArr[] = $value;
				} else {
					//$nyheterArr[] = $this->tagsToText($value->getTags()); 
				}
			}
			if (empty($csvLabel)) {
				$csvLabel .= \TYPO3\CMS\Core\Utility\CsvUtility::csvValues($labelArr) . "\n";
			}
			$csvOutput .= \TYPO3\CMS\Core\Utility\CsvUtility::csvValues($nyheterArr) . "\n";
		}	

		$csvOutput = $csvLabel . $csvOutput;
        
		$fileName = "Nyheters " . date('d.m.Y his') . ".csv";

        $response = $this->responseFactory->createResponse()
            ->withHeader('Content-Type', 'application/csv')
			->withHeader('Content-Disposition', 'attachment; filename=' . $fileName)
			->withHeader('Content-Transfer-Encoding', 'binary')
            ->withBody($this->streamFactory->createStream($csvOutput));
		
        
		return $response;
    }


    /**
     * action downloadJson
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadJsonAction(): \Psr\Http\Message\ResponseInterface
    {
        $this->defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;
        $nyheters = $this->nyheterRepository->findAll();
        $nyhetersArr = [];
        foreach ($nyheters as $nyheterItem) {
            $tags = [];
            $tagsCollection = $nyheterItem->getTags(); 
            foreach ($tagsCollection as $tagItem) {

                $tags[] = $tagItem->getText();
            }
            $nyheterItem->tags = implode(",", $tags);
			$nyheterArr = (array) $nyheterItem;
            $nyhetersArr[] = $nyheterArr;
        }

		
		//$output = json_encode($nyhetersArr);
        $this->view->assign('nyheters', $nyheters);

        $response = $this->responseFactory->createResponse()
            ->withHeader('Content-Type', 'text/json; charset=utf-8')
            ->withBody($this->streamFactory->createStream($this->view->render()));
		
		return $response;
    }

	private function tagsToText($tagsCollection)
	{
		$tags = [];
		foreach ($tagsCollection as $tagItem) {

			$tags[] = $tagItem->getText();
		}
		return implode(",", $tags);
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
