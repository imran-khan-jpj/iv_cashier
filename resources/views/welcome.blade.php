<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <form id="subscribe-form" method="POST" action="/charge">
            @csrf
        </form>
        <input id="card-holder-name" class="form-control" type="text" value="imran Khan" >

        <!-- Stripe Elements Placeholder -->
        <div id="card-element" style="width: 20%"></div>

        <button id="card-button">
            Process Payment
        </button>

        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe('pk_test_51IZWV3E5b82L3dcRsG6MLOjPDZKKfyJFkF56ij4YTnWnqEMBCau7ddSOrv2r5PmxgWjpJryppte62B34C5bi6fzr00C342NMUm');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');

            cardButton.addEventListener('click', async (e) => {
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );

                if (error) {
                    console.log(error);
                } else {

                    var form = document.getElementById('subscribe-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'payment_method');
                    hiddenInput.setAttribute('value', paymentMethod.id);
                    form.appendChild(hiddenInput);
                    

                    form.submit();

                }
            });
        </script>
    </body>
</html>