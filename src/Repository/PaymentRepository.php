<?php

declare(strict_types=1);

namespace BitBag\SyliusAdyenPlugin\Repository;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\PaymentRepository as BasePaymentRepositoryAlias;
use Sylius\Component\Core\Model\PaymentInterface;

class PaymentRepository extends BasePaymentRepositoryAlias implements PaymentRepositoryInterface
{
    public function getOneByCodeAndId(string $code, int $id): ?PaymentInterface
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->select('p')
            ->innerJoin('p.method', 'pm')
            ->where('pm.code=:code')
            ->andWhere('p.id=:id')
            ->setParameters([
                'code' => $code,
                'id' => $id
            ])
        ;

        return $qb->getQuery()->getSingleResult();
    }
}
