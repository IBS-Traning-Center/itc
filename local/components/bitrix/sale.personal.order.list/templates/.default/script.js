BX.namespace('BX.Sale.PersonalOrderComponent');

(function() {
	BX.Sale.PersonalOrderComponent.PersonalOrderList = {
		init : function(params)
		{
			var rowWrapper = document.getElementsByClassName('sale-order-list-inner-row');

			params.paymentList = params.paymentList || {};
			params.url = params.url || "";
			params.templateName = params.templateName || "";
			params.returnUrl = params.returnUrl || "";

			Array.prototype.forEach.call(rowWrapper, function(wrapper)
			{
				var shipmentTrackingId = wrapper.getElementsByClassName('sale-order-list-shipment-id');
				if (shipmentTrackingId[0])
				{
					Array.prototype.forEach.call(shipmentTrackingId, function(blockId)
					{
						var clipboard = blockId.parentNode.getElementsByClassName('sale-order-list-shipment-id-icon')[0];
						if (clipboard)
						{
							BX.clipboard.bindCopyClick(clipboard, {text : blockId.innerHTML});
						}
					});
				}

				BX.bindDelegate(wrapper, 'click', { 'class': 'ajax_reload' }, BX.proxy(function(event)
				{
					var block = wrapper.getElementsByClassName('sale-order-list-inner-row-body')[0];
					var template = wrapper.getElementsByClassName('sale-order-list-inner-row-template')[0];
					var cancelPaymentLink = template.getElementsByClassName('sale-order-list-cancel-payment')[0];

					BX.ajax(
						{
							method: 'POST',
							dataType: 'html',
							url: event.target.href,
							data:
							{
								sessid: BX.bitrix_sessid(),
								RETURN_URL: params.returnUrl
							},
							onsuccess: BX.proxy(function(result)
							{
								var resultDiv = document.createElement('div');
								resultDiv.innerHTML = result;
								template.insertBefore(resultDiv, cancelPaymentLink);
								block.style.display = 'none';
								template.style.display = 'block';

								BX.bind(cancelPaymentLink, 'click', function()
								{
									block.style.display = 'block';
									template.style.display = 'none';
									resultDiv.remove();
								},this);

							},this),
							onfailure: BX.proxy(function()
							{
								return this;
							}, this)
						}, this
					);
					event.preventDefault();
				}, this));

				BX.bindDelegate(wrapper, 'click', { 'class': 'sale-order-list-change-payment' }, BX.proxy(function(event)
				{
					event.preventDefault();

					var block = wrapper.getElementsByClassName('sale-order-list-inner-row-body')[0];
					var template = wrapper.getElementsByClassName('sale-order-list-inner-row-template')[0];
					var cancelPaymentLink = template.getElementsByClassName('sale-order-list-cancel-payment')[0];

					BX.ajax(
						{
							method: 'POST',
							dataType: 'html',
							url: params.url,
							data:
							{
								sessid: BX.bitrix_sessid(),
								orderData: params.paymentList[event.target.id],
								templateName : params.templateName
							},
							onsuccess: BX.proxy(function(result)
							{
								var resultDiv = document.createElement('div');
								resultDiv.innerHTML = result;
								template.insertBefore(resultDiv, cancelPaymentLink);
								event.target.style.display = 'none';
								block.parentNode.removeChild(block);
								template.style.display = 'block';
								BX.bind(cancelPaymentLink, 'click', function()
								{
									window.location.reload();
								},this);

							},this),
							onfailure: BX.proxy(function()
							{
								return this;
							}, this)
						}, this
					);

				}, this));
			});
		}
	};
})();
document.addEventListener('DOMContentLoaded', () => {
	const cancelModal = document.getElementById('cancelModal');
	const confirmCancelModal = document.getElementById('confirmCancelModal');
	const rulesCancelModal = document.getElementById('rulesCancelModal');
	const closeCancelModal = document.getElementById('closeCancelModal');
	const closeConfirmCancelModal = document.getElementById('closeConfirmCancelModal');
	const closeRulesCancelModal = document.getElementById('closeRulesCancelModal');
	const cancelAction = document.getElementById('cancelAction');
	const confirmCancel = document.getElementById('confirmCancel');
	const finalConfirmButton = document.getElementById('finalConfirmButton');
	const closeRulesButton = document.getElementById('closeRulesButton');
	const modalTitle = document.getElementById('modalTitle');
	const modalContent = document.getElementById('modalContent');
	const rulesLink = document.querySelector('.rules-link');

	let currentBasketId = null;
	let currentOrderId = null;
	let currentOrderNumber = null;
	let currentCourseName = null;

	if (rulesLink) {
		rulesLink.addEventListener('click', (e) => {
			e.preventDefault();
			logDebug('Открытие модалки с правилами отмены');
			rulesCancelModal.classList.add('active');
			document.body.style.overflow = 'hidden';
		});
	}

	function closeRulesModal() {
		rulesCancelModal.classList.remove('active');
		document.body.style.overflow = 'auto';
	}

	closeRulesCancelModal.addEventListener('click', () => {
		logDebug('Закрытие модалки правил через крестик');
		closeRulesModal();
	});

	closeRulesButton.addEventListener('click', () => {
		logDebug('Закрытие модалки правил через кнопку');
		closeRulesModal();
	});

	rulesCancelModal.addEventListener('click', (e) => {
		if (e.target === rulesCancelModal) {
			logDebug('Закрытие модалки правил по клику вне модалки');
			closeRulesModal();
		}
	});

	document.querySelectorAll('.cancel-item-btn').forEach(btn => {
		btn.addEventListener('click', (e) => {
			e.preventDefault();
			currentBasketId = btn.dataset.basketId;
			currentOrderId = btn.dataset.orderId;
			currentOrderNumber = btn.dataset.orderNumber;
			currentCourseName = btn.dataset.courseName;

			logDebug('Открытие первой модалки', {
				basketId: currentBasketId,
				orderId: currentOrderId,
				orderNumber: currentOrderNumber,
				courseName: currentCourseName
			});

			modalTitle.textContent = `Отменить заказ №${currentOrderNumber}`;
			modalContent.textContent = `Заказ: ${currentCourseName} Будет отменён. По вопросам возврата денег за заказ с вами свяжется менеджер в течение 7 дней.`;
			cancelModal.classList.add('active');
			document.body.style.overflow = 'hidden';
		});
	});

	function closeFirstModal() {
		cancelModal.classList.remove('active');
		document.body.style.overflow = 'auto';
	}

	closeCancelModal.addEventListener('click', () => {
		logDebug('Закрытие первой модалки через крестик');
		closeFirstModal();
		resetModal();
	});

	cancelAction.addEventListener('click', () => {
		logDebug('Нажата кнопка "Отменить" в первой модалке');
		closeFirstModal();
		resetModal();
	});

	cancelModal.addEventListener('click', (e) => {
		if (e.target === cancelModal) {
			logDebug('Закрытие первой модалки по клику вне модалки');
			closeFirstModal();
			resetModal();
		}
	});

	confirmCancel.addEventListener('click', () => {
		logDebug('Нажата кнопка "Отменить заказ" в первой модалке', {
			orderNumber: currentOrderNumber,
			courseName: currentCourseName
		});

		closeFirstModal();

		setTimeout(() => {
			confirmCancelModal.classList.add('active');
			document.body.style.overflow = 'hidden';
			logDebug('Открыта вторая модалка');
		}, 200);
	});

	function closeSecondModal() {
		confirmCancelModal.classList.remove('active');
		document.body.style.overflow = 'auto';
	}

	closeConfirmCancelModal.addEventListener('click', () => {
		logDebug('Закрытие второй модалки через крестик');
		closeSecondModal();
		resetModal();
	});

	confirmCancelModal.addEventListener('click', (e) => {
		if (e.target === confirmCancelModal) {
			logDebug('Закрытие второй модалки по клику вне модалки');
			closeSecondModal();
			resetModal();
		}
	});

	finalConfirmButton.addEventListener('click', async () => {
		logDebug('Начало процесса отмены заказа', {
			orderId: currentOrderId,
			basketId: currentBasketId
		});

		finalConfirmButton.disabled = true;
		finalConfirmButton.textContent = 'Отмена...';
		finalConfirmButton.style.opacity = '0.7';

		try {
			logDebug('Отправка AJAX запроса');

			const formData = new FormData();
			formData.append('orderId', currentOrderId);
			formData.append('basketId', currentBasketId);
			formData.append('action', 'cancel_item');

			const response = await fetch('/ajax/cancel_order_item.php', {
				method: 'POST',
				body: formData
			});

			logDebug('Получен ответ от сервера', response.status);

			const result = await response.json();
			logDebug('Результат от сервера', result);

			if (result.status === 'success') {
				logDebug('Отмена успешна, обновление страницы');

				finalConfirmButton.textContent = 'Успешно!';
				finalConfirmButton.style.backgroundColor = '#4CAF50';

				setTimeout(() => {
					closeSecondModal();
					location.reload();
				}, 1000);

			} else {
				logDebug('Ошибка от сервера', result.error);

				finalConfirmButton.disabled = false;
				finalConfirmButton.textContent = 'Завершить';
				finalConfirmButton.style.opacity = '1';

				alert('Ошибка: ' + (result.error || 'неизвестная ошибка'));
				closeSecondModal();
			}

		} catch (err) {
			logDebug('Ошибка сети или сервера', err);

			finalConfirmButton.disabled = false;
			finalConfirmButton.textContent = 'Завершить';
			finalConfirmButton.style.opacity = '1';

			alert('Ошибка связи с сервером. Пожалуйста, попробуйте позже.');
			closeSecondModal();

		} finally {
			if (finalConfirmButton.textContent !== 'Успешно!') {
				finalConfirmButton.disabled = false;
				finalConfirmButton.textContent = 'Завершить';
				finalConfirmButton.style.opacity = '1';
			}
		}
	});

	function resetModal() {
		logDebug('Сброс данных модалки');
		currentBasketId = null;
		currentOrderId = null;
		currentOrderNumber = null;
		currentCourseName = null;
	}

	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') {
			if (cancelModal.classList.contains('active')) {
				closeFirstModal();
				resetModal();
			} else if (confirmCancelModal.classList.contains('active')) {
				closeSecondModal();
				resetModal();
			} else if (rulesCancelModal.classList.contains('active')) {
				closeRulesModal();
			}
		}
	});

	function logDebug(message, data = null) {
		console.log(`[Отмена заказа] ${message}`, data || '');
	}

	const cancelButtons = document.querySelectorAll('.cancel-item-btn');
	logDebug(`Найдено кнопок отмены: ${cancelButtons.length}`);

	cancelButtons.forEach((btn, index) => {
		logDebug(`Кнопка ${index + 1}:`, {
			basketId: btn.dataset.basketId,
			orderId: btn.dataset.orderId,
			orderNumber: btn.dataset.orderNumber,
			courseName: btn.dataset.courseName
		});
	});
	if (rulesLink) {
		logDebug('Ссылка на правила найдена');
	} else {
		logDebug('Ссылка на правила не найдена');
	}
});