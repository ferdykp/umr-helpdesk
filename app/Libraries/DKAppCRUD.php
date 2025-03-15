<?php

/**
 * DKApp
 * @author	Aldrich FCMW
 * @copyright	13-03-2025
 */

namespace App\Libraries;

use App\Helpers\DKHelper;
use Illuminate\Support\Facades\DB;

class DKAppCRUD
{
	protected $tableId 		= '';
	protected $tableClass 	= '';
	protected $thWidth 		= '';
	protected $thClass 		= '';
	protected $aodata 		= array();
	protected $column 		= '';
	protected $lastColumnSorting = false;

	protected $urlGet = '';
	protected $aoData = '';

	protected $btnAdd 		= true;
	protected $btnExport 	= true;
	protected $modalId 		= '';
	protected $modalClass 	= '';
	protected $modalSize 	= '';
	protected $modalTitle 	= '';
	protected $modalBody 	= '';
	protected $modalFooter 	= array();

	public function tableId($data)
	{
		return $this->tableId = $data;
	}

	public function column($data)
	{
		return $this->column = $data;
	}

	public function aoData($key, $data)
	{
		return $this->aoData[$key] = $data;
	}

	public function thClass($data)
	{
		return $this->thClass = $data;
	}

	public function thWidht($data)
	{
		return $this->thWidht = $data;
	}

	public function lastColumnSorting($data)
	{
		return $this->lastColumnSorting = $data;
	}

	public function btnAdd($data)
	{
		return $this->btnAdd = $data;
	}

	public function btnExport($data)
	{
		return $this->btnExport = $data;
	}

	public function urlGet($data)
	{
		return $this->urlGet = $data;
	}

	public function modalId($data)
	{
		return $this->modalId = $data;
	}

	public function modalClass($data)
	{
		return $this->modalClass = $data;
	}

	public function modalSize($data)
	{
		return $this->modalSize = $data;
	}

	public function modalTitle($data)
	{
		return $this->modalTitle = $data;
	}

	public function modalBody($data)
	{
		return $this->modalBody = $data;
	}

	public function modalFooter($key, $data)
	{
		return $this->modalFooter[$key] = $data;
	}

	public function generateTableColumn()
	{
		$tableColumn = DKHelper::arrayExplode($this->column);
		$columnWidth = DKHelper::arrayExplode($this->thWidth);
		$thClass 	 = DKHelper::arrayExplode($this->thClass);
		$lastColumn  = count($tableColumn) - 1;

		if (count($columnWidth) == 0) {
			$columnWidth[0] = '10px';
			$columnWidth[$lastColumn] = '120px';
		}

		if (count($thClass) == 0) {
			$thClass[0] = 'no-sort text-center';
			if ($this->lastColumnSorting == false) {
				$thClass[$lastColumn] = 'no-sort text-center';
			}
		}

		// $response = [
		// 	'thText' => $tableColumn,
		// 	'thWidth' => $columnWidth,
		// 	'thClass' => $thClass,
		// ];

		// Mengubah struktur response menjadi array multidimensi
		$response = [];
		$count = max(count($tableColumn), count($columnWidth), count($thClass));

		for ($i = 0; $i < $count; $i++) {
			$response[] = [
				'thText' => $tableColumn[$i] ?? '',
				'thWidth' => $columnWidth[$i] ?? '',
				'thClass' => $thClass[$i] ?? '',
			];
		}


		// dd($response);

		return $response;
	}

	public function render()
	{
		$aoData = [];
		if (count(DKHelper::arrayExplode($this->aoData)) > 0) {
			$aoData = $this->aoData;
		}

		return view('components.datatable', [
			'btnAdd'	 => $this->btnAdd,
			'btnExport'	 => $this->btnExport,
			'tableId' 	 => $this->tableId,
			'tableClass' => $this->tableClass,
			'urlGet' 	 => $this->urlGet,
			'aoData'  	 => $aoData,
			'colums'  	 => self::generateTableColumn(),
			'modal'   	 => self::generateModal(),
		]);
	}

	public function generateModal()
	{
		return view('components.modal', [
			'modalId' => $this->modalId,
			'modalClass' => $this->modalClass,
			'modalSize' => $this->modalSize,
			'modalTitle' => $this->modalTitle,
			'modalBody' => $this->modalBody,
			'modalFooter' => $this->modalFooter
		]);
	}
}
