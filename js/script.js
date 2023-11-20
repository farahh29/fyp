 jQuery(document).ready(($) => {
        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.text');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();

           
        });
        

        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.text');
            var val = parseInt($input.val());
            if (val > 1) {
                $input.val( val-1 ).change();
            } 

        });

    });


 paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: '0.1'
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            window.location.replace("paypalSuccess.php")
        })
    },
    onCancel: function (data) {
        window.location.replace("paypalCancel.php")
    }
}).render('#paypal-payment-button');





/*
 jQuery(document).ready(($) => {
        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
 
        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
        });
    });

<form id='myform' method='POST' class='quantity' action='#'>
  <input type='button' value='-' class='qtyminus minus' field='quantity' />
  <input type='text' name='quantity' value='0' class='qty' />
  <input type='button' value='+' class='qtyplus plus' field='quantity' />
</form>

<form id='myform' method='POST' class='quantity' action='#'>
  <input type='button' value='-' class='qtyminus minus' field='quantity' />
  <input type='text' name='quantity' value='0' class='qty' />
  <input type='button' value='+' class='qtyplus plus' field='quantity' />
</form>

<form id='myform' method='POST' class='quantity' action='#'>
  <input type='button' value='-' class='qtyminus minus' field='quantity' />
  <input type='text' name='quantity' value='0' class='qty' />
  <input type='button' value='+' class='qtyplus plus' field='quantity' />
</form> 

https://codepen.io/Mindgames/pen/zoWavw //ref js
https://embed.plnkr.co/plunk/B5waxZ //ref css


*/