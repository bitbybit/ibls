<?php declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class TimeStampType extends DateTimeType
{

    public const TIMESTAMP = 'timestamp';

    public function getName(): string
    {
        return self::TIMESTAMP;
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'TIMESTAMP';
    }

}
