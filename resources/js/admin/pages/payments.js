const paymentForm = document.getElementById('payment-form')

if (paymentForm) {
    const clientBlock = document.getElementById('js-client-block');
    const discountBlock = document.getElementById('js-discount-block');
    const activityInput = document.getElementById('activity_id');
    const serviceInput = document.getElementById('service_id');
    const amountInput = document.getElementById('amount');
    const amountText = document.getElementById('js-amount-text');
    const discountInput = document.getElementById('discount');
    const discountRub = document.getElementById('js-discount-text');
    const discountTip = document.getElementById('js-discount-tip');

    let discount = 0;

    $('.payment-input').on('change', handlePaymentInputChange);

    $('#client_id')
        .select2()
        .on('change', handleClientIdChange);

    function handlePaymentInputChange() {
        $('.alert').addClass('d-none')
        activityInput.value = $(this).data('activity');
        serviceInput.value = $(this).data('service');
        amountInput.value = $(this).data('price');
        amountText.innerText = `${amountInput.value} ₽`;

        let typeId = $(this).data('type');

        if (typeId == 1) {
            resetDiscount();
            resetSelect2();
            clientBlock.classList.add('d-none');
            $('#client_id').attr('required', false);
            discountBlock.classList.add('d-none');
        } else {
            clientBlock.classList.remove('d-none');
            $('#client_id').attr('required', true);
            discountBlock.classList.remove('d-none');
        }

        if (discount) {
            updateDiscountInfo();
        }
    }

    function handleClientIdChange() {
        let selectedOption = $(this).find('option:selected');

        discount = selectedOption.data('discount');

        if (discount) {
            updateDiscountInfo();
        }
    }

    function resetSelect2() {
        $('#client_id').val(null).trigger('change');
        $('#client_id').select2('destroy');
        $('#client_id').select2();
    }

    function resetDiscount() {
        discount = 0;
        discountInput.value = 0;
        discountRub.innerText = '';
        discountTip.innerText = '';
        amountText.innerText = `${amountInput.value} ₽`;
    }

    function updateDiscountInfo() {
        let amountWithoutDiscount = amountInput.value;
        let discountAmount = Math.ceil(amountInput.value * discount);

        discountTip.innerText = `${discount * 100}%`;
        discountRub.innerText = `${discountAmount} ₽`;
        discountInput.value = discountAmount;
        amountInput.value = amountInput.value - discountInput.value;

        amountText.innerHTML = `
            <ul>
                <li style="text-decoration: line-through;">${amountWithoutDiscount} ₽</li>
                <li class="text-danger" style="font-size: 20px;">${amountInput.value} ₽</li>
            </ul>
        `;
    }
}
