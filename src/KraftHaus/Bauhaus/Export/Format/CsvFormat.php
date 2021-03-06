<?php

namespace KraftHaus\Bauhaus\Export\Format;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Export\Format\BaseFormat;

/**
 * Class CsvFormat
 * @package KraftHaus\Bauhaus\Export\Format
 */
class CsvFormat extends BaseFormat
{

	/**
	 * Holds the content-type.
	 * @var string
	 */
	protected $contentType = 'text/csv';

	/**
	 * Holds the filename.
	 * @var string
	 */
	protected $filename = 'export.csv';

	/**
	 * Create the json response.
	 *
	 * @access public
	 * @return JsonResponse|mixed
	 */
	public function export()
	{
		$result = '';

		$fields = [];
		foreach ($this->getListBuilder()->getMapper()->getFields() as $field) {
			$fields[] = $field->getLabel();
		}

		$result.= implode(',', $fields) . PHP_EOL;

		foreach ($this->getListBuilder()->getResult() as $item) {
			$row = [];
			foreach ($item->getFields() as $field) {
				$row[] = $field->getValue();
			}

			$result.= implode(',', $row) . PHP_EOL;
		}

		return $this->createResponse($result);
	}

}