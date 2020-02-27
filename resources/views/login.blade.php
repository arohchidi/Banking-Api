<html>




<form method="post" action="{{url('api/customer/sign-in')}}">
    {{csrf_field()}}
    <input name="email" />
    
    <input name="password" type="password" />
    
    <button type="submit">Login</button>
    
    
    </form>



</html>