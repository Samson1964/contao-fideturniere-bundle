<?php

namespace Schachbulle\ContaoFideturniereBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Schachbulle\ContaoFideturniereBundle\ContaoFideturniereBundle;

class Plugin implements BundlePluginInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getBundles(ParserInterface $parser)
	{
		return [
			BundleConfig::create(ContaoFideturniereBundle::class)
				->setLoadAfter([ContaoCoreBundle::class]),
		];
	}
}
