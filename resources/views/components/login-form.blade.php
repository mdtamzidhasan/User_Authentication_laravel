<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h4>Login</h4>
            <hr>
            <form action="{{route('login-user')}}" method="post">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="from-control" placeholder="Enter Email" name="email" value="{{old('email')}}">
                    <span class="text-danger">@error('email') {{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="from-control" placeholder="Enter Password" name="password" value="">
                    <span class="text-danger">@error('password') {{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="submit">Login</button>
                </div>
                <br>
                <a href="{{asset('registration')}}">New User !! Registered Here</a>

            </form>
        </div>
    </div>
</div>
