<?php

declare(strict_types=1);

namespace Mauricext4fs\Baaraftonbladet\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * This file is part of the "Baar Aftonbladet" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * The repository for Nyheters
 */
class NyheterRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    public function findByTextSortedByDate(string $text): QueryResultInterface
    {
        $q = $this->createQuery();
        $q->matching(
            $q->LogicalOr(
                $q->like('text', "%" . $text . "%"),
                $q->like('title', "%" . $text . "%")
            )
        );
        $q->setOrderings([
            'date' => QueryInterface::ORDER_DESCENDING
        ]);

        return $q->execute();
    }
}
