<html>




<form method="post" action="{{url('api/customer/deposit')}}">
    {{csrf_field()}}
    <input name="account_number" />
    
    <input name="pin" type="text" />
     <input name="type_of_account" type="text" />
     <input name="amount" type="text" />
    <button type="submit">Login</button>
    
    
    </form>



</html>