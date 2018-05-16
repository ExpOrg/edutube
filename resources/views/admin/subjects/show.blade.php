<div class="container">
    <div class="row">
        <div class="toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $subject->title }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3" align="center"> <img alt="User Pic" src="{{ asset($subject->image) }}" class="img-circle img-responsive" style="height: 100px; width: 100px"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Title:</td>
                                    <td>{{ $subject->title }}</td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td>{{ $subject->description }}</td>
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
