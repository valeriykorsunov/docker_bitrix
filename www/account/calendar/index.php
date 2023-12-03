<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Calendar");

\Bitrix\Main\Loader::includeModule("iblock");

$classApp = \Bitrix\Iblock\Iblock::wakeUp(\DogSitter\Settings::ID_IB_Applications)->getEntityDataClass();

// новый выходной
$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
if ($request["dates"]) {
	foreach (explode(",", $request["dates"]) as $date) {
		$param = array(
			"ID_EXECUTOR" => $USER->GetID(),
			"DATE_FROM" => $date,
			"DATE_TO" => $date,
			"MESSAGE" => "Выходной",
			"CURRENT_STATE" => 47,
			"SERVICE" => \DogSitter\Settings::ID_ELEMENT_SERVICE_Weekend
		);
		// проверка - эта дата уже забронирована
		$isNotFreeDay = $classApp::query()
			->addSelect("ID")
			->where(
				\Bitrix\Main\Entity\Query::filter()
					->logic('or')
					->where([
						['ACTIVE_FROM', \Bitrix\Main\Type\Date::createFromPhp(new \DateTime($param["DATE_FROM"]))],
						['ACTIVE_TO', \Bitrix\Main\Type\Date::createFromPhp(new \DateTime($param["DATE_TO"]))],
					])
			)
			// ->where("CURRENT_STATE.VALUE", "47")
			->exec()->fetch();
		if(!$isNotFreeDay){
			DogsitterOrder::addOrder($param, $USER->GetID());
		}
	}
}

// получить список активных заказов для данного исполнителя
$arEl = $classApp::getList([
	"select" => [
		"ID",
		"IBLOCK_ID",
		"NAME",
		"EXECUTOR_ID",
		"SERVICE",
		"CURRENT_STATE",
		"ACTIVE_FROM",
		"ACTIVE_TO",
	],
	"filter" => [
		"EXECUTOR_ID.VALUE" => $USER->GetID(),
		"!CURRENT_STATE.VALUE" => false,
		"!CURRENT_STATE.VALUE" => "44",
	]
])->fetchAll();

$dates = array();

foreach ($arEl as $el) {
	$period = new DatePeriod(
		new DateTime($el["ACTIVE_FROM"]->format('d.m.Y')),
		new DateInterval('P1D'),
		new DateTime($el["ACTIVE_TO"]->add("1 day")->format('d.m.Y'))
	);
	foreach ($period as $key => $value) {
		$dates[] = '"' . $value->format('Y-m-d') . '"';
	}
}
?>

<div class="personal-area__content">
	<div class="personal-area__left">
		<h1 class="h5 personal-area__title">Календарь</h1>
		<div class="personal-area__gray-wrapper">
			<div class="b-profile-info__calendar">
				<div class="b-calendar">
					<h2 class="h5 personal-area__title">1. Выберите выходные дни</h2>
					<form class="multiDatePicker-wrapper">
						<input type="hidden" class="js-datepicker-weekend" name="dates" data-dates="29.09.2023,30.09.2023,31.09.2023">
						<div class="multiDatePicker-wrapper__controls">
							<button type="submit" class="btn btn--pink js-save-dates">Забронировать дни</button>
							<button type="reset" class="btn btn--yellow js-clear-dates">Отменить бронирование</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="/local/templates/main/js/datepicker/datepicker.minimal.css">
<script src="/local/templates/main/js/datepicker/datepicker.js"></script>

<script>
	/** https://wwilsman.github.io/Datepicker.js/ */
	document.addEventListener('DOMContentLoaded', () => {
		/* utils */
		const converterDateToUnix = (date) => new Date(date.split('.').reverse().join('-'));

		const update = (datepicker, dates) => {
			datepicker.setDate(dates);
			datepicker.render()
		}

		/* model */
		const CLASS_MULTI_DATES_PICKER = 'js-datepicker-weekend';
		const CLASS_CLEAR = 'js-clear-dates';
		const defaultDates = document.querySelector(`.${CLASS_MULTI_DATES_PICKER}`).dataset.dates.split(',');

		/* controller */
		const multiDatePicker = new Datepicker(`.${CLASS_MULTI_DATES_PICKER}`, {
			without: [<?= implode(',', $dates) ?>],
			multiple: true,
			inline: true,
			min: (function() {
				var date = new Date();
				date.setDate(date.getDate() - 1);
				return date;
			})(),
			classNames: {
				node: 'multiDatePicker',
				wrapper: 'multiDatePicker__wrapper',
			},
			onInit: function() {
				update(this, defaultDates.map((date) => converterDateToUnix(date)))
				document.querySelector(`.${CLASS_CLEAR}`).addEventListener('click', () => update(this, []))
			}
		});
	})
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>