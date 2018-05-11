<div class="container">
    <div class="row">
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3" align="center"> <img alt="User Pic" src="{{ asset('images/avatar.png') }}" class="img-circle img-responsive" style="height: 100px; width: 100px"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Contact:</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $user->country }}</td>
                                </tr>

                                <tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $user->city }}</td>
                                </tr>
                                <tr>
                                    <td>Degree</td>
                                    <td>{{ $user->degree }}</td>
                                </tr>
                                <tr>
                                    <td>Institution</td>
                                    <td>{{ $user->institution }}</td>
                                </tr>
                                <td>About</td>
                                <td>{{ $user->about_me }}</td>

                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>