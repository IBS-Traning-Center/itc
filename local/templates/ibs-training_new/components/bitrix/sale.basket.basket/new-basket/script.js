document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('installment-modal');
    const openLink = document.querySelector('.conditions-link');
    const closeBtn = document.querySelector('.installment-modal-close');
    const okButton = document.querySelector('.installment-modal-button');
    const overlay = document.querySelector('.modal-overlay');

    if (openLink) {
        openLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (okButton) {
        okButton.addEventListener('click', closeModal);
    }
    if (overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeModal();
            }
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    let checkboxState = {
        offerAgreement: false,
        certificationAgreement: false
    };

    function saveCheckboxState() {
        const offerCheckbox = document.getElementById('offer-agreement');
        const certificationCheckbox = document.getElementById('certification-agreement');

        if (offerCheckbox) {
            checkboxState.offerAgreement = offerCheckbox.checked;
        }
        if (certificationCheckbox) {
            checkboxState.certificationAgreement = certificationCheckbox.checked;
        }
    }

    function restoreCheckboxState() {
        const offerCheckbox = document.getElementById('offer-agreement');
        const certificationCheckbox = document.getElementById('certification-agreement');

        if (offerCheckbox) {
            offerCheckbox.checked = checkboxState.offerAgreement;
        }
        if (certificationCheckbox) {
            certificationCheckbox.checked = checkboxState.certificationAgreement;
        }
    }

    function addCheckboxesToBasket() {

        saveCheckboxState();

        const container = document.getElementById('agreement-checkboxes-container');
        const template = document.getElementById('agreement-checkboxes-template');

        if (container && template && container.innerHTML.trim() === '') {
            container.innerHTML = template.innerHTML;

            setTimeout(restoreCheckboxState, 50);

            setTimeout(initAgreementCheck, 100);

            console.log('Checkboxes added to basket');
        }
    }
    function initAgreementCheck() {
        const offerCheckbox = document.getElementById('offer-agreement');
        const certificationCheckbox = document.getElementById('certification-agreement');
        const checkoutButton = document.getElementById('basket-checkout-button');

        if (!offerCheckbox || !certificationCheckbox || !checkoutButton) {
            console.log('Checkboxes or button not found');
            return;
        }
        function checkAgreements() {
            const allChecked = offerCheckbox.checked && certificationCheckbox.checked;

            if (allChecked) {
                checkoutButton.disabled = false;
                checkoutButton.classList.remove('disabled');
            } else {
                checkoutButton.disabled = true;
                checkoutButton.classList.add('disabled');
            }
            saveCheckboxState();
        }

        checkAgreements();
        offerCheckbox.removeEventListener('change', checkAgreements);
        certificationCheckbox.removeEventListener('change', checkAgreements);

        offerCheckbox.addEventListener('change', checkAgreements);
        certificationCheckbox.addEventListener('change', checkAgreements);
        checkoutButton.removeEventListener('click', handleCheckoutClick);
        checkoutButton.addEventListener('click', handleCheckoutClick);

        function handleCheckoutClick(e) {
            if (checkoutButton.disabled || checkoutButton.classList.contains('disabled')) {
                e.preventDefault();
                e.stopPropagation();
                alert('Пожалуйста, примите условия оферт для оформления заказа');
                return false;
            }
        }

        console.log('Agreement check initialized');
    }
    function checkAndAddCheckboxes() {
        const container = document.getElementById('agreement-checkboxes-container');
        const checkoutButton = document.getElementById('basket-checkout-button');

        if (container && checkoutButton) {
            addCheckboxesToBasket();
            return true;
        }
        return false;
    }
    const observer = new MutationObserver(function(mutations) {
        let shouldAddCheckboxes = false;

        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        if (node.id === 'agreement-checkboxes-container' ||
                            node.querySelector('#agreement-checkboxes-container')) {
                            shouldAddCheckboxes = true;
                        }
                        if (node.id === 'basket-checkout-button' ||
                            node.querySelector('#basket-checkout-button')) {
                            shouldAddCheckboxes = true;
                        }
                    }
                });
            }
        });

        if (shouldAddCheckboxes) {
            setTimeout(checkAndAddCheckboxes, 300);
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    if (typeof BX !== 'undefined' && BX.Sale && BX.Sale.BasketComponent) {
        const originalUpdateBasket = BX.Sale.BasketComponent.updateBasket;
        BX.Sale.BasketComponent.updateBasket = function() {
            const result = originalUpdateBasket.apply(this, arguments);
            setTimeout(function() {
                checkAndAddCheckboxes();
            }, 500);

            return result;
        };
    }

    setTimeout(function() {
        if (!checkAndAddCheckboxes()) {
            const intervalId = setInterval(function() {
                if (checkAndAddCheckboxes()) {
                    clearInterval(intervalId);
                }
            }, 500);
            setTimeout(function() {
                clearInterval(intervalId);
            }, 10000);
        }
    }, 1000);
});
