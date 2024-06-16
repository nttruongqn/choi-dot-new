<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleStatus extends Enum
{

    #[Description('ADMIN')]
    const ADMIN = 1;

    #[Description('CUSTOMER')]
    const CUSTOMER = 2;
}
