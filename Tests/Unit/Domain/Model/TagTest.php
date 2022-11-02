<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 */
class TagTest extends UnitTestCase
{
    /**
     * @var \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag::class,
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
}
