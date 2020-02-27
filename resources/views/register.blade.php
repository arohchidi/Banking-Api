<html>


<form action="{{url('/customer/api/sign-up')}}" method="post">
    
    
    {{csrf_field()}}
    
    <label for="firstname">First name</label>
    <input type="text" name="firstname" />
    
    
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" />
    
    
    
    <label for="email">Email</label>
    <input type="email" name="email" />
    
    
     <label for="password">Password</label>
    <input type="password" name="password" />
    
    
     <label for="pin">Pin</label>
    <input type="number" name="pin" />
    
     <label for="type_of_accoutn">Account Type</label>
    <input type="text" name="type_of_account" />
    
    <button type="submit" name="submit">Submit</button>
    
    </form>


</html>