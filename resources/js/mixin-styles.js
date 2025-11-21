const {
    default: axios
} = require("axios");
const {
    default: Swal
} = require("sweetalert2");



$(function () {
    if(typeof paypal !== 'undefined'){
        var FUNDING_SOURCES = [
            paypal.FUNDING.PAYPAL,
            paypal.FUNDING.CREDIT,
            paypal.FUNDING.CARD
        ];



        FUNDING_SOURCES.forEach(function (fundingSource) {

            // Initialize the buttons
            var button = paypal.Buttons({
                fundingSource: fundingSource,
                createOrder: async function (data, actions) {

                    let product = await $('input[name=product]:checked').val();
                    let response;

                    await axios.post('/checkout/api/paypal/order/create', {
                            product: product

                    }).then(resp => {

                       response= resp.data.id;
                    })

                    return response;
                },
                onApprove: async function (data, actions) {
                    return await axios.post('/payment/capture-paypal-transaction', {
                        order: data
                    }).then(function (captureData) {


                        // captura el error de pago
                        if (captureData.data.error === 'INSTRUMENT_DECLINED') { // Your server response structure and key names are what you choose

                            Swal.fire({

                                icon: 'error',
                                title: 'Payment could not be processed',
                                showConfirmButton: false,
                                timer: 2500
                              });

                            return actions.restart();
                        }
                        if(captureData.data.statusCode==201 && captureData.data.result.status=='COMPLETED' ){
                              Swal.fire({
                                icon: 'success',
                                title: 'Payment succesfully completed',
                                showConfirmButton: false,
                                timer: 2500
                              });
                              setTimeout(window.location.reload(),3000)
                            return ;
                        }


                    }).catch(function (err){

                        Swal.fire({

                            icon: 'error',
                            title: 'Payment could not be processed',
                            showConfirmButton: false,
                            timer: 2500
                          })
                    });
                    // // This function captures the funds from the transaction.
                    // return actions.order.capture().then(function (details) {
                    //     // This function shows a transaction success message to your buyer.
                    //     Swal.fire('Transaction completed by ' + details.payer.name.given_name);
                    // });
                },
            });

            // Check if the button is eligible
            if (button.isEligible()) {

                // Render the standalone button for that funding source
                button.render('#paypal-button-container');
            }
        });
    }

});
