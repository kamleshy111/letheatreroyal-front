<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Fpdf\Fpdf;

class Export {
	protected static $connection;

	public function __construct() {
		self::$connection = DB::getConnection();
		self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$this->spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

		$this->paymentModeLst = array("" => "Mode de paiement", "cash" => "Argent comptant", "cc" => "Carte de crédit", "cheque" => "Chèque", "transfer" => "Transfert bancaire", "paypal" => "PayPal", "other" => "Autre");
		$this->natureLst      = array("espece" => "Espèce", "marchandises" => "Marchandises", "service" => "Service");

		\PhpOffice\PhpSpreadsheet\Settings::setLocale("fr_CA");

		$this->spreadsheet->getDefaultStyle()
		                  ->getFont()
		                  ->setName("Arial");
		$this->spreadsheet->getDefaultStyle()
		                  ->getFont()
		                  ->setSize(12);
		$this->spreadsheet->setActiveSheetIndex(0);
		$this->spreadsheet->getActiveSheet()
		                  ->getDefaultColumnDimension()
		                  ->setWidth(15);
	}

	public function exportStats($dateFrom, $dateTo) {
		/* Feuille aide mensuelle */
		$currentCellNumber = 1;
		$currentCellLetter = "A";
		$column            = array();
		$column[]          = "";
		$column[]          = "Membres";
		$column[]          = "Hommes";
		$column[]          = "Femmes";
		$column[]          = "Filles";
		$column[]          = "Gars";
		$column[]          = "X2";
		$column[]          = "X3";
		$column[]          = "Total";

		foreach ($column as $actColumn) {
			$this->spreadsheet->setActiveSheetIndex(0)
			                  ->setCellValue($currentCellLetter . $currentCellNumber, $actColumn);
			$currentCellLetter++;
		}

		$begin = new DateTime($dateFrom);
		$end   = new DateTime($dateTo);
		for ($i = $begin; $i <= $end; $i->modify("+1 month")) {
			$currentCellLetter = "A";
			$column            = array();
			$currentCellNumber++;
			$column[] = array(
				"value" => ucfirst(strftime("%B %Y", strtotime($i->format("Y-m-d")))),
				"type"  => "S"
			);
			$stats    = Stats::getMonthlyUsage($i->format("Y-m-d"), date("Y-m-t", strtotime($i->format("Y-m-d"))));
			$column[] = array(
				"value" => $stats["totalMember"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalMale"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalFemale"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalBoy"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalGirl"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalX2"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalX3"],
				"type"  => "I"
			);
			$column[] = array(
				"value" => $stats["totalUsage"],
				"type"  => "I"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
		}
		$currentCellNumber++;
		$column            = array();
		$currentCellLetter = "A";
		$column[]          = array(
			"value" => "Total",
			"type"  => "S"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[] = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter++;
		$column[]          = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "I"
		);
		$currentCellLetter = "A";

		foreach ($column as $actColumn) {
			$sheet = $this->spreadsheet->getActiveSheet();
			$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
			switch ($actColumn["type"]) {
				case "C":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00$');
					break;
				case "N":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00');

					break;
				case "I":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('###0');

					break;
				case "S":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getAlignment()
					                  ->setWrapText(true);
					break;
			}
			$currentCellLetter++;
		}

		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Aide mensuelle");

		/* Répartition des enfants */

		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(1);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Enfants");

		$currentCellNumber = 1;
		$currentCellLetter = "A";
		$column            = array();
		$column[]          = "Garçons 0-5 ans";
		$column[]          = "Filles 0-5 ans";
		$column[]          = "Garçons 6-12 ans";
		$column[]          = "Filles 6-12 ans";
		$column[]          = "Total";
		foreach ($column as $actColumn) {
			$this->spreadsheet->setActiveSheetIndex(1)
			                  ->setCellValue($currentCellLetter . $currentCellNumber, $actColumn);
			$currentCellLetter++;
		}
		$column            = array();
		$currentCellLetter = "A";
		$currentCellNumber++;
		$stats    = Stats::getChildGenderAge($dateFrom, $dateTo);
		$column[] = array(
			"value" => $stats["m05"],
			"type"  => "I"
		);
		$column[] = array(
			"value" => $stats["f05"],
			"type"  => "I"
		);
		$column[] = array(
			"value" => $stats["m612"],
			"type"  => "I"
		);
		$column[] = array(
			"value" => $stats["f612"],
			"type"  => "I"
		);
		$column[] = array(
			"value" => "=SUM(A" . $currentCellNumber . ":D" . $currentCellNumber . ")",
			"type"  => "S"
		);

		foreach ($column as $actColumn) {
			$sheet = $this->spreadsheet->getActiveSheet();
			$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
			switch ($actColumn["type"]) {
				case "C":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00$');
					break;
				case "N":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00');

					break;
				case "I":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('###0');

					break;
				case "S":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getAlignment()
					                  ->setWrapText(true);
					break;
			}
			$currentCellLetter++;
		}

		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		/* Type de ménage */

		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(2);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Types de ménage");
		$currentCellNumber = 1;
		foreach ($houshold = Household::get(array("clause" => "(active = 'Y')")) as $actData) {
			$currentCellLetter = "A";
			$column            = array();
			$column[]          = array(
				"value" => $actData->name,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $stats["houseHold"][$actData->id],
				"type"  => "I"
			);
			$column[]          = array(
				"value" => "=B" . $currentCellNumber . "/(SUM(B1:B" . count($houshold) . "))",
				"type"  => "P"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "P":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
			$currentCellNumber++;
		}
		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		/* Types de logement */

		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(3);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Types de logement");
		$currentCellNumber = 1;
		foreach ($housing = Housing::get(array("clause" => "(active = 'Y')")) as $actData) {
			$currentCellLetter = "A";
			$column            = array();
			$column[]          = array(
				"value" => $actData->name,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $stats["housing"][$actData->id],
				"type"  => "I"
			);
			$column[]          = array(
				"value" => "=B" . $currentCellNumber . "/(SUM(B1:B" . count($housing) . "))",
				"type"  => "P"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "P":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
			$currentCellNumber++;
		}
		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		/* Sources de revenu */

		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(4);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Sources de revenu");
		$currentCellNumber = 1;
		foreach ($incomeSource = IncomeSource::get(array("clause" => "(active = 'Y')")) as $actData) {
			$currentCellLetter = "A";
			$column            = array();
			$column[]          = array(
				"value" => $actData->name,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $stats["incomeSource"][$actData->id],
				"type"  => "I"
			);
			$column[]          = array(
				"value" => "=B" . $currentCellNumber . "/(SUM(B1:B" . count($incomeSource) . "))",
				"type"  => "P"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "P":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
			$currentCellNumber++;
		}
		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		/* Raisons d'aide */

		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(5);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Raisons d'aide");
		$currentCellNumber = 1;
		foreach ($helpReason = HelpReason::get(array("clause" => "(active = 'Y')")) as $actData) {
			$currentCellLetter = "A";
			$column            = array();
			$column[]          = array(
				"value" => $actData->name,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $stats["helpReason"][$actData->id],
				"type"  => "I"
			);
			$column[]          = array(
				"value" => "=B" . $currentCellNumber . "/(SUM(B1:B" . count($helpReason) . "))",
				"type"  => "P"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "P":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
			$currentCellNumber++;
		}
		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		/* Dons */
		$this->spreadsheet->createSheet();
		$this->spreadsheet->setActiveSheetIndex(6);
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Dons");

		$currentCellNumber = 1;
		$currentCellLetter = "A";
		$column            = array();
		$column[]          = "Date";
		$column[]          = "Donateur";
		$column[]          = "Courriel";
		$column[]          = "Adresse";
		$column[]          = "Montant";
		$column[]          = "Méthode";
		$column[]          = "Nature";
		$column[]          = "Reçu transmis";

		foreach ($column as $actColumn) {
			$this->spreadsheet->setActiveSheetIndex(6)
			                  ->setCellValue($currentCellLetter . $currentCellNumber, $actColumn);
			$currentCellLetter++;
		}
		$currentCellNumber++;

		$donor = array();
		foreach ($donation = Donation::get(array("clause" => "(date >= :dateFrom) AND (date <= :dateTo)", "param" => array(":dateFrom" => $dateFrom, ":dateTo" => $dateTo)), "date") as $actData) {
			if (!$donor[$actData->idDonor]) {
				$donor[$actData->idDonor] = Donor::getOne($actData->idDonor);
			}
			$currentCellLetter = "A";
			$column            = array();
			$column[]          = array(
				"value" => $actData->date,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $donor[$actData->idDonor]->fullname,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $donor[$actData->idDonor]->email,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $donor[$actData->idDonor]->officialAddress,
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $actData->amount,
				"type"  => "C"
			);
			$column[]          = array(
				"value" => $this->paymentModeLst[$actData->method],
				"type"  => "S"
			);
			$column[]          = array(
				"value" => $this->natureLst[$actData->nature],
				"type"  => "S"
			);
			$column[]          = array(
				"value" => (($actData->sent == "Y") ? "X" : ""),
				"type"  => "S"
			);

			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "P":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
			$currentCellNumber++;
		}

		$currentCellNumber++;
		$column            = array();
		$currentCellLetter = "A";
		$column[]          = array(
			"value" => "Total",
			"type"  => "S"
		);
		$currentCellLetter++;
		$column[] = array("value" => "", "type" => "S");
		$currentCellLetter++;
		$column[] = array("value" => "", "type" => "S");
		$currentCellLetter++;
		$column[] = array("value" => "", "type" => "S");
		$currentCellLetter++;
		$column[]          = array(
			"value" => "=SUM(" . $currentCellLetter . "2:" . $currentCellLetter . ($currentCellNumber - 1) . ")",
			"type"  => "C"
		);
		$currentCellLetter = "A";
		foreach ($column as $actColumn) {
			$sheet = $this->spreadsheet->getActiveSheet();
			$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
			switch ($actColumn["type"]) {
				case "C":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00$');
					break;
				case "N":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('#,##0.00');

					break;
				case "I":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode('###0');

					break;
				case "P":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getNumberFormat()
					                  ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

					break;
				case "S":
					$this->spreadsheet->getActiveSheet()
					                  ->getStyle($currentCellLetter . $currentCellNumber)
					                  ->getAlignment()
					                  ->setWrapText(true);
					break;
			}
			$currentCellLetter++;
		}

		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}

		$this->spreadsheet->setActiveSheetIndex(0);
		$filename = (object) array("name" => "statistiques.xlsx", "location" => INCLUDE_PATH . "/tmp/");
		$this->saveFile($filename->name, "s");

		return $filename;
	}

	public function exportDonor() {
		$currentCellNumber = 1;
		$currentCellLetter = "A";
		$column            = array();
		$column[]          = "Prénom";
		$column[]          = "Nom";
		$column[]          = "Courriel";
		$column[]          = "Adresse";
		$column[]          = "Note";
		foreach ($column as $actColumn) {
			$this->spreadsheet->setActiveSheetIndex(0)
			                  ->setCellValue($currentCellLetter . $currentCellNumber, $actColumn);
			$currentCellLetter++;
		}

		foreach (Donor::get(array("clause" => "(active = 'Y')")) as $actData) {
			$currentCellLetter = "A";
			$column            = array();
			$currentCellNumber++;
			$column[] = array(
				"value" => $actData->firstname,
				"type"  => "S"
			);
			$column[] = array(
				"value" => $actData->lastname,
				"type"  => "S"
			);
			$column[] = array(
				"value" => $actData->email,
				"type"  => "S"
			);
			$column[] = array(
				"value" => $actData->officialAddress,
				"type"  => "S"
			);
			$column[] = array(
				"value" => $actData->note,
				"type"  => "S"
			);
			foreach ($column as $actColumn) {
				$sheet = $this->spreadsheet->getActiveSheet();
				$sheet->setCellValue($currentCellLetter . $currentCellNumber, $actColumn["value"]);
				switch ($actColumn["type"]) {
					case "C":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00$');
						break;
					case "N":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('#,##0.00');

						break;
					case "I":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getNumberFormat()
						                  ->setFormatCode('###0');

						break;
					case "S":
						$this->spreadsheet->getActiveSheet()
						                  ->getStyle($currentCellLetter . $currentCellNumber)
						                  ->getAlignment()
						                  ->setWrapText(true);
						break;
				}
				$currentCellLetter++;
			}
		}

		for ($i = "A"; $i <= "Z"; $i++) {
			$this->spreadsheet->getActiveSheet()
			                  ->getColumnDimension($i)
			                  ->setAutoSize(true);
		}
		$this->spreadsheet->getActiveSheet()
		                  ->setTitle("Donateurs");

		$this->spreadsheet->setActiveSheetIndex(0);
		$filename = (object) array("name" => "donateurs.xlsx", "location" => INCLUDE_PATH . "/tmp/");
		$this->saveFile($filename->name, "s");

		return $filename;
	}

	private function saveFile($name = "galilee.xlsx", $method = "o") {
		$objWriter = new Xlsx($this->spreadsheet);
		switch ($method) {
			case "o":
				header("Content-type: application/vnd.ms-excel");
				header('Content-Disposition: attachment; filename="' . $name . '"');
				$objWriter->save("php://output");
				break;
			case "s":
				$objWriter->save(INCLUDE_PATH . "/tmp/" . $name);
				break;
		}
	}
}

?>