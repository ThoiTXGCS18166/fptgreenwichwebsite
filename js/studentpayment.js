paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '20'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            window.location.replace("http://localhost/TheOnlineLibraryManagementSystem/success1.php")
        })
    },
    onCancel: function (data) {
        window.location.replace("http://localhost/TheOnlineLibraryManagementSystem/Oncancel1.php")
    }
}).render('#paypal-payment-button');