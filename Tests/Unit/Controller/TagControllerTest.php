<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 */
class TagControllerTest extends UnitTestCase
{
    /**
     * @var \Mauricext4fs\Baaraftonbladet\Controller\TagController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Mauricext4fs\Baaraftonbladet\Controller\TagController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllTagsFromRepositoryAndAssignsThemToView(): void
    {
        $allTags = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository = $this->getMockBuilder(\::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $tagRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTags));
        $this->subject->_set('tagRepository', $tagRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('tags', $allTags);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTagToView(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('tag', $tag);

        $this->subject->showAction($tag);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenTagToTagRepository(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();

        $tagRepository = $this->getMockBuilder(\::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects(self::once())->method('add')->with($tag);
        $this->subject->_set('tagRepository', $tagRepository);

        $this->subject->createAction($tag);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenTagToView(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('tag', $tag);

        $this->subject->editAction($tag);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenTagInTagRepository(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();

        $tagRepository = $this->getMockBuilder(\::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects(self::once())->method('update')->with($tag);
        $this->subject->_set('tagRepository', $tagRepository);

        $this->subject->updateAction($tag);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenTagFromTagRepository(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();

        $tagRepository = $this->getMockBuilder(\::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagRepository->expects(self::once())->method('remove')->with($tag);
        $this->subject->_set('tagRepository', $tagRepository);

        $this->subject->deleteAction($tag);
    }
}
