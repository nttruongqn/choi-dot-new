<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TransactionStatus extends Enum
{

    #[Description('Đang xử lý')]
    const PROCESSING = 1;

    #[Description('Đã hoàn tất')]
    const COMPLETED = 2;

    #[Description('Đã hủy')]
    const CANCEL = 3;
}
