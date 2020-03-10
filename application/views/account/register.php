<div class="login-form">
    <form action="/account/register" method="post">
        <h2 class="text-center">Sign Up</h2>

        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name= "email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confim Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>        
    </form>
</div>