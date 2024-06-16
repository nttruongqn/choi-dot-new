<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserStatus extends Enum
{
    #[Description('Chưa kích hoạt')]
    const INACTIVE = 1;

    #[Description('Kích hoạt')]
    const ACTIVE = 2;

    #[Description('Khóa')]
    const BLOCKED = 3;
}
