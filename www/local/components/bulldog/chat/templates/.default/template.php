<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?
// BUG Online-чат - Верстка - прокрутка для сообщений
?>


<div class="personal-area__right personal-area__right--green">
	<div class="b-chat">
		<div class="h5 b-chat__title">Online chat</div>
		<div id="status"></div>
		<?/* поиск наверное не нужен?>
		<form class="js-chat-search b-chat__search-form" action>
			<div class="form-group">
				<label class="visuallyhidden" for="chat-search"></label>
				<input class="form-control" type="text" name="search" id="chat-search" placeholder="Начните вводить имя" autocomplete="off">
			</div>
			<div class="dropdown b-chat__search-dropdown b-search-result">
				<div class="b-search-result__list"><a class="b-search-result__item" href="javascript:void(0)">Александр Дубровин</a><a class="b-search-result__item" href="javascript:void(0)">Александра Шагалова</a><a class="b-search-result__item" href="javascript:void(0)">Александр Кузьмин</a>
				</div>
			</div>
		</form>
		<?*/?>
		<form class="js-chat-dialog b-chat__dialog-form" action id="chat_form">
			<div class="b-chat__view b-chat-dialog">
				<div class="b-chat-dialog__view b-chat-dialog__view__mod">
					<div class="b-chat-dialog__messages" id="messages">
					
						<!-- <div class="b-chat-dialog__message b-chat-dialog__message--right">Здравствуйте, Вы могли бы забрать Кая?</div>
						<div class="b-chat-dialog__message b-chat-dialog__message--right">Я уезжаю на выходные в командировку.</div>
						<div class="b-chat-dialog__message b-chat-dialog__message--left">Да, конечно.
							<br>Когда удобно?
						</div> -->
					</div>
				</div>
				<div class="b-chat-dialog__field">
					<textarea class="form-control form-control--small form-control--hollow" placeholder="Message" id="input"></textarea>
					<? /* смайликов нет?>
					<button class="btn btn--clear b-chat-dialog__smile-button" type="button"></button>
					<? */ ?>
				</div>
			</div>
			<button class="btn btn--max btn--yellow" id="sendMessage" type="submit">Send a message</button>
		</form>
	</div>
</div>