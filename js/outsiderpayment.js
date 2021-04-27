paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '25'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            window.location.replace("https://fptgreenwich-website.herokuapp.com/success3.php")
        })
    },
    onCancel: function (data) {
        window.location.replace("https://fptgreenwich-website.herokuapp.com/Oncancel3.php")
    }
}).render('#paypal-payment-button');