<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class NyheterTest extends UnitTestCase
{
    /**
     * @var \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Mauricext4fs\Baaraftonbladet\Domain\Model\Nyheter::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('title'));
    }

    /**
     * @test
     */
    public function getTextReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getText()
        );
    }

    /**
     * @test
     */
    public function setTextForStringSetsText(): void
    {
        $this->subject->setText('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('text'));
    }

    /**
     * @test
     */
    public function getAuthorReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getAuthor()
        );
    }

    /**
     * @test
     */
    public function setAuthorForStringSetsAuthor(): void
    {
        $this->subject->setAuthor('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('author'));
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForStringSetsDate(): void
    {
        $this->subject->setDate('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('date'));
    }

    /**
     * @test
     */
    public function getTagsReturnsInitialValueForTag(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTags()
        );
    }

    /**
     * @test
     */
    public function setTagsForObjectStorageContainingTagSetsTags(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();
        $objectStorageHoldingExactlyOneTags = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTags->attach($tag);
        $this->subject->setTags($objectStorageHoldingExactlyOneTags);

        self::assertEquals($objectStorageHoldingExactlyOneTags, $this->subject->_get('tags'));
    }

    /**
     * @test
     */
    public function addTagToObjectStorageHoldingTags(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();
        $tagsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($tag));
        $this->subject->_set('tags', $tagsObjectStorageMock);

        $this->subject->addTag($tag);
    }

    /**
     * @test
     */
    public function removeTagFromObjectStorageHoldingTags(): void
    {
        $tag = new \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag();
        $tagsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $tagsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($tag));
        $this->subject->_set('tags', $tagsObjectStorageMock);

        $this->subject->removeTag($tag);
    }
}
