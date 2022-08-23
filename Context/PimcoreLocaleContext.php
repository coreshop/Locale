<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 */

declare(strict_types=1);

namespace CoreShop\Component\Locale\Context;

use Pimcore\Localization\LocaleServiceInterface;
use Pimcore\Tool;

class PimcoreLocaleContext implements LocaleContextInterface
{
    public function __construct(private LocaleServiceInterface $pimcoreLocaleService)
    {
    }

    public function getLocaleCode(): string
    {
        /**
         * @var string|null $pimcoreLocale
         * @psalm-var string|null $pimcoreLocale
         */
        $pimcoreLocale = $this->pimcoreLocaleService->findLocale();

        if (null === $pimcoreLocale) {
            throw new LocaleNotFoundException();
        }

        if (!Tool::isValidLanguage($pimcoreLocale)) {
            return Tool::getDefaultLanguage();
        }

        return $pimcoreLocale;
    }
}
