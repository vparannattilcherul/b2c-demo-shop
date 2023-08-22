<?php

namespace Pyz\Yves\QuickOrderPage;

use SprykerShop\Yves\QuickOrderPage\Plugin\QuickOrderPage\QuickOrderCsvFileTemplateStrategyPlugin;
use SprykerShop\Yves\QuickOrderPage\Plugin\QuickOrderPage\QuickOrderCsvUploadedFileParserStrategyPlugin;
use SprykerShop\Yves\QuickOrderPage\Plugin\QuickOrderPage\QuickOrderCsvUploadedFileValidatorStrategyPlugin;
use SprykerShop\Yves\QuickOrderPage\QuickOrderPageDependencyProvider as SprykerQuickOrderPageDependencyProvider;

class QuickOrderPageDependencyProvider extends SprykerQuickOrderPageDependencyProvider
{
	/**
	* @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderUploadedFileParserStrategyPluginInterface[]
	*/
	protected function getQuickOrderUploadedFileParserPlugins(): array
	{
		return [
			new QuickOrderCsvUploadedFileParserStrategyPlugin(),
		];
	}

	/**
	* @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderFileTemplateStrategyPluginInterface[]
	*/
	protected function getQuickOrderFileTemplatePlugins(): array
	{
		return [
			new QuickOrderCsvFileTemplateStrategyPlugin(),
		];
	}

	/**
	* @return \SprykerShop\Yves\QuickOrderPageExtension\Dependency\Plugin\QuickOrderUploadedFileValidatorStrategyPluginInterface[]
	*/
	protected function getQuickOrderUploadedFileValidatorPlugins(): array
	{
		return [
			new QuickOrderCsvUploadedFileValidatorStrategyPlugin(),
		];
	}
}