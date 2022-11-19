<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Domain\Model;


/**
 * This file is part of the "Baar Aftonbladet" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * Baar Aftonbladet Nyheter
 */
class Nyheter extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    public $title = null;

    /**
     * text
     *
     * @var string
     */
    public $text = null;

    /**
     * author
     *
     * @var string
     */
    public $author = null;

    /**
     * date
     *
     * @var string
     */
    public $date = null;

    /**
     * Article tags
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    public $tags = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->tags = $this->tags ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns the text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * Returns the author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the author
     *
     * @param string $author
     * @return void
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    /**
     * Returns the date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param string $date
     * @return void
     */
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    /**
     * Adds a Tag
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag
     * @return void
     */
    public function addTag(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tag)
    {
        $this->tags->attach($tag);
    }

    /**
     * Removes a Tag
     *
     * @param \Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tagToRemove The Tag to be removed
     * @return void
     */
    public function removeTag(\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag $tagToRemove)
    {
        $this->tags->detach($tagToRemove);
    }

    /**
     * Returns the tags
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag>
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $separator
     * @return string
     */
    public function getTagsAsString($separator): String
    {
        $tags = [];
        foreach ($this->getTags() as $tagItem) {

            $tags[] = $tagItem->getText();
        }
        return implode($separator, $tags);
    }

    /**
     * Sets the tags
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Mauricext4fs\Baaraftonbladet\Domain\Model\Tag> $tags
     * @return void
     */
    public function setTags(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags)
    {
        $this->tags = $tags;
    }

}
