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
class NyheterControllerTest extends UnitTestCase
{
    /**
     * @var \Mauricext4fs\Baaraftonbladet\Controller\NyheterController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Mauricext4fs\Baaraftonbladet\Controller\NyheterController::class))
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
    public function listActionFetchesAllNyhetersFromRepositoryAndAssignsThemToView(): void
    {
        $allNyheters = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $nyheterRepository = $this->getMockBuilder(\Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $nyheterRepository->expects(self::once())->method('findAll')->will(self::returnValue($allNyheters));
        $this->subject->_set('nyheterRepository', $nyheterRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('nyheters', $allNyheters);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenNyheterToView(): void
    {
        $nyheter = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('nyheter', $nyheter);

        $this->subject->showAction($nyheter);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenNyheterToNyheterRepository(): void
    {
        $nyheter = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter();

        $nyheterRepository = $this->getMockBuilder(\Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $nyheterRepository->expects(self::once())->method('add')->with($nyheter);
        $this->subject->_set('nyheterRepository', $nyheterRepository);

        $this->subject->createAction($nyheter);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenNyheterToView(): void
    {
        $nyheter = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('nyheter', $nyheter);

        $this->subject->editAction($nyheter);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenNyheterInNyheterRepository(): void
    {
        $nyheter = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter();

        $nyheterRepository = $this->getMockBuilder(\Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $nyheterRepository->expects(self::once())->method('update')->with($nyheter);
        $this->subject->_set('nyheterRepository', $nyheterRepository);

        $this->subject->updateAction($nyheter);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenNyheterFromNyheterRepository(): void
    {
        $nyheter = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter();

        $nyheterRepository = $this->getMockBuilder(\Mauricext4fs\Baaraftonbladet\Domain\Repository\NyheterRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $nyheterRepository->expects(self::once())->method('remove')->with($nyheter);
        $this->subject->_set('nyheterRepository', $nyheterRepository);

        $this->subject->deleteAction($nyheter);
    }
}
