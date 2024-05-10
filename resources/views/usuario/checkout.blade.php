  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
       <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=USD&intent=capture"></script>
    
  </head>
  <body>
    
 

<div class="container text-center">
    <div class="row mt-3">
        <div class="col-12 col-lg-6 offset-lg-3 alert alert-success" 
        role="alert" id="paypal-success" style="display: none;">
        Se ha enviado dinero por esta via!
    </div>
    <div class="col-12 col-lg-6 offset-lg-3 mt-3 mb-3">
        <div class="input-group">
            <span class="input-group-text">
                USD
            </span>
            <input type="text" class="form-control" id="paypal-amount" value="10" aria-label="cantidad">
 
        </div>
    </div>
    <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
    </div>
</div>
</body>
<script>
    paypal.Buttons({
        createOrder:function(){
            return fetch("/create/" + document.getElementById("paypal-amount").value)
            .then((response)=>response.text())
            .then((id)=>{
                return $id;
            });
        },

        onApprove:function(){
            return fetch("/complete", {method: "post", headers: {"X-CSRF-Token":'{{csrf_token()}}'}})
            .then((response)=>response.json())
            .then((order_details)=>{
                document.getElementById("paypal-success").style.display='block';
            })
            .catch((error)=>{
                console.log(error);
            });
        },

        onCancel: function(data){
            console.log(data);
        },
        onError: function(err){
            console.log(err);
        }

    }).render('#payment_options');
</script>


</html>